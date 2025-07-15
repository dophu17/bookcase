<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class BookController extends Controller
{
    public function index()
    {
        $query = Book::with(['category'])->where('user_id', Auth::id());
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('author_name', 'like', "%$search%");
            });
        }
        $books = $query->latest()->paginate(10);
        $categories = Category::all();
        
        // Tính toán thống kê từ tất cả sách của user
        $allBooks = Book::where('user_id', Auth::id())->get();
        $totalBooks = $allBooks->count();
        $readBooks = $allBooks->where('read_status', 'readed')->count();
        $readingBooks = $allBooks->where('read_status', 'reading')->count();
        $notReadBooks = $allBooks->where('read_status', 'not_read')->count();
        
        // Thống kê bổ sung
        $totalCost = $allBooks->sum('cover_price');
        $totalAuthors = $allBooks->unique('author_name')->count();
        $totalCategories = $allBooks->unique('category_id')->count();
        $totalCountries = $allBooks->unique('country')->count();
        $mostCategory = $allBooks->groupBy('category_id')->sortByDesc(function($group) { return $group->count(); })->keys()->first();
        $mostCountry = $allBooks->groupBy('country')->sortByDesc(function($group) { return $group->count(); })->keys()->first();
        // Lấy tên thể loại phổ biến nhất
        $mostCategoryName = null;
        if ($mostCategory) {
            $cat = $allBooks->firstWhere('category_id', $mostCategory);
            $mostCategoryName = optional($cat->category)->name;
        }
        //
        $mostCountryName = $mostCountry;
        //
        return view('dashboard', compact('books', 'categories', 'totalBooks', 'readBooks', 'readingBooks', 'notReadBooks', 'totalCost', 'totalAuthors', 'totalCategories', 'totalCountries', 'mostCategoryName', 'mostCountryName'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'read_status' => 'required|in:readed,reading,not_read',
            'publisher' => 'nullable|string|max:255',
            'total_pages' => 'nullable|integer|min:1',
            'cover_price' => 'nullable|numeric|min:0',
            'country' => 'nullable|string|max:255',
        ]);
        $validated['user_id'] = Auth::id();
        Book::create($validated);
        return redirect()->route('books.index')->with('success', __('Book created successfully!'));
    }

    public function edit(Book $book)
    {
        // Kiểm tra xem sách có thuộc về user đang đăng nhập không
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        // Kiểm tra xem sách có thuộc về user đang đăng nhập không
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'read_status' => 'required|in:readed,reading,not_read',
            'publisher' => 'nullable|string|max:255',
            'total_pages' => 'nullable|integer|min:1',
            'cover_price' => 'nullable|numeric|min:0',
            'country' => 'nullable|string|max:255',
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', __('Book updated successfully!'));
    }

    public function destroy(Book $book)
    {
        // Kiểm tra xem sách có thuộc về user đang đăng nhập không
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', __('Book deleted successfully!'));
    }

    /**
     * Phân tích ảnh để nhận diện tên sách bằng Google Vision API
     */
    public function analyzeBookImage(Request $request)
    {
        $request->validate([
            'book_image' => 'required|image',
        ]);

        $imagePath = $request->file('book_image')->getPathname();

        $imageAnnotator = new ImageAnnotatorClient([
            'credentials' => storage_path('app/google-credentials.json'),
        ]);

        $image = file_get_contents($imagePath);
        $response = $imageAnnotator->textDetection($image);
        $texts = $response->getTextAnnotations();

        $imageAnnotator->close();

        $lines = [];
        $maxArea = 0;
        $bookName = '';
        $authorName = '';
        if ($texts) {
            foreach ($texts as $i => $text) {
                if ($i == 0) continue; // bỏ qua block tổng
                $desc = trim($text->getDescription());
                if ($desc === '') continue;
                // Lấy bounding box
                $poly = $text->getBoundingPoly();
                $vertices = $poly ? $poly->getVertices() : [];
                if (count($vertices) === 4) {
                    $width = abs($vertices[1]->getX() - $vertices[0]->getX());
                    $height = abs($vertices[2]->getY() - $vertices[1]->getY());
                    $area = $width * $height;
                    if ($area > $maxArea) {
                        $maxArea = $area;
                        $bookName = $desc;
                    }
                }
                $lines[] = $desc;
            }
        }

        // Tìm tác giả: đoạn ngắn hơn, có thể chứa từ khóa hoặc nằm gần tên sách
        if ($bookName && count($lines) > 0) {
            foreach ($lines as $line) {
                if (
                    stripos($line, 'tác giả') !== false ||
                    stripos($line, 'author') !== false ||
                    stripos($line, 'by') === 0
                ) {
                    $authorName = trim(str_ireplace(['tác giả', 'author', 'by', ':'], '', $line));
                    break;
                }
            }
            // Nếu không có từ khóa, lấy đoạn ngắn nhất không trùng tên sách
            if (!$authorName && count($lines) > 1) {
                $authorName = collect($lines)
                    ->filter(fn($t) => $t !== $bookName)
                    ->sortBy(fn($t) => mb_strlen($t))
                    ->first();
            }
        }

        // Insert vào bảng books nếu có tên sách
        $createdBook = null;
        if ($bookName) {
            $createdBook = Book::create([
                'name' => $bookName,
                'author_name' => $authorName,
                'user_id' => Auth::id(),
            ]);
        }
        dd($createdBook);
        return response()->json([
            'book' => $createdBook,
            'raw_texts' => $lines,
        ]);
    }
}

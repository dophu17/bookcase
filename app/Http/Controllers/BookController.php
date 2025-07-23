<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

        $image = $request->file('book_image');
        $imageData = base64_encode(file_get_contents($image->getPathname()));

        $apiKey = env('OPENAI_API_KEY'); // Thêm vào .env

        $response = Http::withToken($apiKey)
            ->timeout(60)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o', // sử dụng model mới nhất hỗ trợ vision
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Hãy phân tích ảnh bìa sách này và trích xuất tên sách, tác giả (nếu có). Trả về kết quả dạng JSON: {"name": "...", "author": "..."}'
                            ],
                            [
                                'type' => 'image_url',
                                'image_url' => [
                                    'url' => 'data:image/jpeg;base64,' . $imageData,
                                ],
                            ],
                        ],
                    ],
                ],
                'max_tokens' => 300,
            ]);

        $result = $response->json();
        $content = $result['choices'][0]['message']['content'] ?? '';
        $bookName = null;
        $authorName = null;
        $json = json_decode($content, true);
        if (is_array($json) && (isset($json['name']) || isset($json['author']))) {
            $bookName = $json['name'] ?? null;
            $authorName = $json['author'] ?? null;
        } else {
            // Nếu không parse được JSON, thử trích xuất JSON từ text trả về
            if (preg_match('/\{[^}]+\}/', $content, $matches)) {
                $json2 = json_decode($matches[0], true);
                if (is_array($json2)) {
                    $bookName = $json2['name'] ?? null;
                    $authorName = $json2['author'] ?? null;
                }
            }
            // Nếu vẫn không có, thử tách thủ công từ text
            if (!$bookName && preg_match('/Tên sách\s*[:：]?\s*(.+)/iu', $content, $m)) {
                $bookName = trim($m[1]);
            }
            if (!$authorName && preg_match('/Tác giả\s*[:：]?\s*(.+)/iu', $content, $m)) {
                $authorName = trim($m[1]);
            }
        }
        $bookData = null;
        if ($bookName) {
            $bookData = [
                'name' => $bookName,
                'author_name' => $authorName,
                'user_id' => Auth::id(),
                'category_id' => null,
                'read_status' => 'not_read',
                'publisher' => null,
                'total_pages' => null,
                'cover_price' => null,
                'country' => null,
            ];
        }
        return response()->json([
            'book' => $bookData,
            'openai_response' => $content,
        ]);
    }
}

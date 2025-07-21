<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Review;

class LibraryController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genres', 'reviews'])->get();
        $authors = Author::withCount('books')->get();
        $genres = Genre::withCount('books')->get();
        
        $stats = [
            'total_books' => Book::count(),
            'total_authors' => Author::count(),
            'total_genres' => Genre::count(),
            'total_reviews' => Review::count(),
        ];

        return view('library.index', compact('books', 'authors', 'genres', 'stats'));
    }

    public function booksByAuthor($id)
    {
        $author = Author::with(['books.genres', 'books.reviews'])->findOrFail($id);
        return view('library.books-by-author', compact('author'));
    }

    public function booksByGenre($id)
    {
        $genre = Genre::with(['books.author', 'books.reviews'])->findOrFail($id);
        return view('library.books-by-genre', compact('genre'));
    }

    public function bookDetails($id)
    {
        $book = Book::with(['author', 'genres', 'reviews.user'])->findOrFail($id);
        return view('library.book-details', compact('book'));
    }

    public function testRelationships()
    {
        $results = [];

        $author = Author::with('books')->first();
        $book = Book::with(['author', 'genres', 'reviews'])->first();

        $results['author_books'] = [
            'author' => $author?->name,
            'books_count' => $author?->books->count(),
            'books' => $author?->books->pluck('title')->toArray()
        ];

        $results['book_author'] = [
            'book' => $book?->title,
            'author' => $book?->author->name
        ];

        $results['book_genres'] = [
            'book' => $book?->title,
            'genres' => $book?->genres->pluck('name')->toArray()
        ];

        $results['book_reviews'] = [
            'book' => $book?->title,
            'reviews_count' => $book?->reviews->count(),
            'average_rating' => $book?->reviews->avg('rating'),
            'reviews' => $book?->reviews->take(3)->map(function ($review) {
                return [
                    'rating' => $review->rating,
                    'content' => $review->content,
                ];
            })->toArray()
        ];

        return response()->json($results, 200, [], JSON_PRETTY_PRINT);
    }

    // ------------------ Book CRUD ------------------

    public function createBook()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'genres'));
    }

    public function storeBook(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book = Book::create([
            'title' => $data['title'],
            'author_id' => $data['author_id'],
        ]);

        $book->genres()->sync($data['genres'] ?? []);

        return redirect()->route('library.index')->with('success', 'Book added!');
    }

    public function editBook(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function updateBook(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book->update([
            'title' => $data['title'],
            'author_id' => $data['author_id'],
        ]);

        $book->genres()->sync($data['genres'] ?? []);

        return redirect()->route('library.index')->with('success', 'Book updated!');
    }

    public function destroyBook(Book $book)
    {
        $book->delete();
        return redirect()->route('library.index')->with('success', 'Book deleted!');
    }

    // ------------------ Author CRUD ------------------

    public function createAuthor()
    {
        return view('authors.create');
    }

    public function storeAuthor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Author::create([
            'name' => $request->name,
        ]);

        return redirect()->route('library.index')->with('success', 'Author added!');
    }

    // ------------------ Genre CRUD ------------------

    public function createGenre()
    {
        return view('genres.create');
    }

    public function storeGenre(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('library.index')->with('success', 'Genre added!');
    }
}

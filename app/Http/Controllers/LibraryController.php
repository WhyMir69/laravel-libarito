<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Review;

class LibraryController extends Controller
{
    /**
     * Display the library dashboard
     */
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

    /**
     * Display books by author
     */
    public function booksByAuthor($id)
    {
        $author = Author::with(['books.genres', 'books.reviews'])->findOrFail($id);
        return view('library.books-by-author', compact('author'));
    }

    /**
     * Display books by genre
     */
    public function booksByGenre($id)
    {
        $genre = Genre::with(['books.author', 'books.reviews'])->findOrFail($id);
        return view('library.books-by-genre', compact('genre'));
    }

    /**
     * Display book details with reviews
     */
    public function bookDetails($id)
    {
        $book = Book::with(['author', 'genres', 'reviews.user'])->findOrFail($id);
        return view('library.book-details', compact('book'));
    }

    /**
     * Test the relationships
     */
    public function testRelationships()
    {
        $results = [];

        // Test Author to Books relationship
        $author = Author::with('books')->first();
        $results['author_books'] = [
            'author' => $author->name,
            'books_count' => $author->books->count(),
            'books' => $author->books->pluck('title')->toArray()
        ];

        // Test Book to Author relationship
        $book = Book::with('author')->first();
        $results['book_author'] = [
            'book' => $book->title,
            'author' => $book->author->name
        ];

        // Test Book to Genres (Many-to-Many)
        $bookWithGenres = Book::with('genres')->first();
        $results['book_genres'] = [
            'book' => $bookWithGenres->title,
            'genres' => $bookWithGenres->genres->pluck('name')->toArray()
        ];

        // Test Book to Reviews
        $bookWithReviews = Book::with('reviews')->first();
        $results['book_reviews'] = [
            'book' => $bookWithReviews->title,
            'reviews_count' => $bookWithReviews->reviews->count(),
            'average_rating' => $bookWithReviews->average_rating,
            'reviews' => $bookWithReviews->reviews->take(3)->map(function($review) {
                return [
                    'reviewer' => $review->reviewer_name,
                    'rating' => $review->rating,
                    'content' => substr($review->content, 0, 100) . '...'
                ];
            })->toArray()
        ];

        return response()->json($results, 200, [], JSON_PRETTY_PRINT);
    }
}

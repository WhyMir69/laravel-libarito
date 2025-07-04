<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibraryController;

// Root route - redirect to login if not authenticated
Route::get('/', function () {
    if (Auth::check()) {
        return redirect(route('library.index'));
    }
    return redirect(route('login'));
});

// Authentication Routes (only for guests)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout route (for authenticated users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    
    // Library routes
    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::get('/library/author/{id}', [LibraryController::class, 'booksByAuthor'])->name('library.author');
    Route::get('/library/genre/{id}', [LibraryController::class, 'booksByGenre'])->name('library.genre');
    Route::get('/library/book/{id}', [LibraryController::class, 'bookDetails'])->name('library.book');
    Route::get('/library/test-relationships', [LibraryController::class, 'testRelationships'])->name('library.test');
    
    // Quick test route for factory data
    Route::get('/test-data', function() {
        $stats = [
            'authors' => \App\Models\Author::count(),
            'books' => \App\Models\Book::count(),
            'genres' => \App\Models\Genre::count(),
            'reviews' => \App\Models\Review::count(),
        ];
        
        $sampleAuthor = \App\Models\Author::with('books')->first();
        $sampleBook = \App\Models\Book::with(['author', 'genres', 'reviews'])->first();
        
        return response()->json([
            'message' => 'Factory data test successful!',
            'statistics' => $stats,
            'sample_author' => [
                'name' => $sampleAuthor->name,
                'books_count' => $sampleAuthor->books->count(),
            ],
            'sample_book' => [
                'title' => $sampleBook->title,
                'author' => $sampleBook->author->name,
                'genres_count' => $sampleBook->genres->count(),
                'reviews_count' => $sampleBook->reviews->count(),
                'average_rating' => number_format($sampleBook->reviews->avg('rating'), 1),
            ]
        ]);
    });
    
    // Keep existing post routes
    Route::get('/posts', [PostSessionController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostSessionController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostSessionController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostSessionController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostSessionController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostSessionController::class, 'destroy'])->name('posts.destroy');
});
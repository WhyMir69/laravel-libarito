<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
=======
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(route('library.index'));
    }
    return redirect(route('login'));
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::resource('products', ProductController::class);

    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::get('/library/author/{id}', [LibraryController::class, 'booksByAuthor'])->name('library.author');
    Route::get('/library/genre/{id}', [LibraryController::class, 'booksByGenre'])->name('library.genre');
    Route::get('/library/book/{id}', [LibraryController::class, 'bookDetails'])->name('library.book');
    Route::get('/library/test-relationships', [LibraryController::class, 'testRelationships'])->name('library.test');

    Route::get('/books/create', [LibraryController::class, 'createBook'])->name('books.create');
    Route::post('/books', [LibraryController::class, 'storeBook'])->name('books.store');
    Route::get('/books/{book}/edit', [LibraryController::class, 'editBook'])->name('books.edit');
    Route::put('/books/{book}', [LibraryController::class, 'updateBook'])->name('books.update');
    Route::delete('/books/{book}', [LibraryController::class, 'destroyBook'])->name('books.destroy');

    Route::get('/authors/create', [LibraryController::class, 'createAuthor'])->name('authors.create');
    Route::post('/authors', [LibraryController::class, 'storeAuthor'])->name('authors.store');
    Route::get('/authors/{author}/edit', [LibraryController::class, 'editAuthor'])->name('authors.edit');
    Route::put('/authors/{author}', [LibraryController::class, 'updateAuthor'])->name('authors.update');
    Route::delete('/authors/{author}', [LibraryController::class, 'destroyAuthor'])->name('authors.destroy');

    Route::get('/genres/create', [LibraryController::class, 'createGenre'])->name('genres.create');
    Route::post('/genres', [LibraryController::class, 'storeGenre'])->name('genres.store');
    Route::get('/genres/{genre}/edit', [LibraryController::class, 'editGenre'])->name('genres.edit');
    Route::put('/genres/{genre}', [LibraryController::class, 'updateGenre'])->name('genres.update');
    Route::delete('/genres/{genre}', [LibraryController::class, 'destroyGenre'])->name('genres.destroy');

    Route::resource('reviews', ReviewController::class)->except(['index', 'show']);

    Route::get('/posts', [PostSessionController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostSessionController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostSessionController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostSessionController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostSessionController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostSessionController::class, 'destroy'])->name('posts.destroy');

    Route::get('/test-data', function () {
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
>>>>>>> 4db59ba1938de0e418ef7c0900ff3dbdfa47e0ec
});

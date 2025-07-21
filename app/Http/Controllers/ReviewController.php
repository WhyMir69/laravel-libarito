<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
        ]);

        $data['user_id'] = auth()->id();

        Review::create($data);

        return redirect()->route('library.book', $data['book_id'])
            ->with('success', 'Review added!');
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
        ]);

        $review->update($data);

        return redirect()->route('library.book', $review->book_id)
            ->with('success', 'Review updated!');
    }

    public function destroy(Review $review)
    {
        $bookId = $review->book_id;
        $review->delete();

        return redirect()->route('library.book', $bookId)
            ->with('success', 'Review deleted!');
    }
}

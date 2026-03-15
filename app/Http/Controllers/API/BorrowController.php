<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function store(Request $request, $id)
    {
        $user_id = $request->user()->id;
        $book = Book::find($id);

        if ($book == null)
        {
            return response()->json([
                'message' => 'Book not found.'
            ], 404);
        }

        if ($book->available_copies <= 0)
        {
            return response()->json([
                'message' => 'Sorry, there are no available copies.'
            ], 400);
        }

        $borrowing = new Borrow();
        $borrowing->user_id = $user_id;
        $borrowing->book_copy_id = $id;
        $borrowing->borrowed_at = date('Y-m-d');
        $borrowing->due_date = date('Y-m-d', strtotime('+14 days'));
        $borrowing->status = 'active';
        $borrowing->save();

        $book->available_copies = $book->available_copies - 1;
        $book->save();

        return response()->json([
            'message' => 'Book successfully borrowed!',
            'borrowing' => $borrowing
        ], 201);
    }

    public function returnBook(Request $request, $id)
    {
        $user_id = $request->user()->id;

        $borrowing = Borrow::where('user_id', $user_id)
                           ->where('book_copy_id', $id)
                           ->where('status', 'active')
                           ->first();

        if ($borrowing == null) {
            return response()->json([
                'message' => 'You do not have an active borrowed copy of this book.'
            ], 404);
        }

        $borrowing->status = 'returned';
        $borrowing->save();

        $book = Book::find($id);
        $book->available_copies = $book->available_copies + 1;
        $book->save();

        return response()->json([
            'message' => 'Book successfully returned!',
            'borrowing' => $borrowing
        ], 200);
    }

    public function myBooks(Request $request)
    {
        $user_id = $request->user()->id;

        $myHistory = Borrow::with('book')
                           ->where('user_id', $user_id)
                           ->orderBy('borrowed_at', 'desc')
                           ->get();

        return response()->json([
            'message' => 'Here is your complete reading history.',
            'total_books' => $myHistory->count(),
            'history' => $myHistory
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function allow(Comment $comment)
    {
        $comment->update(['status' => 1]);

        return back()->with('success', 'Comment allowed successfully.');
    }

    public function block(Comment $comment)
    {
        $comment->update(['status' => 0]);

        return back()->with('success', 'Comment blocked successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}

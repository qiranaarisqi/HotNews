<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Coment::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $comments = $query->with('article', 'author')->latest()->paginate(10);

        return view('admin.comment.index', compact('comments'));
    }

    public function update(Request $request, Coment $komentar)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $komentar->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status komentar berhasil diupdate.');
    }

    public function destroy(Coment $komentar)
    {
        $komentar->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}

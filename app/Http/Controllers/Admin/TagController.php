<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:tags,name',
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Tag Berhasil Ditambahkan');
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:100|unique:tags,name,' . $tag->id_tags . ',id_tags',
        ]);

        $tag->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Tag Berhasil Diupdate');
    }

    public function destroy(Tag $tag)
    {
        $tag->articles()->detach();
        $tag->delete();
        return back()->with('success', 'Tag Berhasil Dihapus');
    }
}

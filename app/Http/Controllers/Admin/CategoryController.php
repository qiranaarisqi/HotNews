<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable',
        ]);

        Kategori::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Kategori Berhasil Ditambahkan');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable',
        ]);

        $kategori->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Kategori Berhasil Diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->articles()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki artikel.');
        }
        $kategori->delete();
        return back()->with('success', 'Kategori Berhasil Dihapus');
    }
}

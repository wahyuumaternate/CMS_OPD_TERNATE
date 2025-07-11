<?php

namespace App\Http\Controllers;

use App\Models\Page;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
          
        $pages = Page::paginate(10); // Ambil semua halaman dengan paginasi
        return view('backend.pages.index', compact('pages'));
    }
    public function create()
    {
        return view('backend.pages.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|unique:pages,slug|max:255',
                'content' => 'required',
                'status' => 'required|in:aktif,nonaktif',
            ]);
    
            Page::create($request->all());
    
            notify()->success(__('pages.created_success'));
        return redirect()->route('pages.index');
    } catch (\Throwable $th) {
        notify()->error(__('pages.created_failed') . ': ' . $th->getMessage());
        return redirect()->back();
    }
    }


    public function edit($id)
    {
        $page = Page::findOrFail($id); // Mendapatkan halaman berdasarkan ID
        return view('backend.pages.edit', compact('page')); // Mengembalikan view edit dengan data halaman
    }

    public function update(Request $request, $id)
    {
       try {
        $page = Page::findOrFail($id); // Mendapatkan halaman berdasarkan ID

        $data = $request->validate([
             'title' => 'required|string|max:255',
             'slug' => 'required|string',
             'content' => 'required',
             'status' => 'required|in:aktif,nonaktif',
         ]);
 
         $page->update($data); // Memperbarui halaman
        notify()->success(__('pages.updated_success'));
        } catch (\Throwable $th) {
            notify()->error(__('pages.updated_failed') . ': ' . $th->getMessage());
            return redirect()->back();
        }

        return redirect()->route('pages.index');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id); // Mendapatkan halaman berdasarkan ID
        $page->delete(); // Menghapus halaman
   notify()->success(__('pages.deleted_success'));
        return redirect()->route('pages.index');
    }
}

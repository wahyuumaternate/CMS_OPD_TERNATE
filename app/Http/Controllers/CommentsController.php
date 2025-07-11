<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comments::latest()->get(); // Ambil semua komentar
        return view('backend.comments.index', compact('comments'));
    }


public function store(Request $request)
{
    // Cegah file upload
    if ($request->hasFile(null) || $request->files->count() > 0) {
        abort(400, 'File upload tidak diperbolehkan.');
    }

    // Rate limiting (gunakan IP dan post_id)
    $key = 'comment:' . $request->ip() . ':' . $request->input('post_id');
    if (RateLimiter::tooManyAttempts($key, 5)) {
        return back()->withErrors(['error' => 'Terlalu banyak komentar. Silakan coba lagi nanti.']);
    }
    RateLimiter::hit($key, 60); // 5 komentar per menit per IP per post

    // Validasi input
    $validated = $request->validate([
        'post_id' => 'required|integer|exists:posts,id',
        'content' => 'required|string|min:3|max:500',
        'name' => 'required|string|min:3|max:100',
        'email' => 'required|email|max:255',
        'g-recaptcha-response' => 'required|recaptcha',
    ]);

    $post = Posts::findOrFail($validated['post_id']);

    if (!$post->comments_is_active) {
        return redirect()->back()->with('error', __('comments.disabled'));
    }

    // Escape HTML untuk keamanan (hindari XSS)
    $safeContent = strip_tags($validated['content']);
    $safeName = strip_tags($validated['name']);

    Comments::create([
        'post_id' => $validated['post_id'],
        'content' => $safeContent,
        'name' => $safeName,
        'email' => $validated['email'],
    ]);

    return redirect()->back()->with('success', __('comments.added'));
}


    // Menampilkan form edit komentar
    public function edit($id)
    {
        $comment = Comments::findOrFail($id); // Cari komentar berdasarkan ID
        // Tandai komentar sebagai sudah dibaca (read = true)
        if (!$comment->read) {
            $comment->update(['read' => true]);
        }
        return view('backend.comments.edit', compact('comment')); // Kirim data komentar ke view
    }

    // Mengupdate komentar
    public function update(Request $request, $id)
    {
        $comment = Comments::findOrFail($id); // Cari komentar berdasarkan ID

        // Validasi input
        $validated = $request->validate([
            'status' => 'required|string', // Status harus valid
        ]);

        // Update data komentar
        $comment->update([
           
            'status' => $validated['status'],
        ]);

       notify()->success(__('comments.updated'));
        return redirect()->route('comments.index')->with('success', __('comments.updated'));
    }


    // Menghapus komentar
    public function destroy($id)
    {
        $comment = Comments::findOrFail($id); 
        $comment->delete(); // Hapus komentar

       notify()->success(__('comments.deleted'));
        return redirect()->route('comments.index');

    }
    
}

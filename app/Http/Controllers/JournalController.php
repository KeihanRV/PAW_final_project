<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    public function index()
    {
        // Tampilkan 2 halaman per view
        $journals = Auth::user()->journals()->oldest()->paginate(2);
        return view('journal.index', compact('journals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'journal_date' => 'required|date',
            'tags' => 'nullable|string', 
            'content' => 'required|array', 
        ]);

        $tagsArray = json_decode($request->input('tags'), true) ?? [];
        $finalContent = [];
        $imageIndex = 0;

        if ($request->has('content')) {
            // Gunakan foreach dengan key agar aman
            foreach($request->input('content') as $key => $item) {
                
                // SAFETY CHECK: Lewati jika data rusak (tidak punya type)
                if (!isset($item['type'])) continue; 

                if($item['type'] === 'text') {
                    if(!empty($item['value'])) {
                        $finalContent[] = [
                            'type' => 'text', 
                            'value' => $item['value']
                        ];
                    }
                } 
                elseif($item['type'] === 'image') {
                    // Logic upload gambar
                    if($request->hasFile('images') && isset($request->file('images')[$imageIndex])) {
                        $file = $request->file('images')[$imageIndex];
                        $path = $file->store('journal-images', 'public');
                        
                        $finalContent[] = [
                            'type' => 'image',
                            'src' => $path,
                            'caption' => $item['caption'] ?? ''
                        ];
                        $imageIndex++;
                    }
                }
            }
        }

        $journal = Auth::user()->journals()->create([
            'title' => $request->input('title'),
            'journal_date' => $request->input('journal_date'),
            'tags' => $tagsArray,     
            'content' => $finalContent, 
        ]);

        // Return JSON untuk AJAX
        return response()->json([
            'status' => 'success',
            'message' => 'Journal saved successfully!',
            'journal_id' => $journal->id
        ]);
    }

    public function destroy(Journal $journal)
    {
        // Pastikan milik user sendiri
        if ($journal->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus file gambar dari storage
        if ($journal->content) {
            foreach ($journal->content as $item) {
                if (isset($item['type']) && $item['type'] === 'image' && !empty($item['src'])) {
                    Storage::disk('public')->delete($item['src']);
                }
            }
        }

        $journal->delete();

        // Redirect kembali ke halaman buku (page 1 biar aman)
        return redirect()->route('journal.index')->with('success', 'Page torn out successfully.');
    }
}
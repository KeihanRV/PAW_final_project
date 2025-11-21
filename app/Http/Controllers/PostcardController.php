<?php

namespace App\Http\Controllers;

use App\Models\Postcard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostcardController extends Controller
{
    // FORM ADMIN
    public function create()
    {
        return view('admin.postcard.create');
    }

    // PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'continent' => 'required',
            'city' => 'required',
            'country' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:40960',
        ]);

        // Simpan Gambar
        $imagePath = $request->file('image')->store('postcards', 'public');

        // Buat Slug (City-Country-Random)
        $slug = Str::slug($request->city . '-' . $request->country . '-' . Str::random(4));

        Postcard::create([
            'continent' => $request->continent,
            'city' => $request->city,
            'country' => $request->country,
            'description' => $request->description,
            'image' => 'storage/' . $imagePath, // Simpan path
            'slug' => $slug,
        ]);

        return redirect()->route('dashboard');
    }
    
    // SHOW (Detail untuk User)
    public function show(Postcard $postcard)
    {
        return view('postcard.show', compact('postcard'));
    }

    public function adminIndex()
    {
        // 1. Ambil semua postcard untuk list di bawah
        $postcards = Postcard::latest()->get();

        // 2. Hitung Statistik untuk "ARCH SO FAR" box
        $stats = [
            'europe'   => Postcard::where('continent', 'Classic of Europe')->count(),
            'america'  => Postcard::where('continent', 'Classic of America')->count(),
            'asia'     => Postcard::where('continent', 'Classic of Asia')->count(),
            'africa'   => Postcard::where('continent', 'Classic of Africa')->count(),
            
            // Menghitung User vs Admin (Asumsi role selain admin adalah user)
            'users'    => \App\Models\User::where('role', '!=', 'admin')->count(),
            'admins'   => \App\Models\User::where('role', 'admin')->count(),
            
            // Total Postcard
            'total'    => Postcard::count(),
        ];

        return view('admin.dashboard', compact('postcards', 'stats'));
    }

    // UPDATE DATA
    public function update(Request $request, Postcard $postcard)
    {
        $request->validate([
            'continent' => 'required',
            'city' => 'required',
            'country' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:40960', // Image jadi nullable (boleh kosong jika tidak ganti gambar)
        ]);

        // Data yang mau diupdate
        $data = [
            'continent' => $request->continent,
            'city' => $request->city,
            'country' => $request->country,
            'description' => $request->description,
        ];

        // Cek jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $oldPath = str_replace('storage/', '', $postcard->image);
            if(Storage::disk('public')->exists($oldPath)){
                Storage::disk('public')->delete($oldPath);
            }
            // Upload gambar baru
            $path = $request->file('image')->store('postcards', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $postcard->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Postcard updated!');
    }

    // HAPUS DATA
    public function destroy(Postcard $postcard)
    {
        // 1. Hapus file gambar dari folder storage (agar tidak menumpuk sampah)
        if ($postcard->image) {
            // Ubah path 'storage/postcards/...' menjadi 'postcards/...'
            $relativePath = str_replace('storage/', '', $postcard->image);
            
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }

        // 2. Hapus data dari database
        $postcard->delete();

        // 3. Kembali ke dashboard
        return redirect()->route('admin.dashboard')->with('success', 'Postcard deleted successfully!');
    }
}
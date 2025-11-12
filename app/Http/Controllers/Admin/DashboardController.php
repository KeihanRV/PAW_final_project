<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard khusus Admin.
     */
    public function index()
    {
        // Data sederhana yang bisa Anda tampilkan di dashboard
        $data = [
            'total_users' => \App\Models\User::count(),
            // Anda bisa tambahkan statistik lain di sini (misalnya total produk, pesanan, dll.)
        ];

        // Mengarahkan ke view admin dashboard
        return view('admin.dashboard', compact('data'));
    }
}
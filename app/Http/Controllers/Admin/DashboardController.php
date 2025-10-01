<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Nanti kita bisa mengirim data ke view ini, seperti jumlah produk, dll.
        return view('admin.dashboard');
    }
}
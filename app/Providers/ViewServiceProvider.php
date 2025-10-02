<?php

namespace App\Providers;

use App\Models\Category; // <-- Import model Category
use Illuminate\Support\Facades\View; // <-- Import facade View
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Menggunakan closure based composers...
        // Perintah ini berarti: "Setiap kali view 'layouts.partials.frontend-navbar' akan di-render..."
        View::composer('layouts.partials.frontend-navbar', function ($view) {
            // "...sertakan variabel 'categories' yang berisi semua data kategori."
            $view->with('categories', Category::all());
        });
    }
}
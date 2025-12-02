<?php

namespace App\Providers;

use App\Models\Brand;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Menu kategori 1
        View::composer('layout.partials.header', function ($view) {
            $brandsCategory1 = Brand::where('category_id', 1)
                ->orderBy('name_brand', 'asc')
                ->get()
                ->chunk(4);

            $view->with('brandChunksCategory1', $brandsCategory1);
        });

        // Menu kategori 2
        View::composer('layout.partials.header', function ($view) {
            $brandsCategory2 = Brand::where('category_id', 2)
                ->orderBy('name_brand', 'asc')
                ->get()
                ->chunk(4);

            $view->with('brandChunksCategory2', $brandsCategory2);
        });

        // Menu kategori 3
        View::composer('layout.partials.header', function ($view) {
            $brandsCategory3 = Brand::where('category_id', 3)
                ->orderBy('name_brand', 'asc')
                ->get()
                ->chunk(4);

            $view->with('brandChunksCategory3', $brandsCategory3);
        });
    }
}

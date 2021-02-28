<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeAdminDashboard();
        $this->composeProductForm();
    }

    /**
     * Compose Admin Dashboard
     */
    private function composeAdminDashboard(){
        View::composer(
            'admin.dashboard',
            function($view){
                $view->with([
                    'products' => Product::all()->count(),
                    'active' => Product::where('active',1)->count(),
                    'inactive' => Product::where('active',0)->count(),
                    'users' => User::all()->count(),
                    'categories' => Category::all()->count(),
                    'orders' => Order::all()->count(),
                ]);
            }
        );
    }

    /**
     * Compose Create/Edit Product Form
     */
    private function composeProductForm(){
        View::composer(
            'admin.products.form',
            function($view){
                $view->with([
                    'categories' => Category::all(),
                ]);
            }
        );
    }
}

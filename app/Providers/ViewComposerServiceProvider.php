<?php

namespace App\Providers;

use App\Helpers\ListHelper;
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
        $newUsers = ListHelper::getModelCountFrom(User::class,30);
        $newProducts = ListHelper::getModelCountFrom(Product::class,30);
        View::composer(
            'admin.dashboard',
            function($view) use ($newUsers,$newProducts){
                $view->with([
                    'products' => Product::all()->count(),
                    'active' => Product::where('active',1)->count(),
                    'inactive' => Product::where('active',0)->count(),
                    'users' => User::all()->count(),
                    'categories' => Category::all()->count(),
                    'orders' => Order::all()->count(),
                    'newUsers' => $newUsers,
                    'userIncreasePercentage' => ListHelper::increasePercentage($newUsers,ListHelper::getModelCountUpto(User::class,30)),
                    'newProducts' => $newProducts,
                    'productIncreasePercentage' => ListHelper::increasePercentage($newProducts,ListHelper::getModelCountUpto(Product::class,30)),
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

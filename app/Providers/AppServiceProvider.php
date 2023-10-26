<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Customer::creating(function ($customer){
            $customer->created_by=auth()->id();
        });
        Customer::updating(function ($customer){
            $customer->updated_by=auth()->id();
//            $customer->updated_at =Carbon::now();
        });
        Customer::updating(function ($customer){
           $customer->updated_at =Carbon::now();
        });
        Unit::creating(function ($unit){
            $unit->created_by=auth()->id();
        });
        Unit::updating(function ($unit){
            $unit->updated_by=auth()->id();
        });
        Unit::updating(function ($unit){
            $unit->updated_at=Carbon::now();
        });

        Supplier::creating(function ($supplier){
            $supplier->created_by=auth()->id();
        });
        Supplier::updating(function ($supplier){
            $supplier->updated_by=auth()->id();
//            $customer->updated_at =Carbon::now();
        });
        Supplier::updating(function ($supplier){
            $supplier->updated_at =Carbon::now();
        });
        Category::updating(function ($category){
            $category->updated_by=auth()->id();
        });
        Category::creating(function ($category){
            $category->created_by=auth()->id();
        });
    }
}

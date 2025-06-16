<?php

namespace App\Providers;

use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\MaterialPurchaseItemRepositoryInterface;
use App\Interfaces\MaterialPurchaseRepositoryInterface;
use App\Interfaces\MaterialRepositoryInterface;
use App\Interfaces\ProductMaterialRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\PromotionRepositoryInterface;
use App\Interfaces\SalesProductsRepositoryInterface;
use App\Interfaces\SalesRepositoryInterface;
use App\Interfaces\ShippingRepositoryInterface;
use App\Interfaces\StockRepositoryInterface;
use App\Interfaces\SupplierRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ClientRepository;
use App\Repositories\MaterialPurchaseItemRepository;
use App\Repositories\MaterialPurchaseRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\ProductMaterialRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\SalesProductsRepository;
use App\Repositories\SalesRepository;
use App\Repositories\ShippingRepository;
use App\Repositories\StockRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);

        $this->app->bind(ShippingRepositoryInterface::class, ShippingRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
        $this->app->bind(SalesRepositoryInterface::class, SalesRepository::class);
        $this->app->bind(SalesProductsRepositoryInterface::class, SalesProductsRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(MaterialRepositoryInterface::class, MaterialRepository::class);
        $this->app->bind(MaterialPurchaseRepositoryInterface::class, MaterialPurchaseRepository::class);
        $this->app->bind(MaterialPurchaseItemRepositoryInterface::class, MaterialPurchaseItemRepository::class);
        $this->app->bind(ProductMaterialRepositoryInterface::class, ProductMaterialRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

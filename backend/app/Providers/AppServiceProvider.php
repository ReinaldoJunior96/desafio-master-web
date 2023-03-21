<?php

namespace App\Providers;

use App\Contracts\PedidoInterface;
use App\Contracts\ProdutoInterface;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Repositories\PedidoRepository;
use App\Repositories\ProdutoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->when(ProdutoController::class)
            ->needs(ProdutoInterface::class)
            ->give(ProdutoRepository::class);

        $this->app->when(PedidoController::class)
            ->needs(PedidoInterface::class)
            ->give(PedidoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

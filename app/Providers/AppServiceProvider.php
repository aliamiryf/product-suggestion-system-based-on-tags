<?php

namespace App\Providers;

use App\Lib\Classes\Services\v1\Auth\AuthWithEmailPasswordService;
use App\Lib\Classes\Services\v1\Encryptor\JwtEncryptor;
use App\Lib\Classes\Services\v1\Product\ProductService;
use App\Lib\Classes\Services\v1\Suggestion\SuggestionService;
use App\Lib\Classes\Services\v1\User\UserService;
use App\Lib\Interfaces\AuthInterface;
use App\Lib\Interfaces\EncryptorInterface;
use App\Lib\Interfaces\ProductServiceInterface;
use App\Lib\Interfaces\SuggestionServiceInterface;
use App\Lib\Interfaces\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthWithEmailPasswordService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(EncryptorInterface::class, JwtEncryptor::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(SuggestionServiceInterface::class, SuggestionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

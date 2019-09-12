<?php

namespace Uccello\DocumentDesigner\Providers;

use Illuminate\Support\ServiceProvider;
use Uccello\DocumentDesigner\Console\Commands\DocumentGenerate;

/**
 * App Service Provider
 */
class AppServiceProvider extends ServiceProvider
{
  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;

  public function boot()
  {
    // Views
    $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'document-designer');

    // Translations
    $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'document-designer');

    // Migrations
    $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

    // Routes
    $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

    // Publish assets
    $this->publishes([
      __DIR__ . '/../../public' => public_path('vendor/uccello/document-designer'),
    ], 'document-designer-assets');

    // Commands
    if ($this->app->runningInConsole()) {
      $this->commands([
        DocumentGenerate::class,
      ]);
    }

  }

  public function register()
  {

  }
}
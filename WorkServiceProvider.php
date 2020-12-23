<?php

namespace Foostart\Work;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL,
    Route;
use Illuminate\Http\Request;

class WorkServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {

        //generate context key
//        $this->generateContextKey();

        // load view
        $this->loadViewsFrom(__DIR__ . '/Views', 'package-work');

        // include view composers
        require __DIR__ . "/composers.php";

        // publish config
        $this->publishConfig();

        // publish lang
        $this->publishLang();

        // publish views
        $this->publishViews();

        //public assets
        $this->publishAssets();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';
    }

    /**
     * Public config to system
     * @source: vendor/foostart/package-work/config
     * @destination: config/
     */
    protected function publishConfig() {
        $this->publishes([
            __DIR__ . '/config/package-work.php' => config_path('package-work.php'),
                ], 'config');
    }

    /**
     * Public language to system
     * @source: vendor/foostart/package-work/lang
     * @destination: resources/lang
     */
    protected function publishLang() {
        $this->publishes([
            __DIR__ . '/lang' => base_path('resources/lang'),
        ]);
    }

    /**
     * Public view to system
     * @source: vendor/foostart/package-work/Views
     * @destination: resources/views/vendor/package-work
     */
    protected function publishViews() {

        $this->publishes([
            __DIR__ . '/Views' => base_path('resources/views/vendor/package-work'),
        ]);
    }

    /** Public assets to system
    * @source: vendor/foostart/package-work/public/assets
    * @destination: public/package/foostart
    */
    protected function publishAssets()
    {
        $this->publishes([
                     __DIR__ . '/public/assets' => public_path('packages/foostart'),
        ]);

    }

}
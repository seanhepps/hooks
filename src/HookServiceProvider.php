<?php

namespace seanhepps\hooks;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hook', function($app) {
            return new Hook();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 注册blade模板方法
        Blade::directive('action', function($exp) {
            return "<?php Hook::action({$exp}); ?>";
        });

        Blade::directive('filter', function($exp) {
            return "<?php echo Hook::filter({$exp}); ?>";
        });
    }
}

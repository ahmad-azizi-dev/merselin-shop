<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class rtl extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('rtl', function ($classes) {
            $classes = explode(',',str_replace(' ', '', $classes));
            if (!empty($classes[1]))
                return "<?php if (app()->getLocale() === 'fa'){echo $classes[0];}else{echo $classes[1];} ?>";

            return "<?php if (app()->getLocale() === 'fa'){echo $classes[0];} ?>";
        });
    }
}

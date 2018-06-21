<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* @percent($var1,$var2) */
        \Blade::extend(function($view)
        {
            return preg_replace('/\@percent\(([0-9]+),([0-9]+)\)/', '<?php echo ((${1} * 100) / ${2}); ?>', $view);
        });
    }

    public function register()
    {
        //
    }
}
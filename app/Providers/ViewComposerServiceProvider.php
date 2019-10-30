<?php
namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(
             'admin.index', 'App\Http\Composers\AdminComposer'
        );


    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}

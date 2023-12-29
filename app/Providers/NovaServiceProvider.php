<?php

namespace App\Providers;

use App\Nova\CustomTab;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Dashboard;
use App\Models\Design;
use Laravel\Nova\Events\ServingNova;
use App\Nova\Floor;
use App\Nova\Room;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::serving(static function (ServingNova $event): void {
            Nova::remoteScript(asset('form.js'));
            Nova::remoteScript(asset('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'));
        });
        
        Design::saving(function ($design) {
            
            $pairs = [];
            $pairs[] = ['srSam70', 'mrSam70'];
            $pairs[] = ['srIzospanAM', 'mrIzospanAM'];
            $pairs[] = ['srIzospanAM35', 'mrIzospanAM35'];
            $pairs[] = ['srLenta', 'mrLenta'];
            $pairs[] = ['srRokvul', 'mrRokvul'];
            $pairs[] = ['srIzospanB', 'mrIzospanB'];
            $pairs[] = ['srIzospanB35', 'mrIzospanB35'];
            
            foreach ($pairs as $pair) {
                $first = $pair[0];
                $second = $pair[1];
                if (!empty($design->$first) && empty($design->$second)) {
                $design->$second = $design->$first;
                }
                if (!empty($design->$second) && empty($design->$second)) {
                $design->$first = $design->$second;
                }
            }
            // Check if mrSam70 is empty and srSam70 is not, then pair them up
            // Add more conditions for other fields as needed
            //$design->setTitle($design);
        });
        
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
	    return [
            new CustomTab(),
	    ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::resources([
            Floor::class,
            Room::class
        ]);
    }
}

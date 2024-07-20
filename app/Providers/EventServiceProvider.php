<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Models\EnlaceModulo;
use App\Models\Modulos;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [SendEmailVerificationNotification::class],
    ];

    protected $user_id;

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            $this->user_id = Auth::user()->id;
            $user = Auth::user();
            $permissionNames = $user->getPermissionsViaRoles();

            $modulos = DB::table('modulos_enlace')->whereIn('enlace_permiso', $permissionNames->pluck('name')->toArray())->get()->groupBy('modulo_nombre');

            $items = $modulos->map(function ($page, $user_id) {
                $submenu = $page->map(function ($page, $user_id) {
                    $parametros = str_replace('user_id', strval($this->user_id), $page->enlace_parametro);
                    return [
                        'text' => $page->enlace_titulo,
                        'route' => [$page->enlace_enlace, ['evalaudor', $parametros]],
                        'classes' => 'text-yellow',
                    ];
                });
                //dd($submenu->toArray());

                $menu = [
                    'text' => $page[0]->modulo_nombre,
                    'icon' => $page[0]->modulo_icono,
                    'submenu' => $submenu->toArray(),
                    'classes' => 'd-flex text-end',
                ];
                return $menu;
            });
            //dd(array_values($items->toArray()));
            $event->menu->add(...array_values($items->toArray()));
        });
    }
}

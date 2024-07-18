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

            $mapped = Arr::map($permissionNames->pluck('name')->toArray(), function (string $value, string $key) {
                return explode('#', $value)[0];
            });
            $nombres = array_values(array_unique($mapped));

            $enlaces = Modulos::with('enlaces')->select('id', 'nombre', 'permiso', 'icono', 'color')->whereIn('permiso', $nombres)->orderBy('nombre')->get();
            $items = $enlaces->map(function (Modulos $page, $user_id) {
                $submenu = $page->enlaces->map(function (EnlaceModulo $elemento, $user_id) {
                    $parametros = str_replace('user_id', strval($this->user_id), $elemento['parametro']);
                    return [
                        'text' => $elemento['titulo'],
                        'route' => [$elemento['enlace'], ['evalaudor', $parametros ]],
                        'classes' => 'text-yellow',
                    ];
                });
                //dd($submenu->toArray());
                $menu = [
                    'icon' => $page['icono'],
                    'text' => $page['nombre'],
                    'submenu' => $submenu->toArray(),
                    'classes' => 'd-flex text-end',
                ];
                //dd($menu);
                return $menu;
            });
            //dd($items);
            $event->menu->add(...$items);
        });
    }
}

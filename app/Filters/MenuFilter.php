<?php

namespace App\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;

class MenuFilter implements FilterInterface
{
    public function transform($item)
    {
     

        return $item;
    }
}
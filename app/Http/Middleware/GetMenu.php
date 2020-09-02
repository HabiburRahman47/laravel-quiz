<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Menus\GetSidebarMenu;
use App\Models\Menulist;
use App\Models\RoleHierarchy;
use Spatie\Permission\Models\Role;

class GetMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = "any";
        $menus = new GetSidebarMenu();
        $menuLists = $this->getMenuLists();

        $result = array();
        foreach ($menuLists as $menuList) {
            $result[$menuList->name] = $menus->get($role, $menuList->id);
        }
        view()->share('appMenus', $result);
        return $next($request);
    }

    private function getMenuLists()
    {
        $sidebarMenu = ["id" => 1, "name" => "sidebar menu"];
        $topMenu = ["id" => 2, "name" => "top menu"];
        $menuListItems = [$sidebarMenu, $topMenu];
        return $this->buildMenuList($menuListItems);
    }

    /**
     * @param $menuListItemsData
     * @return Collection
     */
    private function buildMenuList($menuListItemsData): Collection
    {
        $menuListCollection = new Collection();
        foreach ($menuListItemsData as $menuListItemData) {
            $menuList = new Menulist();
            $menuList->fill($menuListItemData);
            $menuListCollection->add($menuList);
        }
        return $menuListCollection;
    }
}
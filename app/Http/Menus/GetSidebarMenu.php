<?php
/*
*   07.11.2019
*   MenusMenu.php
*/

namespace App\Http\Menus;

use App\MenuBuilder\MenuBuilder;
use Illuminate\Support\Collection;
use App\Models\Menus;
use App\MenuBuilder\RenderFromDatabaseData;

class GetSidebarMenu implements MenuInterface
{

    private $mb; //menu builder
    private $menu;

    public function __construct()
    {
        $this->mb = new MenuBuilder();
    }

    private function getMenuFromDB($menuId, $menuName)
    {
        $this->menu = $this->getAppMenu($menuId);
    }

    private function getAppMenu($menuId): Collection
    {
        $menuToBuild = null;
        $dashboard = ["id" => 1, "parent_id" => null, "name" => "Dashboard", "href" => "/", "icon" => "cil-speedometer", "slug" => "link"];
        //
        $settings = ["id" => 10, "parent_id" => null, "name" => "Settings", "href" => null, "icon" => "cil-calculator", "slug" => "dropdown"];
        $settingsNotes = ["id" => 11, "parent_id" => $settings["id"], "name" => "Notes", "href" => "/notes", "icon" => null, "slug" => "link"];
        $settingsEmail = ["id" => 12, "parent_id" => $settings["id"], "name" => "Email", "href" => "/mail", "icon" => null, "slug" => "link",];
        //
        $themeSection = ["id" => 19, "parent_id" => null, "name" => "Theme", "href" => null, "icon" => null, "slug" => "title",];
        $color = ["id" => 20, "parent_id" => null, "name" => "Colors", "href" => "/colors", "icon" => "cil-drop1", "slug" => "link"];

        $leftMenuData = [$dashboard, $settings, $settingsNotes, $settingsEmail, $themeSection, $color];
        //
        $topMenuData = [$dashboard, $settings, $settingsNotes, $settingsEmail];


        if ($menuId == 1) {
            return $this->buildMenu($leftMenuData, $menuId);
        }
        return $this->buildMenu($topMenuData, $menuId);

    }

    public function get($role, $menuId = 2)
    {
        $this->getMenuFromDB($menuId, $role);
        $rfd = new RenderFromDatabaseData;
        return $rfd->render($this->menu);
        /*
        $roles = explode(',', $roles);
        if(empty($roles)){
            $this->getGuestMenu( $menuId );
        }elseif(in_array('admin', $roles)){
            $this->getAdminMenu( $menuId );
        }elseif(in_array('user', $roles)){
            $this->getUserMenu( $menuId );
        }else{
            $this->getGuestMenu( $menuId );
        }
        $rfd = new RenderFromDatabaseData;
        return $rfd->render($this->menu);
        */
    }

    /**
     * @param $menuItemsData
     * @param $menuId
     * @return Collection
     */
    private function buildMenu($menuItemsData, $menuId): Collection
    {
        $menuCollection = new Collection();
        $sequence = 1;
        foreach ($menuItemsData as $menuItemData) {
            $menu = new Menus();
            $menu->fill($menuItemData);
            $menu->menu_id = $menuId;
            $menu->sequence = $sequence++;
            $menuCollection->add($menu);
        }
        return $menuCollection;
    }
}

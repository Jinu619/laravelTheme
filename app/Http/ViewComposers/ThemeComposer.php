<?php

namespace App\Http\ViewComposers;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Submenu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

class ThemeComposer
{
    public function __construct()
    {
    }

    public function userIcon(View $view)
    {

        $user = \auth()->user();
        $text = " ";
        if ($user) {
            $name = $user->user_name;
            if (strlen($name) == 1) {
                $text = $name . $name;
            } else if (strlen($name) == 2) {
                $text = $name;
            } else {
                $keywords = preg_split("/[\s,\.\_\-]+/", $name);
                $keywords = array_filter($keywords);
                if (sizeof($keywords) > 1) {
                    $text = $keywords[0][0] . $keywords[1][0];
                } else {
                    $text = $keywords[0][0] . $keywords[0][1];
                }
            }
        } else {
            $text = '  ';
        }
        $view->withUsericon('data:image/png;base64,' . $this->base64ImageFromLetters(strtoupper($text)));
    }

    public function compose(View $view)
    {
        $user_id = auth()->id();
        $user_type = auth()->user()->usertype;
        $segment = Request::segment(1);
        if (!$segment) $segment = "/";
        $user = \auth()->user();
        $mainmenu = (new Menu)->where('link', $segment)->first();
        $submenu = (new Submenu)->where('link', $segment)->first();
        $permissiontable = (new Permission)->getTable();






        $branch_id = Auth::user()->branch_id;
        // $config = Configuration::where('configurations.branch_id', '=', $branch_id)->first();
        $config = [];

        $segment1 = (isset($submenu->menu_id)) ? $submenu->menu_id : (isset($mainmenu->id) ? $mainmenu->id : '');
        $segment2 = (isset($submenu->id)) ? $submenu->id : '';


        $menu = Menu::all()->sortBy('listing_order');
        $submenu = (new Submenu)->getTable();
        $menulist = [];

        foreach ($menu as $m) {
            $data = DB::table($permissiontable)
                ->join($submenu, "$submenu.id", "=", "$permissiontable.submenu_id")
                ->whereNull("$submenu.deleted_at")
                ->where("$submenu.menu_id", $m->id);
            $data = $data->select("$submenu.id", "$submenu.title", "$submenu.link", "$submenu.listing_order");
            if ($user_type != "superadmin") $data = $data->where("$permissiontable.user_id", $user_id);


            $data = $data->distinct()
                ->orderBy("$submenu.listing_order")
                ->get();
            if (count($data) >= 1 || $m->id == 1) {
                $menulist[] = array(
                    'id' => $m->id,
                    'title' => $m->title,
                    'link' => $m->link,
                    'icon' => $m->icon,
                    'submenus' => $data
                );
            }
        }
        $view->withMenus($menulist)->withActivemenu([$segment1, $segment2])->withAnotherArray($config);
    }
    private function base64ImageFromLetters($text = '  ')
    {
        $im = imagecreatetruecolor(75, 75);
        $background = imagecolorallocate($im, 200, 200, 200);
        $text_colour = imagecolorallocate($im, 34, 45, 50);
        imagefilledrectangle($im, 0, 0, 75, 75, $background);
        $font = public_path('font/Roboto-Black.ttf');
        // $font = '/home/wmsv4/public_html/font/Roboto-Black.ttf';
        // $font = "D:\\xampp-8\\htdocs\\service\\public\\font\\Roboto-Black.ttf";
        imagettftext($im, 36, 0, 8, 55, $text_colour, $font, $text);
        ob_start();
        imagepng($im);
        $final_image = ob_get_contents();
        ob_end_clean();
        imagedestroy($im);
        $base64Img = base64_encode($final_image);
        return $base64Img;
    }
}

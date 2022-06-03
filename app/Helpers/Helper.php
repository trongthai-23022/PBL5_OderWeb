<?php


namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function categories($categories, $parent_id = 0) :string
    {
        $html = '';
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                    <li class="category-item has-child-cate ">
                        <a class="cate-link" href="/shop/' . $category->id . '-' . Str::slug($category->name, '-') . '.html" >
                            ' . $category->name . '
                        ';

                unset($categories[$key]);

                if (self::isChild($categories, $category->id)) {
                    $html .= '</a><span class="toggle-control">+</span>';
                    $html .= '<ul class="sub-cate">';
                    $html .= self::categories($categories, $category->id);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }
    public static function menus($menus, $parent_id = 0) :string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li class="menu-item">
                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html" class="link-term">
                            ' . $menu->name . '
                        </a>';

                unset($menus[$key]);

                if (self::isChild($menus, $menu->id)) {
                    $html .= '<span class="nav-label hot-label">hot</span>';
                    $html .= '<ul class=" Can 1 class kieu dropdown">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id) : bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }

        return false;
    }

//    public static function price($price = 0, $priceSale = 0)
//    {
//        if ($priceSale != 0) return number_format($priceSale);
//        if ($price != 0)  return number_format($price);
//        return '<a href="/lien-he.html">Liên Hệ</a>';
//    }
}

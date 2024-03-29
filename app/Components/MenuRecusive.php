<?php

namespace App\Components;

use App\Models\Menu;

class MenuRecusive
{
    private $html = '';

    public function __construct()
    {
        $this->html = '';
    }

    public function menuRecusiveAdd($parent_id = 0, $subMark = ''){
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach($data as $dataItem){
            $this->html .= "<option value='" . $dataItem->id . "'>" . $subMark . $dataItem->menu_name . "</option>";
            $this->menuRecusiveAdd($dataItem->id, $subMark . '- ' );
        }

        return $this->html;
    }

    public function menuRecusiveEdit($parentId, $parent_id = 0, $subMark = ''){
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach($data as $dataItem){
            if ($parentId == $dataItem->id) {
                $this->html .= "<option selected value='" . $dataItem->id . "'>" . $subMark . $dataItem->menu_name . "</option>";
            }else{
                $this->html .= "<option value='" . $dataItem->id . "'>" . $subMark . $dataItem->menu_name . "</option>";
            }
            $this->menuRecusiveEdit($parentId, $dataItem->id, $subMark . '- ' );
        }

        return $this->html;
    }
    
}

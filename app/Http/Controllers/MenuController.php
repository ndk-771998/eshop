<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Traits\DeleteModelTrait;

class MenuController extends Controller
{
    use DeleteModelTrait;

    public function __construct(MenuRecusive $menuRecusive, Menu $menu)
    {
        $this->menuRecusive = $menuRecusive;   
        $this->menu = $menu;
    }

    public function index(){
        $menus = $this->menu->latest()->paginate(5);
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $optionSelect = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menu.create', compact('optionSelect'));
    }

    public function store(Request $request){
        $this->menu->create([
            'menu_name' => $request->menu_name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->menu_name)
        ]);

        return redirect()->route('menus.index');
    }

    public function edit($id){
        $menu = $this->menu->find($id);
        $menuList = $this->getMenu($menu->parent_id);
        return view('admin.menu.edit', compact('menu', 'menuList'));
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->menu);
    }

    public function update($id, Request $request){
        $this->menu->find($id)->update([
            'menu_name' => $request->menu_name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->menu_name)
        ]);

        return redirect()->route('menus.index');
    }

    public function getMenu($parent_id){
        $data = $this->menu->all(); 
        $recusive = new MenuRecusive($data);
        $menuList = $recusive->menuRecusiveEdit($parent_id);

        return $menuList;
    }
}

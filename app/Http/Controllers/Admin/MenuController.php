<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::where('is_show', 1)->get();
        $menu_not = Menu::where('is_show', 0)->get();

        return view('admin.menu.menu', compact('menu', 'menu_not'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.menu-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Menu::create([
            'menu_name_ru' => $request->menu_name_ru,
            'menu_name_kz' => $request->menu_name_kz,
            'menu_name_en' => $request->menu_name_en,
            'menu_url' => $request->menu_url,
            'is_show_main' => $request->is_show_main,
            'is_show' => $request->is_show,
            'is_sub' => $request->is_sub,
            'sort_num' => $request->sort_num,
            'main_menu_id' => $request->main_menu_id,
            'menu_page_id' => $request->menu_page_id
        ]);

        return redirect('/admin/menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.menu-edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update([
            'menu_name_ru' => $request->menu_name_ru,
            'menu_name_kz' => $request->menu_name_kz,
            'menu_name_en' => $request->menu_name_en,
            'menu_url' => $request->menu_url,
            'is_show_main' => $request->is_show_main,
            'is_show' => $request->is_show,
            'is_sub' => $request->is_sub,
            'sort_num' => $request->sort_num,
            'main_menu_id' => $request->main_menu_id,
            'menu_page_id' => $request->menu_page_id
        ]);

        return redirect("/admin/menu");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
    }
}

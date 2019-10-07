<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Helpers;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::where('pages.is_show', 1)->get();

        $page_not_show = Page::where('pages.is_show', 0)->get();    
                            
        return view('admin.pages.pages', compact('page','page_not_show'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.pages-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        //Ru
        $page->page_name_ru = $request->page_name_ru;
        $page->page_content_ru = $request->page_content_ru;
        //Kz
        $page->page_name_kz = (!empty($request->page_name_kz)) ? $request->page_name_kz : $request->page_name_ru;
        $page->page_content_kz = (!empty($request->page_content_kz)) ? $request->page_content_kz : $request->page_content_ru;
        //En
        $page->page_name_en = (!empty($request->page_name_en)) ? $request->page_name_en : $request->page_name_ru;
        $page->page_content_en = (!empty($request->page_content_en)) ? $request->page_content_en : $request->page_content_ru;

        $page->is_show = $request->is_show;
        $page->save();

        return redirect('/admin/pages');
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
    public function edit($id)
    {
        $page = Page::find($id);

        return view('admin.pages.pages-edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Page::where('page_id', $id)
        ->update([
            'page_name_ru' => $request->page_name_ru,
            'page_name_kz' => $request->page_name_kz,
            'page_name_en' => $request->page_name_en,
            'page_content_ru' => $request->page_content_ru,
            'page_content_kz' => $request->page_content_kz,
            'page_content_en' => $request->page_content_en,
            'is_show' => $request->is_show
        ]);

        return redirect("/admin/pages");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete(); 
    }
}

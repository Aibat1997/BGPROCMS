<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

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

        return view('admin.pages.pages', compact('page', 'page_not_show'));
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
        Page::create([
            'page_name_ru' => $request->page_name_ru,
            'page_content_ru' => $request->page_content_ru,
            'page_name_kz' => $request->page_name_kz,
            'page_content_kz' => $request->page_content_kz,
            'page_name_en' => $request->page_name_en,
            'page_content_en' => $request->page_content_en,
            'is_show' => $request->is_show
        ]);

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
    public function edit(Page $page)
    {
        return view('admin.pages.pages-edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $page->update([
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
    public function destroy(Page $page)
    {
        $page->delete();
    }
}

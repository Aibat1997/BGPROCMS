<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Helpers;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::where('is_show', 1)->get();
        $banner_not = Banner::where('is_show', 0)->get();

        return view('admin.banner.banner', compact('banner', 'banner_not'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.banner-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('banner_image')) {
            $result = Helpers::storeImg('banner_image', 'image', $request);
        }

        $banner = Banner::create([
            'banner_image' => $result,
            'banner_name' => $request->banner_name,
            'banner_url' => $request->banner_url,
            'banner_rubric_id' => $request->banner_rubric_id,
            'is_show' => $request->is_show
        ]);

        $banner->positions()->sync($request->news_position);

        return redirect('/admin/banner');
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
    public function edit(Banner $banner)
    {
        return view('admin.banner.banner-edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        if ($request->hasFile('banner_image')) {
            $result = Helpers::storeImg('banner_image', 'image', $request);
        } else {
            $result = $banner->banner_image;
        }

        $banner->update([
            'banner_image' => $result,
            'banner_name' => $request->banner_name,
            'banner_url' => $request->banner_url,
            'banner_rubric_id' => $request->banner_rubric_id,
            'is_show' => $request->is_show
        ]);

        $banner->positions()->sync($request->news_position);

        return redirect("/admin/banner");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
    }
}

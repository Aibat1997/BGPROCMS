<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Http\Helpers;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::where('is_show', 1)->get();
        $slider_not = Slider::where('is_show', 0)->get();

        return view('admin.slider.slider', compact('slider', 'slider_not'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.slider-edit');
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
            'slider_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('slider_image')) {
            $result = Helpers::storeImg('slider_image', 'image', $request);
        }

        Slider::create([
            'slider_text_ru' => $request->slider_text_ru,
            'slider_text_kz' => $request->slider_text_kz,
            'slider_text_en' => $request->slider_text_en,
            'slider_image' => $result,
            'slider_url' => $request->slider_url,
            'slider_position' => $request->slider_position,
            'sort_num' => $request->sort_num,
            'is_show' => $request->is_show
        ]);

        return redirect('/admin/slider');
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
    public function edit(Slider $slider)
    {
        return view('admin.slider.slider-edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        if ($request->hasFile('slider_image')) {
            $result = Helpers::storeImg('slider_image', 'image', $request);
        } else {
            $result = $slider->slider_image;
        }

        $slider->update([
            'slider_text_ru' => $request->slider_text_ru,
            'slider_text_kz' => $request->slider_text_kz,
            'slider_text_en' => $request->slider_text_en,
            'slider_image' => $result,
            'slider_url' => $request->slider_url,
            'slider_position' => $request->slider_position,
            'sort_num' => $request->sort_num,
            'is_show' => $request->is_show,
        ]);

        return redirect("/admin/slider");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
    }
}

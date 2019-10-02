<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Http\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::where('is_show',1)
                    ->leftJoin('positions','positions.position_id','=','sliders.slider_id')
                    ->get();

        $slider_not = Slider::where('is_show',0)
                    ->leftJoin('positions','positions.position_id','=','sliders.slider_id')
                    ->get();            
                    
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
            'slider_image_ru' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image_kz' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image_en' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('slider_image_ru')) {
            $result_ru = Helpers::storeImg('slider_image_ru', 'image', $request); 
        }
        if ($request->hasFile('slider_image_kz')) {
            $result_kz = Helpers::storeImg('slider_image_kz', 'image', $request);
        }else {
            $result_kz = $result_ru;
        }
        if ($request->hasFile('slider_image_en')) {
            $result_en = Helpers::storeImg('slider_image_en', 'image', $request);
        }else {
            $result_en = $result_ru;
        }

        $slider = new Slider();
        $slider->slider_text_ru = $request->slider_text_ru;
        $slider->slider_text_kz = (!empty($request->slider_text_kz)) ? $request->slider_text_kz : $request->slider_text_ru;
        $slider->slider_text_en = (!empty($request->slider_text_en)) ? $request->slider_text_en : $request->slider_text_ru;
        $slider->slider_image_ru = $result_ru;
        $slider->slider_image_kz = $result_kz;
        $slider->slider_image_en = $result_en;
        $slider->slider_url = $request->slider_url;
        $slider->slider_position = $request->slider_position;
        $slider->sort_num = $request->sort_num;
        $slider->is_show = $request->is_show;
        $slider->save();

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
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.slider-edit', compact('slider'));
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
        $request->validate([
            'slider_image_ru' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image_kz' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image_en' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $slider = Slider::find($id);

        if ($request->hasFile('slider_image_ru')) {
            $result_ru = Helpers::storeImg('slider_image_ru', 'image', $request);
        }else {
            $result_ru = $slider->slider_image_ru;
        }
        if ($request->hasFile('slider_image_kz')) {
            $result_kz = Helpers::storeImg('slider_image_kz', 'image', $request);
        }else {
            $result_kz = $slider->slider_image_kz;
        }
        if ($request->hasFile('slider_image_en')) {
            $result_en = Helpers::storeImg('slider_image_en', 'image', $request);
        }else {
            $result_en = $slider->slider_image_en;
        }

        Slider::where('slider_id', $id)
                ->update([
                    'slider_text_ru' => $request->slider_text_ru,
                    'slider_text_kz' => $request->slider_text_kz,
                    'slider_text_en' => $request->slider_text_en,
                    'slider_image_ru' => $result_ru,
                    'slider_image_kz' => $result_kz,
                    'slider_image_en' => $result_en,
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
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete(); 
    }
}

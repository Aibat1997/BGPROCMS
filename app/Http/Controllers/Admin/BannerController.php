<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::where('is_show',1)
                    ->leftJoin('rubrics','rubrics.rubric_id','=','banners.banner_rubric_id')
                    ->leftJoin('positions','positions.position_id','=','banners.banner_position_id')
                    ->get();

        $banner_not = Banner::where('is_show',0)
                    ->leftJoin('rubrics','rubrics.rubric_id','=','banners.banner_rubric_id')
                    ->leftJoin('positions','positions.position_id','=','banners.banner_position_id')
                    ->get();            
                    
        return view('admin.banner.banner', compact('banner','banner_not'));
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
            $image = $request->file('banner_image');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $image_name = $destinationPath . '/' . $image_name;

            if (Storage::disk('image')->exists($image_name)) {
                $now = \DateTime::createFromFormat('U.u', microtime(true));
                $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
            }

            Storage::disk('image')->put($image_name, File::get($image));
            $result = '/media' .$image_name;
        }

        $banner = new Banner();
        $banner->banner_image = $result;
        $banner->banner_name = $request->banner_name;
        $banner->banner_url = $request->banner_url;
        $banner->banner_rubric_id = $request->banner_rubric_id;
        $banner->banner_position_id = $request->banner_position_id;
        $banner->is_show = $request->is_show;
        $banner->save();

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
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.banner-edit', compact('banner'));
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
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = Banner::find($id);

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $image_name = $destinationPath . '/' . $image_name;

            if (Storage::disk('image')->exists($image_name)) {
                $now = \DateTime::createFromFormat('U.u', microtime(true));
                $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
            }

            Storage::disk('image')->put($image_name, File::get($image));
            $result = '/media' .$image_name;
        }else {
            $result = $banner->banner_image;
        }

        Banner::where('banner_id', $id)
                ->update([
                    'banner_image' => $result,
                    'banner_name' => $request->banner_name,
                    'banner_url' => $request->banner_url,
                    'banner_rubric_id' => $request->banner_rubric_id,
                    'banner_position_id' => $request->banner_position_id,
                    'is_show' => $request->is_show
                    ]);

        return redirect("/admin/banner"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete(); 
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Archive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archive = Archive::all();
        return view('admin.archive.archive', compact('archive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.archive.archive-edit');
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
            'archive_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'archive_file' => 'required|max:20048',
        ]);

        if ($request->hasFile('archive_image')) {
            $image = $request->file('archive_image');
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

        if ($request->hasFile('archive_file')) {
            $cover = $request->file('archive_file');
            $resultall = "";
            foreach ($cover as $coverone) {
                $file_name = $coverone->getClientOriginalName();
                $extension = $coverone->getClientOriginalExtension();

                $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');

                $file_name = $destinationPath . '/' . $file_name;

                if (Storage::disk('doc')->exists($file_name)) {
                    $now = \DateTime::createFromFormat('U.u', microtime(true));
                    $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
                }

                Storage::disk('doc')->put($file_name, File::get($coverone));
                $resultall .= '\'/media_doc' . $file_name.'\',';
            }
        }

        $archive = new Archive();
        $archive->archive_image = $result;
        $archive->archive_file = $resultall;
        $archive->is_show = $request->is_show;
        $archive->save();
        
        return redirect("/admin/archive");        
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
        $archive = Archive::find($id);        
        return view('admin.archive.archive-edit', compact('archive'));
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
            'archive_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'archive_file' => 'max:20048',
        ]);
        
        $archive = Archive::find($id);

        if ($request->hasFile('archive_image')) {
            $image = $request->file('archive_image');
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
            $result = $archive->archive_image;
        }

        if ($request->hasFile('archive_file')) {
            $cover = $request->file('archive_file');
            $resultall = "";
            foreach ($cover as $coverone) {
                $file_name = $coverone->getClientOriginalName();
                $extension = $coverone->getClientOriginalExtension();

                $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');

                $file_name = $destinationPath . '/' . $file_name;

                if (Storage::disk('doc')->exists($file_name)) {
                    $now = \DateTime::createFromFormat('U.u', microtime(true));
                    $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
                }

                Storage::disk('doc')->put($file_name, File::get($coverone));
                $resultall .= '\'/media_doc' . $file_name.'\',';
            }
        }else {
            $resultall = $archive->archive_file;
        }
        
        Archive::where('archive_id', $id)
                ->update([
                    'archive_image' => $result,
                    'archive_file' => $resultall,
                    'is_show' => $request->is_show
                    ]);

        return redirect("/admin/archive"); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $archive = Archive::find($id);
        $archive->delete(); 
    }
}

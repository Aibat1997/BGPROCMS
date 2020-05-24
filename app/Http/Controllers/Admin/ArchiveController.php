<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Http\Helpers;

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
            $result = Helpers::storeImg('archive_image', 'image', $request);
        }

        if ($request->hasFile('archive_file')) {
            $resultall = Helpers::storeFile('archive_file', 'doc', $request);
        }

        Archive::create([
            'archive_image' => $result,
            'archive_file' => $resultall,
            'is_show' => $request->is_show
        ]);

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
    public function edit(Archive $archive)
    {
        return view('admin.archive.archive-edit', compact('archive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        $request->validate([
            'archive_file' => 'max:20048',
        ]);

        if ($request->hasFile('archive_image')) {
            $result = Helpers::storeImg('archive_image', 'image', $request);
        } else {
            $result = $archive->archive_image;
        }

        if ($request->hasFile('archive_file')) {
            $resultall = Helpers::storeFile('archive_file', 'doc', $request);
        } else {
            $resultall = $archive->archive_file;
        }

        $archive->update([
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
    public function destroy(Archive $archive)
    {
        $archive->delete();
    }
}

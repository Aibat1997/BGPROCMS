<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function getImage($file_name)
    {
        $contents = Storage::disk('image')->path($file_name);
        return response()->file($contents);
    }

    public function getAvatar($file_name)
    {
        $contents = Storage::disk('avatar')->path($file_name);
        return response()->file($contents);
    }

    public function getFile($file_name)
    {
        $contents = Storage::disk('doc')->path($file_name);
        return response()->file($contents);
    }
}

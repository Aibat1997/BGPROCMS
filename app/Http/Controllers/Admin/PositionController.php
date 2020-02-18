<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Position;

class PositionController extends Controller
{
    public function index()
    {
        $position = Position::all();
        return view('admin.news-position', compact('position'));
    }

    public function store(Request $request)
    {
        $position = Position::updateOrCreate(
            ['position_id' => $request->position_id],
            [
                'position_name_ru' => $request->position_name_ru,
                'position_name_kz' => $request->position_name_kz,
                'position_name_en' => $request->position_name_en
            ]
        );

        if (!$request->has('position_id')) {
            return $position;
        }
    }

    public function destroy(Position $position)
    {
        $position->delete();
    }
}

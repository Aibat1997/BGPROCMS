<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rubric;

class RubricController extends Controller
{
    public function index()
    {
        $rubric = Rubric::all();
        return view('admin.rubric', compact('rubric'));
    }

    public function store(Request $request)
    {
        $rubric = Rubric::updateOrCreate(
            ['rubric_id' => $request->rubric_id],
            [
                'rubric_name_ru' => $request->rubric_name_ru,
                'rubric_name_kz' => $request->rubric_name_kz,
                'rubric_name_en' => $request->rubric_name_en
            ]
        );

        if (!$request->has('rubric_id')) {
            return $rubric;
        }
    }

    public function destroy(Rubric $rubric)
    {
        $rubric->delete();
    }
}

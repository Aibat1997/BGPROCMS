<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $primaryKey = 'slider_id';
    protected $guarded = [];

    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'slider_position', 'position_id');
    }
}

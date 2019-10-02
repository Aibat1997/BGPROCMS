<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $primaryKey = 'position_id';
    protected $guarded = [];
    
    public function news()
    {
        return $this->belongsToMany('App\Models\News', 'news_positions', 'np_position_id', 'np_news_id');
    }
    
    public function banners()
    {
        return $this->belongsToMany('App\Models\Banner', 'banner_positions', 'bp_position_id', 'bp_banner_id');
    }
}

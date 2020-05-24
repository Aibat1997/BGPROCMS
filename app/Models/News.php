<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'news_id';
    protected $guarded = [];
    
    public function positions()
    {
        return $this->belongsToMany('App\Models\Position', 'news_positions', 'np_news_id', 'np_position_id');
    }

    public function rubric()
    {
        return $this->belongsTo('App\Models\Rubric', 'news_rubric_id', 'rubric_id');
    }
}

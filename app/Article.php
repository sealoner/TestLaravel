<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //建立与Comment表的一对多关系
    public function hasManyComments() {
        return $this->hasMany('App\Comment','article_id','id');
    }
}

<?php

namespace Northstyle\Module\Content\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['author_id', 'title', 'content', 'published_at'];
    protected $dates = ['published_at'];

    public function setPublishedAtAttribute($value){
        $this->attributes['published_at'] = $value?:null;
    }
    public function author(){
        return $this->belongsTo(User::class);
    }
}

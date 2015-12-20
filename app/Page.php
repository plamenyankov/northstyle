<?php

namespace MMA;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','name','uri','content'];
}

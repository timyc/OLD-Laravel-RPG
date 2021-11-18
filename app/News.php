<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    Protected $table = 'news';
    Protected $primaryKey = 'id';
    Protected $fillable = ['author', 'title', 'content', 'posted'];
}

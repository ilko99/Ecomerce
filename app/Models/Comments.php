<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'blog_post_id'];

    public function blogPost(){
        return $this->belongsTo('App\models\BlogPost', '');
    }
}


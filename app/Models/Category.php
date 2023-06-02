<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'category_slag', 'category_image'];

    public function image(){
        return $this->morphOne('App\Models\Images', 'imageable');
    }

    public function subcategory(){
        return $this->hasMany('App\Models\SubCategory');
    }

    public static function boot()
    {
        parent::boot();

        // Generate slug before saving the model
        self::creating(function ($model) {
            $model->category_slag = Str::slug($model->category_name);
        });
    }
}

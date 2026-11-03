<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id_category';
    protected $fillable = ['name'];

    protected $table = 'categories';

    public function placeRecommendations()
    {
        return $this->belongsToMany(PlaceRecommendation::class, 'category_place_recommendation', 'id_category', 'id_recommendation');
    }
}

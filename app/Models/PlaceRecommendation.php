<?php

namespace App\Models;

use App\Models\CategoryPlaceRecommendation;
use Illuminate\Database\Eloquent\Model;

class PlaceRecommendation extends Model
{
    protected $primaryKey = 'id_recommendation';
    protected $fillable = [
        'name',
        'address',
        'description',
        'latitude',
        'longitude',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_place_recommendation', 'id_recommendation', 'id_category');
    }
}

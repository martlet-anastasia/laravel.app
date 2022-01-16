<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $fillable = ['name', 'logo', 'description', 'active', 'creation_year'];

    public function products() {
        return $this->hasMany(Product::class, 'brandID', 'id');
        // return $this->hasMany(Product::class);
    }

    public function latestProduct() {
        return $this->hasOne(Product::class)->latestOfMany();
    }

    public function image() {
        return $this->morphOne(image::class, 'imageable');
    }

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{

    protected $fillable = ['name', 'logo', 'description', 'active', 'creation_year'];

    protected $casts = [
        'creation_year' => 'integer'
    ];

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

    public function getNameAttribute() {
        return Str::ucfirst(Str::lower($this->attributes['name']));
        // dump($this->attributes);
    }

    public function getFullNameAttribute() {
        return 'ololo';
    }

    public function setNameAttribute($value) {
        if($value > 0) {
            $this->attributes['name'] = $value;
        }
    }

    use HasFactory;
}

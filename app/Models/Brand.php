<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'image',
        'status',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
       protected static function booted()
    {
        static::deleting(function ($brand) {
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }
        });
    }

    
}

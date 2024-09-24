<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'product_id']; // Allow mass assignment for these fields

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

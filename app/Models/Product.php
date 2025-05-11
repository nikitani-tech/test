<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'product_name',
        'slug',
        'price',
        'description',
        'stock',
        'sku',
        'created_at',
        'updated_at',
    ];

    protected static function boot(): void
    {
        parent::boot();
        // Automatically create/update slug and SKU
        static::creating(function ($product) {
            self::generateSlug($product);
            self::generateSku($product);
        });
        static::updating(function ($product) {
            self::generateSlug($product);
            self::generateSku($product);
        });
    }

    private static function generateSlug($product): void
    {
        $product->slug = Str::slug($product->product_name);
    }

    private static function generateSku($product): void
    {
        $product->sku = strtoupper(Str::slug($product->product_name)) . '-' . rand(100, 999);
    }
}

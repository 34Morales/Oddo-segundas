<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get all products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the stock movements for the category through products.
     */
    public function stockMovements()
    {
        return $this->hasManyThrough(StockMovement::class, Product::class);
    }

    /**
     * Get total products count for this category.
     */
    public function getTotalProductsAttribute()
    {
        return $this->products()->count();
    }

    /**
     * Get total stock value for this category.
     */
    public function getTotalStockValueAttribute()
    {
        return $this->products()->sum(\DB::raw('stock * price'));
    }

    /**
     * Scope a query to only include categories with products.
     */
    public function scopeHasProducts($query)
    {
        return $query->whereHas('products');
    }

    /**
     * Scope a query to search categories by name or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Get categories with low stock products.
     */
    public function scopeWithLowStock($query, $threshold = 10)
    {
        return $query->whereHas('products', function ($q) use ($threshold) {
            $q->where('stock', '<=', $threshold);
        });
    }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['sku','name','description','category_id','stock','price'];
    public function category(){ return $this->belongsTo(Category::class); }
    public function stockMovements(){ return $this->hasMany(StockMovement::class); }
}

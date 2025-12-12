<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;

class ProductController extends Controller {
    public function index(){ return response()->json(Product::with('category')->paginate(15)); }

    public function store(Request $r){
        $v=Validator::make($r->all(),[
            'sku'=>'required|unique:products,sku',
            'name'=>'required',
            'category_id'=>'required|exists:categories,id',
            'stock'=>'integer|min:0',
            'price'=>'numeric|min:0'
        ]);
        if($v->fails()) return response()->json($v->errors(),422);
        $product = Product::create($r->all());
        return response()->json($product,201);
    }

    public function show($id){ return response()->json(Product::with('category')->findOrFail($id)); }

    public function update(Request $r,$id){
        $product = Product::findOrFail($id);
        $v=Validator::make($r->all(),[
            'sku'=>"required|unique:products,sku,{$id}",
            'name'=>'required',
            'category_id'=>'required|exists:categories,id',
            'stock'=>'integer|min:0',
            'price'=>'numeric|min:0'
        ]);
        if($v->fails()) return response()->json($v->errors(),422);
        $product->update($r->all());
        return response()->json($product);
    }

    public function destroy($id){
        Product::findOrFail($id)->delete();
        return response()->json(['message'=>'Deleted']);
    }
}

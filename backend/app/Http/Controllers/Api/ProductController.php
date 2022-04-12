<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request; 

class ProductController extends Controller
{
    
    public function Products(){
        $products = Product::all();
        return response()->json(
            [
                'products' => $products,
                'message' => 'Products',
                'code' => 200
            ]
        );
    }

    public function index()
    {
        //
    }
  
      
    public function saveProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;        
        $product->image = $request->file('image')->store('images', 'public');
        $product->save();

        return response()->json([
            'message' => 'Product Created Successfully',
            'code' => 200
        ]);
    }

    public function getProduct($id){
        $product = Product::find($id);
        return response()->json($product);
    }

    public function updateProduct($id, Request $request){
        $product = Product::where('id', $id)->first();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->save();

        return response()->json([
            'message' => 'Product Updated Successfully',
            'code' => 200
        ]);
    }


    public function deleteProduct($id){
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'message' => 'Product Deleted Successfully',
                'code' => 200
            ]);
        }else{
            return response()->json([
                'message' => "Product with id:$id does not exits!"
            ]);
        }
    }

}

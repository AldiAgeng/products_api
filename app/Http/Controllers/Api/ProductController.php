<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function all()
    {
        try{
            $products = Product::with(['category_products'])->get();
            return ResponseFormatter::success($products, 'Data list produk berhasil diambil');
        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }

    public function show($id)
    {
        try{
            $product = Product::with(['category_products'])->findOrFail($id);
            return ResponseFormatter::success($product, 'Data produk berhasil diambil');
        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }

    public function create(CreateProductRequest $request)
    {
        try{
            if($request->hasFile('image')){
                $image = $request->file('image')->store('public/images');
            }

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $image,
                'product_category_id' => $request->product_category_id
            ]);

            if(!$product){
                throw new Exception('Failed to create product');
            }

            return ResponseFormatter::success($product, 'Data produk berhasil disimpan');

        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try{
            $product = Product::find($id);

            if($request->hasFile('image')){
                Storage::delete($product->image);
                $image = $request->file('image')->store('public/images');
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $image,
                'product_category_id' => $request->product_category_id
            ]);

            if(!$product){
                throw new Exception('Failed to update product');
            }

            return ResponseFormatter::success($product, 'Data produk berhasil diupdate');

        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $product = Product::find($id);

            if(!$product->delete()){
                throw new Exception('Failed to delete product');
            }

            return ResponseFormatter::success(null,'Data produk berhasil dihapus');

        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }
}

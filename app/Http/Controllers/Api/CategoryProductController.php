<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\CategoryProduct;
use Exception;

class CategoryProductController extends Controller
{
    public function all()
    {
        try{
            $categoryProducts = CategoryProduct::all();
            return ResponseFormatter::success($categoryProducts, 'Data list kategori produk berhasil diambil');
        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }

    public function show($id)
    {
        try{
            $categoryProduct = CategoryProduct::findOrFail($id);
            return ResponseFormatter::success($categoryProduct, 'Data kategori produk berhasil diambil');
        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage(), 404);
        }
    }

    public function create(Request $request)
    {
        try{
            $categoryProduct = CategoryProduct::create([
                'name' => $request->name
            ]);

            return ResponseFormatter::success($categoryProduct, 'Data kategori produk berhasil disimpan');

        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $categoryProduct = CategoryProduct::findOrFail($id);
            $categoryProduct->update([
                'name' => $request->name
            ]);

            return ResponseFormatter::success($categoryProduct, 'Data kategori produk berhasil diupdate');

        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $categoryProduct = CategoryProduct::findOrFail($id);
            $categoryProduct->delete();

            return ResponseFormatter::success($categoryProduct, 'Data kategori produk berhasil dihapus');

        }catch(Exception $err){
            return ResponseFormatter::error('Failed', $err->getMessage());
        }
    }
}

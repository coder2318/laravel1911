<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Http\Requests\Product\StoreRequest as ProductStoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return response()->json($products);
        //curl zapros
    }

    public function store(ProductStoreRequest $request)
    {
        $params = $request->validated();
        $product = Product::create($params);
        return response()->json([
            'product' => $product
        ]);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $params = $request->validated();
        // dd($params);
        $product->update($params);
        return response()->json([
            'product' => $product
        ]);
    }

    public function show(Product $product)
    {
        if($product){
            return response()->json($product);
        }
        return response()->json([
            'error' => 'not found'
        ]);
    }

    public function destroy(Product $product)
    {
        if($product){
            if($product->delete())
                return response()->json([
                    'msg' => true
                ]);
                else
                return response()->json([
                    'msg' => false
                ]);
        }
        return response()->json([
            'msg' => 'not found'
        ]);
    }



}

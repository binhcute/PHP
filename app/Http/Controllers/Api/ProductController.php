<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        return $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function show_pro_by_cate($category)
    {
        $product_by_category = DB::table('tpl_product')
            ->join('tpl_category', 'tpl_category.cate_id', '=', 'tpl_product.cate_id')
            ->where('tpl_category.cate_id', $category)
            ->where('tpl_product.status', 1)
            ->get();

            // dd($product_by_category);   
        return ProductResource::collection($product_by_category);
    }
    public function show_pro_by_port($portfolio)
    {
        $product_by_portfolio = DB::table('tpl_product')
            ->join('tpl_portfolio', 'tpl_portfolio.port_id', '=', 'tpl_product.port_id')
            ->where('tpl_portfolio.port_id', $portfolio)
            ->where('tpl_product.status', 1)
            ->get();

            // dd($product_by_category);   
    return ProductResource::collection($product_by_portfolio);
    }
}

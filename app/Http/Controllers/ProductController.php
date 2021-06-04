<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with(['productVariants.variantOne', 'productVariants.variantTwo', 'productVariants.variantThree', 'productVariants.variants'])->paginate(2);

         $variants = Variant::with(['productVariants' => function($query){
                $query->groupBy('variant');
             }]
         )->get();
        //dd($products[0]->productVariants[0]->variants);
//       dd($variants);
        return view('products.index', compact('products', 'variants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function filterProducts(Request $request){

        $products = app(Product::class)->newQuery();
        if(isset($request->title)){
           $products->where('title', 'like',  "%".$request->title."%");
        }
        if(isset($request->variant)){

            $variant = $request->variant;
            $products->whereHas('productVariants', function ($query) use($variant){
                $query->where('variant_id', $variant);
            });

        }

        if(isset($request->price_from) && isset($request->price_to)){
            $from = $request->price_from;
            $to = $request->price_to;
            $products->whereHas('productVariantPrices', function ($query) use($from, $to){
                $query->whereBetween('price', [$from, $to]);
            });
        }

        if(isset($request->date)){
            $products->where('created_at', $request->date);
        }

         $products = $products->paginate(2);
         $products->load(['productVariants.variantOne', 'productVariants.variantTwo', 'productVariants.variantThree', 'productVariants.variants']);
        $variants = Variant::with(['productVariants' => function($query){
                $query->groupBy('variant');
            }]
        )->get();

        return view('products.index', compact('products', 'variants'));

    }
}

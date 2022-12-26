<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){


        try {
            $sort = $request->input('sort');

            if ($sort === 'default') {
                $products =  Product::paginate($request->show);
            } else {
                $products =  Product::conditions($sort)->paginate($request->show);
            }

           return ProductResource::collection($products);
        } catch (\Exception $e) {
            return send_ms($e->getMessage(), false, $e->getCode());
        }
    }


    ////for shop sidebar data

    public function shopSidebar()
    {
        $categories = Category::withCount('products')->status('active')->get();
        $brands = Brand::withCount('products')->status('active')->get();

        $min_price = Product::min('price');
        $max_price = Product::max('price');

        return ProductResource::collection([
            'categories'=>$categories,
            'brands'=>$brands,
            'price' =>[
                'min_price'=>$min_price,
                'max_price'=>$max_price,
            ]
        ]);
    }
}

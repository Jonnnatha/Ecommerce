<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        try {

            // $sort = $request->input('sort');

            // if ($sort === 'default') {
            //     $products =  Product::paginate($request->show);
            // } else {
            //     $products = Product::conditions($sort)->paginate($request->show);
            // }


            $condition = $request->condition;
            $per_page_data = $request->show;
            $brandIds = $request->brand;
            $catIds = $request->category;
            $price_range = $request->price_range;
            $search = $request->search;
            $sort = $request->sort;

            $products = Product::latest()->published()
                ->when($condition != 'all', function ($q) use ($condition) {
                    return $q->conditions($condition);
                })
                ->when($brandIds, function ($q) use ($brandIds) {
                    return $q->whereIn('brand_id', $brandIds);
                })
                ->when($catIds, function ($q) use ($catIds) {
                    return $q->whereIn('category_id', $catIds);
                })
                ->when($price_range, function ($q) use ($price_range) {
                    $min_price = $price_range[0];
                    $max_price = $price_range[1];
                    return $q->whereBetween('price', [$min_price, $max_price]);
                })
                ->when($search != "", function ($q) use ($search) {
                    return $q->where('name', 'LIKE', '%' . $search . '%');
                })

                ->when($sort != 'default', function ($q) use ($sort) {
                    if ($sort === "priceLowToHigh") {
                        return $q->orderBy('price', 'ASC');
                    } else if ($sort === "priceHighToLow") {
                        return $q->orderBy('price', 'DESC');
                    } else if ($sort === "nameZtoA") {
                        return $q->orderBy('name', 'DESC');
                    } else {
                        return $q->orderBy('name', 'ASC');
                    }
                })

                ->paginate($per_page_data);

            return ProductResource::collection($products);
        } catch (\Exception $e) {
            return send_ms($e->getMessage(), false, $e->getCode());
        }
    }


    ///for shop sidebar data
    public function shopSidebar()
    {

        $categories = Category::withCount('products')->status('active')->get();
        $brands = Brand::withCount('products')->status('active')->get();

        $min_price = Product::min('price');
        $max_price = Product::max('price');


        return ProductResource::collection([
            'categories' => $categories,
            'brands' => $brands,
            'price' => [
                'min_price' => $min_price,
                'max_price' => $max_price,
            ]
        ]);
    }
}

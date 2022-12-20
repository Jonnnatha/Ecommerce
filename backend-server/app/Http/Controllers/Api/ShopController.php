<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
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
}

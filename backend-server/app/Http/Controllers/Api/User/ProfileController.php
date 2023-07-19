<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\WishlistResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function orders()
    {

        // $id = Auth::guard('user-api')->id();
        // $orders = User::where('id', $id)->first()->load('orders');

        $user = Auth::guard('user-api')->user();
        return WishlistResource::collection($user->orders()->orderBy('id', 'DESC')->get());
    }



    public function orderById(Order $order)
    {
        return WishlistResource::make($order->load('items.product'));
    }
}

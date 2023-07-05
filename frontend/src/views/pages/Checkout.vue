<script setup>
import { useCart,useAddress,useCoupon } from "@/stores";
import{useStatus} from "@/composables/status.js"
import { storeToRefs } from "pinia";
const { cartItems, totalPrice } = storeToRefs(useCart());
const { address } = storeToRefs(useAddress());

const status = useStatus();
const coupon = useCoupon();
const {couponBtnClass, couponFormClass} = storeToRefs(status);

import  DeliveryAddress  from "@/components/DeliveryAddress.vue";
// const couponBtn = () => {
//   $(".coupon-btn").hide(), $(".coupon-form").css("display", "flex");
// };

const couponCode = ref("");
const applyCoupon=() =>{
  coupon.apply(couponCode.value);
};
</script>

<template>
  <div>

    <section class="inner-section single-banner">
      <div class="container"><h2>Checkout</h2></div>
    </section>
    <section class="inner-section checkout-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12" style="display: none">
            <div class="alert-info">
              <p>
                Returning customer?
                <a
                  href="javascript::void(0)"
                  data-bs-toggle="modal"
                  data-bs-target="#login-modal"
                  >Click here to login</a
                >
              </p>
            </div>
          </div>
          
          <DeliveryAddress/>

          <div class="col-lg-12">
            <div class="account-card">
              <div class="account-title"><h4>Your order</h4></div>
              <div class="account-content">
                <div class="table-scroll">
                  <table class="table-list">
                    <thead>
                      <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(cart,index) in cartItems" :key="index">
                      </tr>
                      <tr>
                        <td class="table-image">
                          <div>
                            <img
                              :src="$filters.makeImagePath(cart.thumbnail)"
                              alt="product"
                            />
                          </div>
                        </td>
                        <td class="table-name"><h6>{{cart.name}}</h6></td>
                        <td class="table-price"><h6>{{$filters.currencySymbol(cart.price)}}</h6></td>
                        <td class="table-quantity"><h6>{{cart.quantity}}</h6></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="chekout-coupon">
                  <button class="coupon-btn " :class="couponBtnClass" @click="status.toggleBtn">
                    Do you have a coupon code?
                  </button>
                  <form class="coupon-form"  :class="couponFormClass" @submit.prevent="applyCoupon">
                    <input
                    v-model="couponCode"
                      type="text"
                      placeholder="Enter your coupon code"
                    /><button type="submit"><span>apply</span></button>
                  </form>
                </div>
                <div class="checkout-charge">
                  <ul>
                    <li><span>Sub total</span><span>{{$filters.currencySymbol(totalPrice)}}</span></li>
                    <li><span>discount</span><span>{{$filters.currencySymbol(coupon.discount)}}</span></li>
                    <li v-if="address.division"><span>delivery charge</span><span>{{$filters.currencySymbol(address?.division?.charge)}}</span></li>
                    <li>
                      <span>Total<small>(Incl. VAT)</small></span
                      ><span>{{$filters.currencySymbol(coupon.grandTotal)}}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="checkout-proced">
            <button class="btn btn-inline"><span></span> Place Order</button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<style>
@import "@/assets/css/checkout.css";

.coupon_btn_none{
  display: none;
}
.coupon_form_display{
  display: flex;
}
</style>
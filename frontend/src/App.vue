<script setup>

import {
  HeaderPart,
  NavBar,
  CartSideBar,
  MobileMenu,
  Newsletter,
  FooterPart,
} from "@/components";

</script>


<template>
  <div>
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>


    <!---   HEADER -->
    <HeaderPart />

    <NavBar />

    <CartSideBar />

    <MobileMenu />


    <!--- -->
    <router-view></router-view>



    <Newsletter />


    <FooterPart />
  </div>
</template>

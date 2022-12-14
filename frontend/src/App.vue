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
    <!-- <router-view></router-view> -->
    <router-view v-slot="{ Component }">
    <transition name="fade" mode="out-in">
      <component :is="Component" />
    </transition>
  </router-view>


    <Newsletter />


    <FooterPart />
  </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-to,
.fade-leave-from {
  opacity: 1;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

</style>

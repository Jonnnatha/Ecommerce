<template>
    <div>
        <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>

    <!-- heder part  -->
    <HeaderPart />
    <!-- NavBar part  -->
    <NavBar/>

    <CartSideBar />

    <MobileMenu />
    <LoginModal />

    <slot />
    <NewsLetter />

    <FooterPart />
    </div>
</template>

<script setup>

import {
  HeaderPart,
  NavBar,
  CartSideBar,
  MobileMenu,
  FooterPart,
  NewsLetter,
  LoginModal,
} from "@/components";

</script>

<style  scoped>

</style>
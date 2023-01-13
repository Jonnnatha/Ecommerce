<script setup>
import { ProductCard } from "@/components/product";
// import Pagination from "laravel-vue-pagination";

import { Bootstrap5Pagination } from "laravel-vue-pagination";
import {ProductScreen, SidebarScreen} from "@/components/skeleton";
import {useShop} from "@/stores";
import { onMounted, ref, computed  } from "vue";
import { storeToRefs } from "pinia";

const shop = useShop();

const {products, sidebar} = storeToRefs(shop);
onMounted(() => {
  getProducts();

  shop.sidebarData();
 
});

const getProducts = (page = 1) =>{

  // shop.$reset();
  products.value =[];
  shop.index( page, show.value, sort.value);
}
const show = ref(10);
const sort = ref("default");



///brand and category searching

const searchBrandQuery = ref("");

const searchedBrands =  computed(() => { 
return shop.sidebar.data.brands.filter((brand)=>{
  return brand.name.toLowerCase().match(searchBrandQuery.value.toLowerCase());
});
});


const  searchCatQuery = ref("");

const searchedCategories =  computed(() => { 
return shop.sidebar.data.categories.filter((cat)=>{
  return cat.name.toLowerCase().match(searchCatQuery.value.toLowerCase());
});
});
</script>

<template>
    <div>
        <section
      class="inner-section single-banner"
      style="background: url(images/single-banner.jpg) no-repeat center"
    >
      <div class="container">
        <h2>Pagina Shop</h2>
      </div>
    </section>
    <section class="inner-section shop-part">
      <div class="container">
        <div class="row content-reverse">
          <div class="col-lg-3" v-if="sidebar.data">

            <template v-if="sidebar.data">
              <div class="shop-widget">
              <h6 class="shop-widget-title">Filter by Price</h6>
              <form>
                <div class="shop-widget-group">
                  <input type="text" :placeholder="`Min - ${$filters.currencySymbol(
                    sidebar.data.price.min_price)}`" />
                      <input type="text" :placeholder="`Max - ${$filters.currencySymbol(
                    sidebar.data.price.max_price)}`" />
                </div>
                <button class="shop-widget-btn">
                  <i class="fas fa-search"></i><span>search</span>
                </button>
              </form>
            </div>

            <div class="shop-widget">
              <h6 class="shop-widget-title">Filter by Brand</h6>
              <form>
                <input
                  class="shop-widget-search"
                  type="text"
                  placeholder="Search..."
                  v-model="searchBrandQuery"
                />
                <ul class="shop-widget-list shop-widget-scroll">
                  <li v-for="brand in searchedBrands" :key="brand.id">
                    <div class="shop-widget-content">
                      <input type="checkbox" id="brand1" /><label for="brand1"
                        >{{brand.name}}</label
                      >
                    </div>
                    <span class="shop-widget-number">{{ brand.products_count }}</span>
                  </li>

                  <li v-show="searchedBrands.length == 0">
                    <p class="text-danger"> Search Result Not Found!</p>
                  </li>
                </ul>
                <button class="shop-widget-btn">
                  <i class="far fa-trash-alt"></i><span>clear filter</span>
                </button>
              </form>
            </div>
            <div class="shop-widget">
              <h6 class="shop-widget-title">Filter by Category</h6>
              <form>
                <input
                  class="shop-widget-search"
                  type="text"
                  placeholder="Search..."
                  v-model="searchCatQuery"
                />
                <ul class="shop-widget-list shop-widget-scroll">
                  <li v-for="category in searchedCategories" :key="category.id">
                    <div class="shop-widget-content">
                      <input type="checkbox" id="brand1" /><label for="brand1"
                        >{{category.name}}</label
                      >
                    </div>
                    <span class="shop-widget-number">{{ category.products_count }}</span>
                  </li>
                  <li v-show="searchedCategories.length == 0">
                    <p class="text-danger"> Search Result Not Found!</p>
                  </li>
                </ul>
                <button class="shop-widget-btn">
                  <i class="far fa-trash-alt"></i><span>clear filter</span>
                </button>
              </form>
            </div>
            </template>
         <template v-else>
          <SidebarScreen/>
         </template>
        
          </div>
          <div class="col-lg-9">
            <div class="row">
          <div class="col-lg-12">
            <div class="top-filter">
              <div class="filter-show">
                <label class="filter-label">Show :</label
                ><select
                  class="form-select filter-select"
                  v-model="show"
                  @change="getProducts"
                >
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="200">200</option>
                </select>
              </div>
              <div class="filter-short">
                <label class="filter-label">Short by :</label
                ><select
                  class="form-select filter-select"
                  v-model="sort"
                  @change="getProducts"
                >
                  <option value="default">Todos</option>
                  <option value="new">Novos</option>
                  <option value="popular">Popular</option>
                  <option value="winter">Iverno</option>
                  <option value="feature">Caracteristicas</option>
                </select>
              </div>
            </div>
          </div>
        </div>

            <template  v-if="products.data">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

     
          <ProductCard
            :product="product"
            v-for="(product, index) in products.data"
            :key="index"
          />

      
        </div>
      </template>
        <template v-else> 

<ProductScreen :dataAmount="10" :cols="5"/>
</template>
            <div class="row" v-if="products.data">
          <div class="col-lg-12">
            <div class="bottom-paginate">
              <p class="page-info">
                Showing {{ products.meta.per_page }} of
                {{ products.meta.total }} Results
              </p>
              <ul class="pagination">
                <Bootstrap5Pagination
                  :data="products"
                  @pagination-change-page="getProducts"
                >
                  <template #prev-nav>
                    <a class="page-link" href="#"
                      ><i class="fas fa-long-arrow-alt-left"></i
                    ></a>
                  </template>
                  <template #next-nav>
                    <a class="page-link" href="#"
                      ><i class="fas fa-long-arrow-alt-right"></i
                    ></a>
                  </template>
                </Bootstrap5Pagination>
              </ul>
            </div>
          </div>
        </div>
          </div>
        </div>
      </div>
    </section>
    </div>
</template>

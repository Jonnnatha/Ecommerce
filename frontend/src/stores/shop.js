import { defineStore } from "pinia";
import axiosInstance from "@/services/AxiosService";

export const useShop = defineStore("shop", {
  state: () => ({
    products: [],
    sidebar:[],
  }),

  actions: {
    async index(page,show,sort) {
      try {
        const res = await axiosInstance.get(
          `/shop-products?page=${page}&show=${show}&sort=${sort}`
          );

        if (res.status === 200) {
          this.products = res.data;
        }
      } catch (error) {
        if (error.response.data) {
          console.log(error.response.data);
        }
      }
    },

    async sidebarData() {
      try {
        const res = await axiosInstance.get("/shop-sidebar");

        if (res.status === 200) {
          this.sidebar = res.data;
        }
      } catch (error) {
        if (error.response.data) {
          console.log(error.response.data);
        }
      }
    },
  },
});
import { defineStore } from "pinia";
import axiosInstance from "@/services/AxiosService";

export const useProduct = defineStore("product", {
  state: () => ({
    products: {},
    sales: [],
    popular: [],
    newItems: [],
    winter: [],
    features: [],
    loading: false,
  }),

  actions: {
    async index(type = "") {
      try {
        const res = await axiosInstance.get("/products?conditions=" + type);

        if (res.status === 200) {
          if (type === "sale") {
            this.sales = res.data;
          } else if (type === "popular") {
            this.popular = res.data;
          } else if (type === "new") {
            this.newItems = res.data;
          } else if (type === "feature") {
            this.features = res.data;
          } else if (type === "winter") {
            this.winter = res.data;
          } else {
            this.products = res.data;
          }

          return new Promise((resolve) => {
            resolve(res.data);
          });
        }
      } catch (error) {
        if (error.response.data) {
          console.log(error.response.data);
        }
      }
    },
  },
});
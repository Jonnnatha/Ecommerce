import {defineStore} from "pinia";
import axiosInstance from "@/services/axiosService";

export const useAuth = defineStore("auth",{

    state: () => ({ 
        user: {},
        loading: false,
    }),
    persist: {
        paths: ['user'],
      },

        actions:{
            async login(formData) {
                try {
                  const res = await axiosInstance.post("/user/login", formData);
          
                  if (res.status === 200) {
                    this.user = res.data;
                    return new Promise((resolve) => {
                      resolve(res.data);
                    });
                  }
                } catch (error) {
                  if (error.response.data) {    
                    return new Promise((reject) => {
                      reject(error.response.data.errors);
                    });
                  }
                }
              },

              async register(formData) {
                try {
                  const res = await axiosInstance.post("/user/register", formData);
          
                  if (res.status === 201) {
                    this.user = res.data;
                    return new Promise((resolve) => {
                      resolve(res.data);
                    });
                  }
                } catch (error) {
                  if (error.response.data) {
                    return new Promise((reject) => {
                      reject(error.response.data.errors);
                    });
                  }
                }
              },
          
              async logout() {
                this.loading = true;
                try {
                  const res = await axiosInstance.post("/user/logout");
                  if (res.status === 200) {
                    this.user = {};
                    return new Promise((resolve) => {
                      resolve(res.data);
                    });
                  }
                } catch (error) {
                  if (error.response) {
                    return new Promise((reject) => {
                      reject(error.response);
                    });
                  }
                } finally {
                  this.loading = false;
                }
              },
            },
});
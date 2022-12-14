import {defineStore} from "pinia";

export const useCart = defineStore("cart",{

        state: () => ({
            cartItems: [],        
        }
        ),
        persist: {
            paths: ['cartItems'],
          },
        getters:{
            totalPrice: (state) => {
                let total =0;
                state.cartItems.map((el)=> {
                    total += el["price"] * el["quantity"];
                });
                return total;
            },
            cartItemsCount: (state) => {
                let total =0;
                state.cartItems.map((el)=> {
                    total += el["quantity"];
                });
                return total;
            },
        },

        actions:{
            addToCart(product){
               let item = product;
                item = {...item, quantity:1};
                if(this.cartItems.length>0)
                {
                    let boolean = this.cartItems.some((i)=>i.id === item.id);
                    if(boolean){
                      let index =  this.cartItems.findIndex((i)=>i.id === item.id);
                      this.cartItems[index]["quantity"] += 1;
                    }else{
                        this.cartItems.push(item); 
                    }
                }else{
                    this.cartItems.push(item);
                }
            },
            async destroy(index){
                if(this.cartItems.length>0){
                      this.cartItems.splice(index,1);
                    }
                }
            },
        },
);
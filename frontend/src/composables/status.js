import {defineStore} from 'pinia';
import {ref, computed} from 'vue';

export const useStatus = defineStore("status", () => {
    const couponStatus = ref(false);

    const couponBtnClass = computed(()=> couponStatus.value ? 'coupon_btn_none':"");

    const couponFormClass = computed(()=> couponStatus.value ? 'coupon_form_display':"");

    function toggleBtn(){
        couponStatus.value = !couponStatus.value;
    }
    return {couponBtnClass,couponFormClass,toggleBtn}
});
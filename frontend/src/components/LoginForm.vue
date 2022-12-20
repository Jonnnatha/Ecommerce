<script setup>
import { useAuth,useNotification } from "@/stores";
import { ref } from 'vue';
import { useRouter, useRoute } from 'vue-router'
import { Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
  phone: yup.string().required("Phone filed is required"),
  password: yup.string().required(),
});

const auth = useAuth();

const router = useRouter();
const route = useRoute();

const showPassowrd = ref(false);

const toggleShow = () => {

  showPassowrd.value = !showPassowrd.value;

};
const notify = useNotification();

const onSubmit = async (values, { setErrors, resetForm }) => {

const res = await auth.login(values);

if (res.data) {
  resetForm();
    router.push({name:route.path ==='/auth/login' ? "index.page" : ""});
   notify.Success("login Sucess")

  } else {
    setErrors(res);
  }
  ///console.log(actions);


};
</script>

<template>
    <div>
        <div class="user-form-card">
              <div class="user-form-title">

                <h2>Login do cliente</h2>

                <p>Use suas credenciais para acessar</p>
              </div>
              <div class="user-form-group" id="axiosForm">
                <Form class="user-form" @submit="onSubmit" :validation-schema="schema" v-slot="{errors, isSubmitting}">
                  <!--v-if-->
                  <div class="form-group">
                    <Field name="phone" type="text" class="form-control" placeholder="phone no"
                      :class="{ 'is-invalid': errors.phone }" /><!--v-if-->
                    <!----   <ErrorMessage name="phone" class="text-danger"/>  -->
                    <span class="text-danger">{{ errors.phone }}</span>
                  </div>
                  <div class="form-group">
                    <Field name="password" :type="showPassowrd ? 'text' : 'password'" class="form-control"
                      placeholder="password" :class="{ 'is-invalid': errors.password }" />
                    <!-------   <ErrorMessage name="password"/>    -->
                    <span class="text-danger">{{ errors.password }}</span>

                    <span class="view-password" @click="toggleShow"><i class="fas text-success" :class="{
                      'fa-eye-slash': showPassowrd,
                      'fa-eye': !showPassowrd,
                    }"></i></span><!--v-if-->
                  </div>
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="check" value="" /><label
                      class="form-check-label" for="check">Lembre de mim</label>
                  </div>
                  <div class="form-button">
                    <button type="submit" :disabled="isSubmitting">login

                      <span v-show="isSubmitting" class="spinner-border spinner-border-sm mr-1"></span>
                    </button>

                    <div class="user-form-remind">
              <p>
                Não tem nenhuma conta?<router-link :to="{ name: 'user.register' }" class="">Registre-se aqui</router-link>
              </p>
            </div>
                  </div>
                </form>
              </div>
            </div>
    </div>
</template>


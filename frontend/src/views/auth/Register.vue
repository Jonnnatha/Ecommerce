<script setup>
import { useAuth, useNotification } from "@/stores";
import { ref, reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router'
import { Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
  name: yup.string().required(),
  email: yup.string().required().email(),
  phone: yup.string().required(),
  password: yup.string().required().min(8),
  password_confirmation: yup.string()
  .required("password confirmation is a required field")
  .min(8)
  .oneOf([yup.ref("password"),null],"Passwords and confirm password must match"),
});
onMounted(() => {
  $("#login-modal").modal("hide");
});
const auth = useAuth();
const notify = useNotification();

const router = useRouter();

const showPassowrd = ref(false);

const toggleShow = () => {

  showPassowrd.value = !showPassowrd.value;

};

const onSubmit = async (values, { setErrors }) => {

  const res = await auth.register(values);

  if (res.data) {
    router.push({name:"index.page"});
    notify.Success("Registration Sucess");


  } else {
    setErrors(res);
  }
  ///console.log(actions);


};
</script>

<template>
  <div>
    <section class="user-form-part">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-6">
            <div class="user-form-card">
              <div class="user-form-title">
                <h2>Customer Register</h2>

                <p>Use your credentials to access</p>
              </div>
              <div class="user-form-group" id="axiosForm">
                <Form class="user-form" @submit="onSubmit" :validation-schema="schema" v-slot="{errors, isSubmitting}">
                  <!--v-if-->
                  <div class="form-group">
                    <Field name="name" type="text" class="form-control" placeholder="name "
                      :class="{ 'is-invalid': errors.name }" />
                    <span class="text-danger">{{ errors.name }}</span>
                  </div>

                  <div class="form-group">
                    <Field name="email" type="text" class="form-control" placeholder="email Address"
                      :class="{ 'is-invalid': errors.email }" />
                    <span class="text-danger">{{ errors.email }}</span>
                  </div>

                  <div class="form-group">
                    <Field name="phone" type="text" class="form-control" placeholder="phone no"
                      :class="{ 'is-invalid': errors.phone }" />
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

                  <div class="form-group">
                    <Field name="password_confirmation" :type="showPassowrd ? 'text' : 'password'" class="form-control"
                      placeholder="Retype password " :class="{ 'is-invalid': errors.password_confirmation }" />
                    <!-------   <ErrorMessage name="password"/>    -->
                    <span class="text-danger">{{ errors.password_confirmation }}</span>

                    <span class="view-password" @click="toggleShow"><i class="fas text-success" :class="{
                      'fa-eye-slash': showPassowrd,
                      'fa-eye': !showPassowrd,
                    }"></i></span><!--v-if-->
                  </div>
                  <div class="form-button">
                    <button type="submit" :disabled="isSubmitting">Register

                      <span v-show="isSubmitting" class="spinner-border spinner-border-sm mr-1"></span>
                    </button>

                    <p>
                      Forgot your password?<a href="reset-password.html" class="">reset here</a>
                    </p>
                  </div>
                </form>
              </div>
            </div>
            <div class="user-form-remind">
              <p>
                 have any account?<router-link :to="{ name: 'user.login' }" class="">login here</router-link>
              </p>
            </div>
            <div class="user-form-footer"></div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<style>
@import "@/assets/css/user-auth.css";
</style>
<template>
    <div>
      <Modal>
        <form class="modal-form" @submit.prevent="onSubmit">
          <div class="form-title"><h3>add new address</h3></div>
          <div class="form-group">
            <label class="form-label">Select Area</label>
            <select
              class="form-select"
              @change="getDistrict"
              v-model="form.division_id"
            >
              <option disabled selected value="">Select Division</option>
              <option
                v-for="(division, index) in address?.divisions"
                :key="index"
                :value="division.id"
                
              >
                {{ division.name }} - {{ division.bn_name }}
              </option>
            </select>
          </div>
          <div class="form-group" v-show="form.division_id">
            <label class="form-label">Select District</label>
  
            <select class="form-select" v-model="form.disctrict_id">
              <option disabled selected value="">Select District</option>
              <option
                v-for="(district, index) in address?.districts"
                :key="index"
                :value="district.id"
              >
                {{ district.name }} - {{ district.bn_name }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">address</label
            ><textarea
              class="form-control"
              placeholder="Enter your address"
            ></textarea>
          </div>
          <button class="form-btn" type="submit">save address info</button>
        </form>
      </Modal>
  
      <div class="col-lg-12">
        <div class="account-card">
          <div class="account-title">
            <h4>delivery address</h4>
            <button @click.prevent="modal.toggleModal()">add address</button>
          </div>
          <div class="account-content">
            <div class="row">
              <div class="col-md-6 col-lg-4 alert fade show">
                <div class="profile-card address active">
                  <!-- <h6>Home</h6> -->
                  <p>
                    <span>{{address?.address?.division?.name}}</span>,
                     <span>{{address?.address?.district?.name}}</span>,
                      {{address?.address?.address}}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from "vue";
  import { Modal } from "@/components";
  import { useModal, useAddress } from "@/stores";
  const modal = useModal();
  const address = useAddress();
  
  onMounted(() => {
    address.getDivisions();
    address.getUserAddress();
  });
  
 

  const form = reactive({
    division_id: "",
    district_id: "",
    address: "",
  });
  
  const getDistrict = () => {
    address.districtById(form.division_id);
  };

  const onSubmit = () => {
    res = address.StoreAddress(form);

    if (res.status) {
      address.getUserAddress();
      form.division_id = "";
      form.disctrict_id= "";
      form.address = "";
  }

  };
  </script>
  
  <style scoped></style>
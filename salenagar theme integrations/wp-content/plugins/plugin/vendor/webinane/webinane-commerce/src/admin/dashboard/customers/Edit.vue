<template>
  <div v-loading="loading">
    <el-form :model="form" v-if="form.id">
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item :label="$wpcm_i18n.name" :label-width="formLabelWidth">
            <el-input v-model="form.name" autocomplete="off"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item :label="$wpcm_i18n.email" :label-width="formLabelWidth">
            <el-input v-model="form.email" autocomplete="off"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item :label="'Linked User'" :label-width="formLabelWidth">
            <el-select v-model="form.user_id">
              <el-option v-for="usr in users" :key="usr.id" :value="usr.id" :label="`${usr.name} (${usr.email})`">{{`${usr.name} (${usr.email})`}}</el-option>
            </el-select>
          </el-form-item>
        </el-col>
      </el-row>
      <h4>{{ $wpcm_i18n.billing_info }}</h4>
      <el-row :gutter="20">
        <el-col :span="14">
          <el-form-item
            :label="$wpcm_i18n.address"
            :label-width="formLabelWidth"
          >
            <el-input
              v-model="form.meta_data.billing_address_line_1"
              autocomplete="off"
              :placeholder="$wpcm_i18n.address_line_1"
            ></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="10">
          <el-form-item>
            <el-input
              v-model="form.meta_data.billing_address_line_2"
              autocomplete="off"
              :placeholder="$wpcm_i18n.address_line_2"
            ></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="20">
        <el-col :span="12">
          <el-form-item
            :label="$wpcm_i18n.country"
            :label-width="formLabelWidth"
          >
            <el-select
              filterable
              v-model="form.meta_data.billing_base_country"
              autocomplete="off"
            >
              <el-option
                v-if="countries"
                v-for="country in countries"
                :label="country.label"
                :key="country.value"
                :value="country.value"
              >
              </el-option>
            </el-select>
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-form-item>
            <el-input
              :placeholder="$wpcm_i18n.city"
              v-model="form.meta_data.billing_city"
              autocomplete="off"
            ></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item
            :label="$wpcm_i18n.company"
            :label-width="formLabelWidth"
          >
            <el-input
              v-model="form.meta_data.billing_company"
              autocomplete="off"
            ></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item>
            <el-input
              :placeholder="$wpcm_i18n.phone"
              v-model="form.meta_data.billing_phone"
              autocomplete="off"
            ></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item>
            <el-input
              :placeholder="$wpcm_i18n.zip"
              v-model="form.meta_data.billing_zip"
              autocomplete="off"
            ></el-input>
          </el-form-item>
        </el-col>
      </el-row>

      <h4>{{ $wpcm_i18n.shipping_info }}</h4>
      <el-row :gutter="20">
        <el-col :span="14">
          <el-form-item
            :label="$wpcm_i18n.address"
            :label-width="formLabelWidth"
          >
            <el-input
              v-model="form.meta_data.shipping_address_line_1"
              autocomplete="off"
              :placeholder="$wpcm_i18n.address_line_1"
            ></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="10">
          <el-form-item>
            <el-input
              v-model="form.meta_data.shipping_address_line_2"
              autocomplete="off"
              :placeholder="$wpcm_i18n.address_line_2"
            ></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="20">
        <el-col :span="12">
          <el-form-item
            :label="$wpcm_i18n.country"
            :label-width="formLabelWidth"
          >
            <el-select
              filterable
              v-model="form.meta_data.shipping_base_country"
              autocomplete="off"
            >
              <el-option
                v-if="countries"
                v-for="country in countries"
                :label="country.label"
                :key="country.value"
                :value="country.value"
              >
              </el-option>
            </el-select>
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-form-item>
            <el-input
              :placeholder="$wpcm_i18n.city"
              v-model="form.meta_data.shipping_city"
              autocomplete="off"
            ></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="20">
        <el-col :span="14">
          <el-form-item :label="$wpcm_i18n.phone" :label-width="formLabelWidth">
            <el-input
              v-model="form.meta_data.shipping_phone"
              autocomplete="off"
            ></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="10">
          <el-form-item>
            <el-input
              :placeholder="$wpcm_i18n.zip"
              v-model="form.meta_data.billing_zip"
              autocomplete="off"
            ></el-input>
          </el-form-item>
        </el-col>
      </el-row>
    </el-form>
  </div>
</template>

<script>
export default {
  props: {
    id: Number,
    user: Object,
    users: Array,
  },
  data() {
    return {
      data: {},
      loading: false,
      form: {},
      formLabelWidth: "120px",
      countries: {},
    };
  },
  mounted() {
    this.form = { ...this.user };
    this.form.metas = {};
    this.form.user = {};
    this.getCounries();
    this.form.user_id = this.user.user_id ? parseInt(this.user.user_id) : this.user.user_id
  },
  methods: {
    getCounries() {
      let $ = jQuery;
      $.ajax({
        url: "https://raw.githubusercontent.com/wowthemes/countries/master/src/data/countries/default/_countries.json",
        type: "get",
        success: (res) => {
          res = JSON.parse(res);
          let countries = [];
          _.each(res, (value, key) => {
            countries.push({ label: value, value: key });
          });
          this.countries = countries;
        },
      });
    },
    update() {
      let $ = jQuery;
      this.loading = true;

      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          action: "webinane_commerce_update_customer",
          form: this.form,
          nonce: wpcm_data.nonce,
        },
        success: (res) => {
          if (res.success) {
            this.$notify({
              type: "success",
              title: this.$wpcm_i18n.success,
              message: res.data.message,
              offset: 33,
            });
            this.$emit("onClose");
          } else {
            this.$notify({
              type: "error",
              title: this.$wpcm_i18n.error,
              message: res.data.message,
              offset: 33,
            });
          }
        },
        complete: (res) => {
          this.loading = false;
        },
      });
    },
  },
};
</script>
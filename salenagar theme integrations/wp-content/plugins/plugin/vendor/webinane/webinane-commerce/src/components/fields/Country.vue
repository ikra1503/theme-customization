<template>
  <el-row :gutter="20">
    <el-col :span="24">
      <el-select
        placeholder="Select Country"
        filterable
        v-bind="$attrs"
        v-model="value.country"
        class="wpcm-form-inputt"
        :multiple="multiple"
        @change="onChange"
        size="large"
      >
        <template v-if="countries">
          <el-option
            v-for="value in countries"
            :value="value.value"
            :key="value.value"
            :label="value.label"
          ></el-option>
        </template>
      </el-select>
    </el-col>
    <el-col :span="24" class="mt-3" v-if="! hide_states">
      <el-select
        placeholder="Select States"
        
        filterable
        v-bind="$attrs"
        v-model="value.state"
        class="wpcm-form-inputt"
        @change="stateChange"
        size="large"
      >
        <template v-if="states">
          <el-option
            v-for="value in states"
            :value="value.value"
            :key="value.value"
            :label="value.label"
          ></el-option>
        </template>
      </el-select>
    </el-col>
  </el-row>
</template>

<script>
import { dep_visibility } from "../../mixins.js";

export default {
  mixins: [dep_visibility],
  props: ["value", 'countries_list', 'multiple', 'hide_states'],
  data() {
    return {
      address: {
        country: "",
        state: "",
      },
      countries: [],
      states: [],
      loading: false,
    };
  },
  computed: {},
  watch: {
    value(value) {
      this.address = _.isObject(value) ? value : {};
      this.getStates();
    },
  },
  mounted() {
    this.address = _.isObject(this.value) ? {...this.value} : {}
    this.getStates()
    // this.address = this.value
    if(! this.countries_list) {
      this.getCountries();
    } else {
      this.setCountries(this.countries_list)
    }
  },
  methods: {
    setCountries(res) {
      this.countries = [];
      _.each(res, (value, key) => {
        this.countries.push({
          value: key,
          label: value,
        });
      });
    },
    onChange(event) {
      this.$emit("input", this.value);
      this.$emit("change", this.value);
      this.getStates();
    },
    stateChange(event) {
      this.$emit("input", this.value);
      this.$emit("change", this.value);
    },
    
    getCountries() {
      let $ = jQuery;
      let thisis = this;
      this.loading = true;
      $.ajax({
        url:
          "https://raw.githubusercontent.com/wowthemes/countries/master/src/data/countries/default/_countries.json",
        type: "get",
        dataType: "json",
        success: (res) => {
          this.setCountries(res)
        },
        complete: (res) => {
          this.loading = false;
        },
      });
    },
    getStates() {
      let $ = jQuery;
      let thisis = this;
      this.loading = true;
      $.ajax({
        url:
          wpApiSettings.root +
          "webinane-commerce/v1/countries/" +
          this.value.country +
          "/states",
        type: "get",
        dataType: "json",
        success: (res) => {
          this.states = [];
          _.each(res.states, (value, key) => {
            this.states.push({
              value: key,
              label: value,
            });
          });
        },
        complete: (res) => {
          this.loading = false;
        },
      });
    },
  },
};
</script>

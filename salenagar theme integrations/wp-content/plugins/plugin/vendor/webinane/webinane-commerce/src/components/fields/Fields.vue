<template>
  <div v-if="fields">
    <el-form :model="form" :label-position="labelPosition" v-if="form">
      <el-row :gutter="30">
        <template v-for="field in fields">
          <el-col :span="24" v-show="handleShow(field)">
            <h6
              v-if="field.main_heading"
              class="mb-2"
              v-html="field.main_heading"
            ></h6>
            <w-field :field="field" v-if="field.type" :label-width="labelWidth" @change="handleChange"></w-field>
          </el-col>
        </template>
      </el-row>
    </el-form>
  </div>
</template>

<script>
import WField from "./Field.vue";
const { mapState } = window.Vuex;

export default {
  name: "Fields",
  components: {
    WField,
  },
  props: {
    fields: {
      type: Array,
      required: true,
    },
    // values: Object,
    labelPosition: {
      type: String,
      default: 'left'
    },
    labelWidth: {
      type: String,
      default: '30%'
    },
    
  },
  data() {
    return {
      form: {
        gateways: {},
      },
    };
  },
  computed: {
    ...mapState(['values'])
  },
  mounted() {
    setTimeout(() => {
      this.setDefaultValues();
      this.setValuesToForm();
    }, 100);
  },
  methods: {
    setValuesToForm() {
      /*_.each(this.values, (val, key) => {
        this.$set(this.form, key, val);
      });*/
      _.each(this.fields, (field) => {
        let value = (field.value) ? field.value : field.default
        this.$set(this.form, field.id, value)
      })
    },
    setDefaultValues() {
      /*_.each(this.fields, (field) => {
        let ddefault = field.default ? field.default : ''
        let value =
          this.values[field.id] !== undefined
            ? this.values[field.id]
            : ddefault;
        this.fixElMultiSelect(field)
        if (field.id) {
          this.$set(this.form, field.id, value);
        }
      });*/
    },
    fixElMultiSelect(field) {
        if(field.type == 'el-select' && field.props) {
          if(field.props.multiple && !_.isArray(this.values[field.id])) {
            this.values[field.id] = []
          }
        }
    },
    handleChange(id, value) {
      if(value && value.target) {
        value = value.target.value
      }
      this.$set(this.form, id, value)
      this.$emit("input", id, value);
    },
    handleGatewayChange(value, name) {

      this.$set(this.form.gateways, name, value);
      this.$emit("input", this.form);
    },
    handleShow(field) {

      const operators = this.operators()
      if (field.vshow) {
        if (_.isArray(field.vshow)) {
          var is_return = false;
          _.each(field.vshow, (obj) => {

            var compare = operators[obj.compare](this.values[obj.key], obj.value)

            if (compare) {
              is_return = true;
            } else {
              is_return = false;
            }
          });
          return is_return;
        } else {
          if (this.form[field.vshow.key] == field.vshow.value) {
            return true;
          } else {
            return false;
          }
        }
      }
      return true;
    },
    operators() {
      return {
          '=': function(a, b) { return a == b },
          '<=': function(a, b) { return a <= b },
          '<': function(a, b) { return a < b },
          '>': function(a, b) { return a > b },
          '>=': function(a, b) { return a >= b },
          '!=': function(a, b) { return a != b },
           // ...
      };
    }
  },
};
</script>

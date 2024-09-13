<template>
  <el-form-item
    :label="field.label"
    v-if="field.type != 'gateway_tab'"
    :label-width="field.props.labelWidth? field.props.labelWidth : labelWidth"
  >
    <component
      :is="field.type"
      :name="field.id"
      :ref="field.id"
      v-model="value"
      v-bind.sync="field.props"
      @change="handleChange"
    >
      <el-option
        v-if="field.type == 'el-select'"
        v-for="(opt, key) in field.options"
        :key="key"
        :label="opt"
        :value="key"
        >{{ opt }}</el-option
      >
      <el-radio
        v-if="field.type == 'el-radio-group'"
        v-for="(opt, key) in field.options"
        :key="key"
        :label="key"
        border
        >{{ opt }}</el-radio
      >
      <el-checkbox
        v-if="field.type == 'el-checkbox-group'"
        v-for="(opt, key) in field.options"
        :key="key"
        :label="key"
        >{{ opt }}</el-checkbox
      >
    </component>
    <p v-if="field.help" :style="{ color: '#999' }" class="mt-1">
      <em v-html="field.help"></em>
    </p>
  </el-form-item>
</template>

<script>
const { mapState } = window.Vuex;
import Media from "./Media.vue";
import MediaGallery from "./MediaGallery.vue";
import Editor from "./Editor.vue";
import Country from "./Country.vue";
import State from "./State.vue";
import WpcmImage from "./Image.vue";
import ImageList from './ImageList.vue';
import MultiText from "./MultiText.vue";
import ElHeading from "./Heading.vue";
import Repeater from "./Repeater.vue";

export default {
  name: "w-field",
  components: {
    Media,
    MediaGallery,
    Editor,
    Country,
    State,
    MultiText,
    ElHeading,
    Repeater,
    WpcmImage,
    ImageList,
  },
  props: {
    field: {
      type: Object,
      required: true,
    },
    labelWidth: {
      type: String,
      default: "30%",
    },
  },
  computed: {
    ...mapState(["values"]),
    value: {
      get() {
        const { values } = this.$store.state
        return (values[this.field.id] !== undefined) ? values[this.field.id] : this.field.value;
      },
      set(val) {
        this.$store.commit("setValue", { key: this.field.id, val });
      },
    },
  },
  data() {
    return {
      form: {
        gateways: {},
      },
    };
  },
  mounted() {
    /*setTimeout(() => {
      this.$emit('change', this.field.id, this.field.value)
    }, 100);*/
  },
  methods: {
    handleChange() {
      // this.$emit("change", this.field.id, this.field.value);
      // this.$emit('to-show', this.field)
      // this.handleShow(this.field)
    },
    handleShow(field) {
      const operators = this.operators();
      if (field.vshow) {
        if (_.isArray(field.vshow)) {
          var is_return = false;
          _.each(field.vshow, (obj) => {
            var compare = operators[obj.compare](this.form[obj.key], obj.value);

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
        "=": function (a, b) {
          return a == b;
        },
        "<=": function (a, b) {
          return a <= b;
        },
        "<": function (a, b) {
          return a < b;
        },
        ">": function (a, b) {
          return a > b;
        },
        ">=": function (a, b) {
          return a >= b;
        },
        "!=": function (a, b) {
          return a != b;
        },
        // ...
      };
    },
  },
};
</script>

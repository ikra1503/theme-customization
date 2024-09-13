<template>
  <div :style="{ maxWidth: '80%' }">
    <Fields :fields="fields" :values="values" @input="setValues" />
  </div>
</template>

<script>
import Fields from "../../components/fields/Fields.vue";
export default {
  components: {
    Fields,
  },
  props: {
    screen: {
      type: String,
      default: "post",
    },
    id: Number,
    meta_id: String,
  },
  data() {
    return {
      fields: [],
      values: {},
      form: {},
    };
  },
  mounted() {
    this.getData();
    this.bindPostSubmit(this);
  },
  methods: {
    getData() {
      let $ = jQuery;
      let thisis = this;
      let post_id = $("#post_ID").val();
      let action = this.$refs.metabox_action;
      let type = this.$refs.metabox_object_type;

      action = action ? action.value : "_wpcommerce_admin_metabox_data";
      type = this.screen;
      $.ajax({
        url: ajaxurl,
        type: "post",
        data: { action, metabox_id: this.meta_id, post_id: this.id, type },
        success: (res) => {
          if (res.fields) {
            this.fields = res.fields.fields;
            this.options = res.options;
            this.$store.commit('setValues', this.options);
            //this.options = (this._vnode.data.attrs.options) ? JSON.parse(this._vnode.data.attrs.options) : {}
          }
        },
      });
    },
    bindPostSubmit(thisis) {
      let element = document.getElementById("post");

      if (element) {
        let callback = this.submit;
        element.addEventListener("submit", callback);
      }

      if (wp !== undefined) {
        wp.data.subscribe(() => {
          if (
            wp.data.select("core/editor") !== undefined &&
            wp.data.select("core/editor")
          ) {
            var isSavingPost = wp.data.select("core/editor").isSavingPost();
            var isAutosavingPost = wp.data
              .select("core/editor")
              .isAutosavingPost();

            if (isSavingPost && !isAutosavingPost) {
              thisis.submit();
            }
          }
        });
      }
    },
    submit(event) {
      let $ = jQuery;
      let thisis = this;
      let post_id = this.id;
      this.loading = true;

      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          action: "_wpcommerce_admin_save_metabox",
          meta_id: this.meta_id,
          options: this.$store.state.values,
          fields: this.fields,
          post_id: post_id,
        },
        success: (res) => {},
        complete: (res) => {
          thisis.loading = false;
        },
      });
      //event.preventDefault()
    },
    setValues(id, value) {
      this.form[id] = value;
    },
  },
};
</script>

<style lang="scss">
.wpcm-wrapper {
  .el-form {
    .el-form-item {
      .el-input input {
        height: 58px;
        border-radius: 2px;
        border: 2px solid #e1e2e6;
        color: #999999;
        font-size: 14px;
        padding: 12px 15px;
        background-color: #fff;
      }
    }
  }
  .el-switch .el-switch__core {
    height: 40px;
    width: 95px !important;
    box-shadow: 0 0 24px rgb(0 0 0 / 8%);
    border-radius: 60px;
  }
  .el-switch.is-checked .el-switch__core {
    background-color: #2f88e4;
    background-image: linear-gradient(#2f88e4, #2874df);
    border-color: #2f88e4;
  }
  .el-switch .el-switch__core::after {
    height: 36px;
    width: 36px;
    box-shadow: 3px 4px 15px 0px rgb(0 0 0 / 25%);
  }
  .el-switch.is-checked .el-switch__core::after {
    margin-left: -37px;
  }
}
</style>
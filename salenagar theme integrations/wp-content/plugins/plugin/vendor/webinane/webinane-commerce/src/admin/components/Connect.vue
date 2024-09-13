<script>
export default {
  props: {
    nonce: String,
    is_active: Boolean,
    active_plugins: Array,
    inst_plugins: Array,
  },
  data() {
    return {
      form: {},
      items: [],
      user_items: [],
      loading: false,
      loaded: true,
    };
  },
  mounted() {
    if (this.is_active) {
      this.getItems();
    }
  },
  methods: {
    getItems() {
      let $ = jQuery;
      this.loading = true;

      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          action: "webinane_commerce_user_connect_get_items",
          form: this.form,
          nonce: this.nonce,
        },
        success: (res) => {
          this.loading = false;
          if (res.success) {
            this.items = res.data.items;
            this.user_items = res.data.user_items;
          }
        },
        error: (error) => {
          this.$notify({
            type: "error",
            message: error.responseJSON.data.message,
            offset: 40,
          });
        },
        complete: (error) => {
          this.loading = false;
        },
      });
    },
    login() {
      let $ = jQuery;
      this.loading = true;

      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          action: "webinane_commerce_user_connect",
          form: this.form,
          nonce: this.nonce,
        },
        success: (res) => {
          this.loading = false;
          if (res.success) {
            this.$notify({
              type: "success",
              message: res.data.message,
              offset: 40,
            });
            window.location = location.href;
          }
        },
        error: (error) => {
          this.$notify({
            type: "error",
            message: error.responseJSON.data.message,
            offset: 40,
          });
        },
        complete: (error) => {
          this.loading = false;
        },
      });
    },
    login_out() {
      let $ = jQuery;
      this.loading = true;

      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          action: "webinane_commerce_user_disconnect",
          form: this.form,
          nonce: this.nonce,
        },
        success: (res) => {
          this.loading = false;
          if (res.success) {
            this.$notify({
              type: "success",
              message: res.data.message,
              offset: 40,
            });
            window.location = location.href;
          }
        },
        error: (error) => {
          this.$notify({
            type: "error",
            message: error.responseJSON.data.message,
            offset: 40,
          });
        },
        complete: (error) => {
          this.loading = false;
        },
      });
    },
    is_installed(plugin) {
      let slug = plugin + "/" + plugin + ".php";
      let found = this.inst_plugins.indexOf(slug);

      return found >= 0 ? true : false;
    },
    plugin_active(plugin) {
      let slug = plugin + "/" + plugin + ".php";
      let found = this.active_plugins.indexOf(slug);
      return found >= 0 ? true : false;
    },
    is_purchased(plugin) {
      let found = this.user_items.indexOf(plugin);
      return found >= 0 ? true : false;
    },
    installPlugin(item) {
      let $ = jQuery;
      this.loading = true;

      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          action: "webinane_commerce_user_connect_install_plugin",
          item: item,
          nonce: this.nonce,
        },
        success: (res) => {
          this.loading = false;
          if (res.success) {
            this.$notify({
              type: "success",
              message: res.data.message,
              offset: 40,
            });
            window.location = location.href;
          } else {
            this.$notify({
              type: "error",
              message: res.data.message,
              offset: 40,
            });
          }
        },
        error: (error) => {
          this.$notify({
            type: "error",
            message: error.responseJSON.data.message,
            offset: 40,
          });
        },
        complete: (error) => {
          this.loading = false;
        },
      });
    },
    activatePlugin(item) {
      let $ = jQuery;
      this.loading = true;

      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          action: "webinane_commerce_user_connect_activate_plugin",
          item: item,
          nonce: this.nonce,
        },
        success: (res) => {
          this.loading = false;
          if (res.success) {
            this.$notify({
              type: "success",
              message: res.data.message,
              offset: 40,
            });
            window.location = location.href;
          } else {
            this.$notify({
              type: "error",
              message: res.data.message,
              offset: 40,
            });
          }
        },
        error: (error) => {
          this.$notify({
            type: "error",
            message: error.responseJSON.data.message,
            offset: 40,
          });
        },
        complete: (error) => {
          this.loading = false;
        },
      });
    },
  },
};
</script>

<style lang="scss">
#wpcm-admin-live-connect {
  .price {
    font-size: 20px;
    font-weight: bold;
  }
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    float: right;
  }

  .image {
    width: 100%;
    display: block;
    height: auto;
  }

  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }

  .clearfix:after {
    clear: both;
  }
}
</style>

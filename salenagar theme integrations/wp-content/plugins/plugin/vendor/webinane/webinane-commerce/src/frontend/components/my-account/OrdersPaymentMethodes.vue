<template>
  <div>
    <div class="wpcm-tab-area">
      <h3>{{$webinane_i18n.my_methodes}}</h3>
      <div class="wpcm-order-table">
        <div class="wpcm-table-responsive">
          <el-container v-if="gateways">
            <el-row :gutter="20" type="flex" v-for="set in gateways" :key="set.ID">
              <el-col :span="6" v-for="gate_set in set" :key="gate_set.ID">
                <div :class="gate_set.id">
                  <img :src="gate_set.icon" :alt="gate_set.name" />
                  <span class="title">{{gate_set.name}}</span>
                </div>
              </el-col>
            </el-row>
          </el-container>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      gateways: {},
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      let $ = jQuery;
      this.loading = true;

      $.ajax({
        url: wpcm_data.ajaxurl,
        type: "post",
        data: {
          action: wpcm_data.ajax_action,
          callback: [
            "WebinaneCommerce\\Classes\\MyAccount",
            "get_user_payment_methods",
          ],
        },
        success: (res) => {
          if (res.gateways) {
            this.gateways = res.gateways;
          } else {
            this.$notify({
              type: "warning",
              message: res.data.message,
              title: "Warning",
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

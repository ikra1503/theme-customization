<template>
  <tr v-if="order_data.ID">
    <td data-title="Order">
      <div class="wpcm-order-item">
        <div class="wpcm-item-title">
          <h4>{{ order_data.post_title }}</h4>
          <span
            class="wpcm-order-id"
            v-if="order_data.meta._order_transaction_id"
          >{{ order_data.meta._order_transaction_id }}</span>
        </div>
      </div>
    </td>
    <td data-title="Type">
      <span class="wpcm-order-type">{{ order_data.meta._wpcm_order_gateway }}</span>
    </td>
    <td data-title="Price">
      <span class="wpcm-price">{{ formatPrice(order_data.meta._wpcm_order_total)}}</span>
    </td>
    <td data-title="Earning">
      <span class="wpcm-price-total">{{ getStatus(order_data.post_status) }}</span>
    </td>
    <td data-title="More Info">
      <span class="wpcm-order-info" @click.prevent="$emit('openpopup', order_data)">
        <i class="fa fa-circle"></i>
        <i class="fa fa-circle"></i>
        <i class="fa fa-circle"></i>
      </span>
    </td>
  </tr>
  <tr v-else>
    <td colspan="3">Loading .....</td>
    <td>Loading .....</td>
  </tr>
</template>



<script>
export default {
  name: "order-row",
  props: ["order"],
  data() {
    return {
      order_data: {},
      loading: false,
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
            "get_single_order",
          ],
          order_id: this.order,
        },
        success: (res) => {
          this.order_data = res.order_data;
        },
        complete: (res) => {
          this.loading = false;
        },
      });
    },
    formatPrice(price) {
      let settings = this.$parent.settings;
      let sym = settings.symbol;
      let d_point = settings.d_point;
      let d_sep = settings.d_sep;
      let position = settings.position;
      let sep = settings.sep;

      price = this.formatMoney(price, d_point, d_sep, sep);
      if (position == "left") {
        price = sym + " " + price;
      } else if (position == "right") {
        price = price + " " + sym;
      } else {
        price = sym + " " + price;
      }
      return price;
    },
    formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
      try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        const negativeSign = amount < 0 ? "-" : "";

        let i = parseInt(
          (amount = Math.abs(Number(amount) || 0).toFixed(decimalCount))
        ).toString();
        let j = i.length > 3 ? i.length % 3 : 0;

        return (
          negativeSign +
          (j ? i.substr(0, j) + thousands : "") +
          i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) +
          (decimalCount
            ? decimal +
              Math.abs(amount - i)
                .toFixed(decimalCount)
                .slice(2)
            : "")
        );
      } catch (e) {
        this.$notify({ type: "error", message: e });
      }
    },
    getStatus(status) {
      let statuses = [
        { code: "processing", label: this.$webinane_i18n.processing },
        { code: "pending_payment", label: this.$webinane_i18n.pending_payment },
        { code: "hold", label: this.$webinane_i18n.hold },
        { code: "completed", label: this.$webinane_i18n.completed },
        { code: "cancelled", label: this.$webinane_i18n.cancelled },
        { code: "refunded", label: this.$webinane_i18n.refunded },
        { code: "failed", label: this.$webinane_i18n.failed },
      ];

      let found = _.find(statuses, function (s) {
        return s.code == status;
      });

      if (found.label) {
        return found.label;
      }
      return "Not Found";
    },
  },
};
</script>

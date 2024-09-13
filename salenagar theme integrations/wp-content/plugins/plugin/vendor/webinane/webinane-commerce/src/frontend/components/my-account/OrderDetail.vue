<template>
  <table class="wpcm-table">
    <tr>
      <td>{{$webinane_i18n.id | uppsercase}}</td>
      <td>{{ popup_data.ID }}</td>
    </tr>
    <tr>
      <td>{{$webinane_i18n.amount}}</td>
      <td v-if="popup_data.meta">{{ formatPrice(popup_data.meta._wpcm_order_total) }}</td>
    </tr>
    <tr>
      <td>{{$webinane_i18n.full_name}}</td>
      <td>{{ customer.name }}</td>
    </tr>
    <tr>
      <td>{{$webinane_i18n.email}}</td>
      <td>{{ customer.email }}</td>
    </tr>
    <tr>
      <td>{{$webinane_i18n.contact}}</td>
      <td v-if="customer.meta">{{ customer.meta.billing_phone_no }}</td>
    </tr>
    <tr>
      <td>{{$webinane_i18n.address}}</td>
      <td v-if="customer.meta">
        {{ customer.meta.billing_address_line_1 }}
        {{ customer.meta.billing_address_line_2 }}
        <br />
        {{ customer.meta.billing_city }}
        <br />
        {{ customer.meta.billing_zip }}
        <br />
      </td>
    </tr>
    <tr>
      <td>{{$webinane_i18n.status}}</td>
      <td>{{ getStatus(popup_data.post_status) }}</td>
    </tr>
    <tr>
      <td>{{$webinane_i18n.payment_method}}</td>
      <td v-if="popup_data.meta">{{ popup_data.meta._wpcm_order_gateway | capitalize }}</td>
    </tr>

    <tr>
      <td>{{$webinane_i18n.date}}</td>
      <td>{{ popup_data.post_date }}</td>
    </tr>
    <tr v-if="popup_data.meta._order_subscription_id">
      <td>{{$webinane_i18n.recurring}}</td>
      <td>Its a recurring payment # {{ popup_data.meta._order_subscription_id }}</td>
    </tr>
    <tr>
      <td>{{$webinane_i18n.items}}</td>
      <td>
        <template v-for="item in popup_data.order_items" v-if="popup_data.order_items">
          {{ item.order_item_name }}
          <br />
        </template>
      </td>
    </tr>
  </table>
</template>

<script>
export default {
  name: "order-detail",
  props: ["popup_data", "customer", "settings"],
  data() {
    return {};
  },
  filters: {
    capitalize: function (value) {
      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    },
    uppsercase: function (value) {
      if (!value) return "";
      value = value.toString();
      return value.toUpperCase();
    },
  },
  methods: {
    formatPrice(price) {
      let settings = this.settings;
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

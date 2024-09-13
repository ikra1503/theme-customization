<template>
  <div id="lfndn-plgn" class="lfndn-plgn wpcm-wrapper" @click="handleInboxClick($event)">
    <MainHeader @onChange="changeTab" @inbox_menu_clicked="inbox_clicked = true">
      <template v-slot:menu-dropdown>
        <MenuDropdown :clicked="inbox_clicked"></MenuDropdown>
      </template>
    </MainHeader>
    <BreadCrumbs><span slot="title">{{BreadCrumbsLabel()}}</span></BreadCrumbs>
    <div class="clearfix"></div>
    <transition name="fade">
      <Dashboard :key="1" :base_url="base_url" v-if="current_tab == 'dashboard'"></Dashboard>
      <Customers :key="2" :base_url="base_url" v-if="current_tab == 'customers'"></Customers>
    </transition>
  </div>
</template>

<script>
import MainHeader from "./Header.vue";
import MenuDropdown from "./MenuDropdown.vue";
import BreadCrumbs from "./BreadCrumbs.vue";
import Dashboard from "./Dashboard.vue";
import Customers from "./Customers.vue";

export default {
  // name: 'app',
  components: {
    MainHeader,
    MenuDropdown,
    BreadCrumbs,
    Dashboard,
    Customers
  },
  props: {
    base_url: String
  },
  data() {
    return {
      inbox_clicked: false,
      show_dropdown: false,
      switcher_data: [],
      current_tab: "dashboard"
    };
  },
  mounted() {},

  methods: {
    changeTab(value) {
      this.current_tab = value;
    },
    BreadCrumbsLabel() {
      const labels = {
        dashboard: 'Dashboard',
        customers: 'Customers',
        orders: 'Donors',
      }

      return _.get(labels, this.current_tab)
    },
    handleInboxClick(event) {
      let $ = jQuery;
      let el = event.target;
      if ($(el).hasClass("inbox-btn")) {
        return;
      }
      if (
        $(el)
          .parents()
          .hasClass("inbox-btn")
      ) {
        return;
      }

      if (
        $(el)
          .parents()
          .hasClass("msg-list-wrap")
      ) {
        return;
      }

      this.inbox_clicked = false;
    }
  }
};
</script>

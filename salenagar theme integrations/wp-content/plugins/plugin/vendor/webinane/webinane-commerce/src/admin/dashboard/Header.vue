<template>
  <header>
    <div class="wpcm-container">
      <nav>
        <ul>
          <li>
            <a href="#" @click.prevent="$emit('onChange', 'dashboard')">
              <i>
                <img
                  :src="$parent.base_url+'assets/images/icons/menu-icon1.png'"
                  alt="menu-icon2.png"
                />
              </i>
              {{ $wpcm_i18n.dashboard }}
            </a>
          </li>
          <li v-for="menu in menus">
            <a :href="menu.link">
              <i v-html="menu.icon"></i>{{ menu.label }}
            </a>
          </li>
          <li>
            <a href="#" @click.prevent="$emit('onChange', 'customers')">
              <i>
                <img
                  :src="$parent.base_url+'assets/images/icons/donor-icon.png'"
                  alt="menu-icon4.png"
                />
              </i>
              {{ $wpcm_i18n.customers }}
            </a>
          </li>
          <li v-if="false">
            <a class="inbox-btn" href="#" @click.prevent="clickedInt()">
              <i>
                <img
                  :src="$parent.base_url+'assets/images/icons/menu-icon5.png'"
                  alt="menu-icon5.png"
                />
              </i>
              {{ $wpcm_i18n.notices }}
            </a>
            <slot name="menu-dropdown"></slot>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- Header -->
</template>

<script>
export default {
  name: "MainHeader",
  props: {},
  data() {
    return {
      show_notices: false,
      menus: []
    };
  },
  mounted() {
    this.getMenus()
  },
  methods: {
    getMenus() {
      let $ = jQuery
      $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {action: 'webinane_commerc_dashboard_menus', nonce: wpcm_data.nonce},
        success: (res) => {
          this.menus = res.data
        }
      })
    },
    clickedInt() {
      let $ = jQuery;
      this.$emit("inbox_menu_clicked");
      if ($(".msg-list").length > 0) {
        var ps = new PerfectScrollbar(".msg-list");
      }
    }
  }
};
</script>

<style lang="scss">
</style>

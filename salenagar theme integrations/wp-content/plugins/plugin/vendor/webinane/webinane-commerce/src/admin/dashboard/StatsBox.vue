<template>
  <section>
    <div class="gap gray-bg" v-loading="loading">
      <div class="wpcm-container">
        <slot name="date-filter"></slot>
        <slot name="sec-title"></slot>
        <div class="facts-wrap">
          <div class="wpcm-row" v-if="data">
            <template v-for="(item, index) in data">
              <transition name="fade" :key="index">
                <div class="wpcm-col-md-4 wpcm-col-sm-6 wpcm-col-lg-4" v-if="isVisible(item)">
                  <div :class="'fact-box '+ item.color">
                    <h4 v-html="item.earnings"></h4>
                    <span>{{ item.title }}</span>
                    <i>{{ item.percentage }}</i>
                    <div class="fact-inner" v-if="item.prevtitle">
                      <h6 v-html="item.prevearnings"></h6>
                      <span>{{ item.prevtitle }}</span>
                    </div>
                  </div>
                </div>
              </transition>
            </template>
          </div>
        </div>
        <!-- Facts Wrap -->
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "stats-box",
  props: ["items", 'start_date', 'end_date'],
  data() {
    return {
      data: [],
      loading: false
    };
  },
  mounted() {
    // this.getData()
  },
  methods: {
    getData() {
      let $ = jQuery;
      this.loading = true;
      $.ajax({
        url: ajaxurl,
        data: {
          action: "webinane_commerce_dashboard_chart",
          type: "stats",
          nonce: wpcm_data.nonce,
          start_date: this.start_date,
          end_date: this.end_date
        },
        responseType: "json",
        success: res => {
          this.data = res.data;
          this.$emit("on-fetch-items", res.data);
        },
        fail: error => {},
        complete: res => {
          this.loading = false;
        }
      });
    },
    isVisible(item) {
      if (this.items[item.id] !== undefined) {
        if (this.items[item.id].value == true) {
          return true;
        }
      }
      return false;
    }
  }
};
</script>

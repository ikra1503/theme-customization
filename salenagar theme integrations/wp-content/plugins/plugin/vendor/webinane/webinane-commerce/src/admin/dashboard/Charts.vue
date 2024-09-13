<template>
  <section>
    <div class="gap remove-gap gray-bg" v-loading="loading">
      <div class="wpcm-container">
        <SecTitle :title="$wpcm_i18n.charts">
          <template v-slot:filteration>
            <ul class="fltr-lnks">
              <li>
                <a href="#" title @click.prevent="chart_type = 'bar'">
                  <img
                    :src="$parent.base_url + 'assets/images/icons/fltr-icon1.png'"
                    alt="fltr-icon1.png"
                  />
                </a>
              </li>
              <li>
                <a href="#" title @click.prevent="chart_type = 'line'">
                  <img
                    :src="$parent.base_url + 'assets/images/icons/fltr-icon2.png'"
                    alt="fltr-icon2.png"
                  />
                </a>
              </li>
              <li>
                <a href="#" title @click.prevent="chart_type = 'area'">
                  <img
                    :src="$parent.base_url + 'assets/images/icons/fltr-icon3.png'"
                    alt="fltr-icon3.png"
                  />
                </a>
              </li>
            </ul>
            <div class="opt-wrap">
              <div class="slc-wrp" v-if="true">
                <el-select v-model="orderby" @change="fetchData()">
                  <el-option key="day" value="day" :label="$wpcm_i18n.day"></el-option>
                  <el-option key="week" value="week" :label="$wpcm_i18n.week"></el-option>
                  <el-option key="month" value="month" :label="$wpcm_i18n.month"></el-option>
                </el-select>
              </div>
              <div class="opt-tgls-wrap">
                <i class="fa fa-ellipsis-v" @click.prevent="clickedInt()"></i>
                <transition name="fade">
                  <ul :class="'opt-tgls-lst'" v-if="show_dropdown" key="1">
                    <li v-for="(item, index) in switcher_data" :key="index">
                      <span>{{item.label}}</span>
                      <el-switch
                        v-model="item.value"
                        active-color="#13ce66"
                        inactive-color="#ffffff"
                      ></el-switch>
                    </li>
                  </ul>
                </transition>
              </div>
            </div>
          </template>
        </SecTitle>
        <div class="filtrs-wrap">
          <div class="wpcm-row">
            <template v-for="(chart, index) in chart_json">
              <LineChart
                v-if="chart_type == 'line' && isVisible(chart)"
                :data="chart"
                :key="index"
                :base_url="$parent.base_url"
              ></LineChart>
              <BarChart
                v-if="chart_type == 'bar' && isVisible(chart)"
                :data="chart"
                :key="index"
                :base_url="$parent.base_url"
              ></BarChart>
              <AreaChart
                v-if="chart_type == 'area' && isVisible(chart)"
                :data="chart"
                :key="index"
                :base_url="$parent.base_url"
              ></AreaChart>
            </template>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import SecTitle from "./SecTitle.vue";
import AreaChart from "./AreaChart.vue";
import BarChart from "./BarChart.vue";
import LineChart from "./LineChart.vue";

export default {
  name: "charts",
  components: {
    SecTitle,
    AreaChart,
    BarChart,
    LineChart
  },
  props: {
    start_date: String,
    end_date: String
  },
  data() {
    return {
      orderby: "day",
      show_dropdown: false,
      switcher_data: [],

      chart_type: "bar",
      chart_json: [],
      icon: "",
      loading: false
    };
  },
  mounted() {
    // this.fetchData();
  },
  methods: {
    fetchData() {
      let $ = jQuery;
      this.loading = true;
      this.chart_json = []

      $.ajax({
        url: ajaxurl,
        data: {
          action: "webinane_commerce_dashboard_chart",
          type: "chart",
          groupby: this.orderby,
          nonce: wpcm_data.nonce,
          start_date: this.start_date,
          end_date: this.end_date
        },
        responseType: "json",
        success: res => {
          this.chart_json = res.data;
          this.updateSwitchers(res.data);
        },
        fail: error => {},
        complete: res => {
          this.loading = false;
        }
      });
    },
    clickedInt() {
      if (this.show_dropdown == false) {
        this.show_dropdown = true;
      } else {
        this.show_dropdown = false;
      }
    },
    activeClass() {
      return this.show_dropdown ? " active" : "";
    },
    isVisible(item) {
      if (this.switcher_data[item.id] !== undefined) {
        if (this.switcher_data[item.id].value == true) {
          return true;
        }
      }
      return false;
    },

    updateSwitchers(data) {
      let swt = {};
      _.each(data, value => {
        swt[value.id] = {
          label: this.$wpcm_i18n.show + " " + value.title,
          value: true
        };
      });

      this.switcher_data = swt;
    }
  }
};
</script>

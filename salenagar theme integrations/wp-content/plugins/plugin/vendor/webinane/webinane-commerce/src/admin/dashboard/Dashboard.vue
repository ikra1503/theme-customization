<template>
  <div>
    <StatsBox 
      ref="statsbox" 
      :items="switcher_data" 
       :start_date="start_date" 
       :end_date="end_date"
      @on-fetch-items="setItems"
    >
      <template v-slot:date-filter>
        <DateFilter @date-change="setDate" v-if="true"></DateFilter>
      </template>
      <template v-slot:sec-title>
        <SecTitle :title="$wpcm_i18n.performance">
          <template v-slot:filteration>
            <div class="opt-tgls-wrap">
              <i class="fa fa-ellipsis-v" @click.prevent="clickedInt()"></i>
              <transition name="fade">
                <ul :class="'opt-tgls-lst'" v-if="show_dropdown">
                  <li v-for="(item, index) in switcher_data" :key="index">
                    <span>{{item.label}}</span>
                    <el-switch v-model="item.value" active-color="#13ce66" inactive-color="#dddddd"></el-switch>
                  </li>
                </ul>
              </transition>
            </div>
          </template>
        </SecTitle>
      </template>
    </StatsBox>
    <Charts ref="charts"  :start_date="start_date" :end_date="end_date"></Charts>
	  <TableBoxes ref="tableboxes" :start_date="start_date" :end_date="end_date"></TableBoxes>
  </div>
</template>

<script>
import StatsBox from "./StatsBox.vue";
import DateFilter from "./DateFilter.vue";
import SecTitle from "./SecTitle.vue";
import Charts from "./Charts.vue";
import TableBoxes from "./TableBoxes.vue";

export default {
  components: {
    StatsBox,
    DateFilter,
    SecTitle,
    Charts,
    TableBoxes
  },
  props: {
    base_url: String
  },
  data() {
    return {
      inbox_clicked: false,
      show_dropdown: false,
      switcher_data: [],
      start_date: '',
      end_date: ''
    };
  },
  mounted() {},
  methods: {
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
    setItems(data) {
      let swt = {};
      _.each(data, value => {
        swt[value.id] = {
          label: "Show " + value.title,
          value: true
        };
      });

      this.switcher_data = swt;
    },
    setDate(start, end) {
      this.start_date = start
      this.end_date = end

      setTimeout(() => {
        this.$refs.statsbox.getData()
        this.$refs.charts.fetchData()
        this.$refs.tableboxes.getData()
      }, 300)
    }
  }
};
</script>
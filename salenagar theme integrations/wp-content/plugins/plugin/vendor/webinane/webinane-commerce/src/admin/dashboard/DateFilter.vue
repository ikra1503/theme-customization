<template>
  <div class="date-filter-wrap">
    <h6>{{ $wpcm_i18n.date_range }}:</h6>
    <span @click.prevent="clickedInt()">
      {{ start_date }} -
      <i>{{ end_date }}</i>
    </span>
    <div :class="'date-filter-inner'+activeClass()">
      <template>
        <el-tabs v-model="activeName" @tab-click="handleClick">
          <el-tab-pane label="Preset" name="first">
            <template>
              <div class="mt-4 mb-4">
                <el-radio-group v-model="checkedDate">
                  <el-radio
                    v-for="(data, index) in date"
                    :label="data.val"
                    :value="data.val"
                    :key="data.val"
                    @change="setDate()"
                  >{{data.label}}</el-radio>
                </el-radio-group>
              </div>
            </template>
            <div class="compare-box" v-if="false">
              <h6>{{ $wpcm_i18n.compare_to }}</h6>
              <template>
                <el-radio-group v-model="radio">
                  <el-radio label="Previous period">{{$wpcm_i18n.prev_period}}</el-radio>
                  <el-radio label="Previous Year">{{ $wpcm_i18n.prev_year }}</el-radio>
                </el-radio-group>
              </template>
              <a href="#" title>{{$wpcm_i18n.update}}</a>
            </div>
          </el-tab-pane>
          <el-tab-pane label="Custom" name="second">
            <template>
              <div class="block">
                <span class="demonstration">{{ $wpcm_i18n.default }}</span>
                <el-date-picker
                  v-model="value1"
                  type="daterange"
                  value-format="yyyy-MM-dd"
                  format="MMM dd, yyyy"
                  range-separator="To"
                  start-placeholder="Start date"
                  end-placeholder="End date"
                  @change="rangeChange"
                ></el-date-picker>
              </div>
            </template>
          </el-tab-pane>
        </el-tabs>
      </template>
    </div>
  </div>
  <!-- Date Filter Wrap -->
</template>

<script>
const date_list = [
  {val: 'today', label: "Today"},
  {val: 'yesterday', label: "Yesterday"},
  {val: 'week_to_date', label: "Week to Date"},
  {val: 'last_week', label: "last Week"},
  {val: 'month_to_date', label: "Month to date"},
  {val: 'last_month', label: "Last Month"},
  {val: 'quarter_to_date', label: "Quarter to date"},
  {val: 'last_quarter', label: "last quarter"},
  {val: 'year_to_date', label: "Year to date"},
  {val: 'last_year', label: "Last Year"}
];
export default {
  name: "date-filter",
  props: {},
  data() {
    return {
      activeName: "first",
      checkedDate: "month_to_date",
      date: date_list,
      radio: "Previous period",
      show_dropdown: false,
      pickerOptions: {},
      value1: "",
      value2: "",
      start_date: '',
      end_date: ''
    };
  },
  mounted() {
    this.setDate()
  },
  methods: {
    handleClick(tab, event) {},
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
    moment(date) {
      return moment(moment)
    },
    setDate() {
      switch(this.checkedDate) {
        case 'today' : 
          this.start_date = moment().startOf('isoDay').format('YYYY-MM-DD')
          this.end_date = moment().endOf('isoDay').format('YYYY-MM-DD')
        break
        case 'yesterday' :
          this.start_date = moment().subtract(1, 'days').startOf('isoDay').format('YYYY-MM-DD')
          this.end_date = moment().subtract(1, 'days').endOf('isoDay').format('YYYY-MM-DD')
        break

        case 'week_to_date' : 
          this.start_date = moment().subtract(7, 'days').startOf('isoDay').format('YYYY-MM-DD')
          this.end_date = moment().endOf('isoDay').format('YYYY-MM-DD')
        break

        case 'last_week':
          this.start_date = moment().subtract(1, 'weeks').startOf('isoWeek').format('YYYY-MM-DD')
          this.end_date = moment().subtract(1, 'weeks').endOf('isoWeek').format('YYYY-MM-DD')
        break

        case 'month_to_date':
          this.start_date = moment().subtract(30, 'days').startOf('isoDay').format('YYYY-MM-DD')
          this.end_date = moment().endOf('isoDay').format('YYYY-MM-DD')
        break

        case 'last_month':
          this.start_date = moment().subtract(4, 'months').startOf('isoMonth').format('YYYY-MM-DD')
          this.end_date = moment().subtract(1, 'months').endOf('isoMonth').format('YYYY-MM-DD')
        break

        case 'quarter_to_date':
          this.start_date = moment().subtract(90, 'days').startOf('isoDay').format('YYYY-MM-DD')
          this.end_date = moment().endOf('isoDay').format('YYYY-MM-DD')
        break
        case 'last_quarter':
          this.start_date = moment().subtract(6, 'months').startOf('isoMonth').format('YYYY-MM-DD')
          this.end_date = moment().subtract(3, 'months').endOf('isoMonth').format('YYYY-MM-DD')
        break
        case 'year_to_date':
          this.start_date = moment().subtract(365, 'days').startOf('isoDay').format('YYYY-MM-DD')
          this.end_date = moment().endOf('isoDay').format('YYYY-MM-DD')
        break
        case 'last_year':
          this.start_date = moment().subtract(1, 'years').startOf('isoYear').format('YYYY-MM-DD')
          this.end_date = moment().subtract(1, 'years').endOf('isoYear').format('YYYY-MM-DD')
        break
      }

      this.$emit('date-change', this.start_date, this.end_date)
      this.show_dropdown = false
    },
    rangeChange() {
      this.start_date = this.value1[0]
      this.end_date = this.value1[1]
      this.$emit('date-change', this.start_date, this.end_date)
      this.show_dropdown = false
    }
  }
};
</script>

<template>
  <transition name="fade">
    <div class="wpcm-col-md-6 wpcm-col-sm-12 wpcm-col-lg-6">
      <div class="wdgt-box flex">
        <div class="wdgt-title">
          <h4>{{data.title}}</h4>
          <div class="wdgt-opt">
            <a href="#" title>
              <img :src="base_url + 'assets/images/icons/wdgt-icon1.png'" alt="wdgt-icon1.png" />
            </a>
            <a href="#" title>
              <img :src="base_url + 'assets/images/icons/wdgt-icon2.png'" alt="wdgt-icon2.png" />
            </a>
          </div>
        </div>
        <div ref="chart" class="chart"></div>
      </div>
      <!-- Chart Box -->
    </div>
  </transition>
</template>

<script>
export default {
  name: "line-chart",
  props: ["data", "base_url"],
  data() {
    return {
      chart_json: [],
      icon: "../assets/images/wdgt-icon1.png"
    };
  },
  mounted() {
    let el = this.$refs.chart;

    window.Highcharts.chart(el, {
      colors: ["#74d887", "#5b93d3"],
      chart: {
        type: "line",
        backgroundColor: null
      },
      title: {
        text: null
      },
      subtitle: {
        text: null
      },
      legend: {
        layout: "vertical",
        align: "left",
        verticalAlign: "top",
        x: 50,
        y: 0,
        floating: true,
        backgroundColor:
          (Highcharts.theme && Highcharts.theme.legendBackgroundColor) ||
          "#FFFFFF"
      },
      xAxis: this.data.xAxis,
      yAxis: {
        min: 0,
        title: {
          text: null
        }
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat:
          '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: "</table>",
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: this.data.series
    });
  }
};
</script>

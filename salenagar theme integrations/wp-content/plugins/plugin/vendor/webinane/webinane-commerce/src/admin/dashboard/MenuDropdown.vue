<template>
  <div :class="'msg-list-wrap'+activeClass()">
    <ul class="msg-list" v-if="data.length">
      <li v-for="(item, index) in data" :key="index">
        <i :class="'fa fa-'+item.icon"></i>
        <div class="msg-inr">
          <h4>
            <a :href="item.link" :title="item.title">{{ item.title }}</a>
          </h4>
          <span>{{ item.time }}</span>
          <a href="#" title>Share Feedback</a>
          <p>{{ item.desc }}</p>
        </div>
      </li>
    </ul>
  </div>
  <!-- Messages List Wrap -->
</template>

<script>
export default {
  name: "menu-dropdown",
  props: {
    clicked: Boolean
  },
  data() {
    return {
      data: []
    };
  },
  mounted() {
    fetch(
      ajaxurl + "?action=webinane_commerce_dashboard_chart&type=notification"
    )
      .then(res => res.json())
      .then(res => {
        this.data = res.data;
      });
  },
  methods: {
    activeClass() {
      return this.clicked ? " active" : "";
    }
  }
};
</script>

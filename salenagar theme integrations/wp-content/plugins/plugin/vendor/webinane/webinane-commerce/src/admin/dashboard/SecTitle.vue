<template>
  <div class="sec-title" v-if="title">
    <h3>{{ title }}</h3>
    <slot name="filteration"></slot>
  </div>
</template>

<script>
export default {
  name: "sec-title",
  props: {
    title: String
  },
  data() {
    return {
      item: {
        title: ""
      }
    };
  }
};
</script>

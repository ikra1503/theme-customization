<template>
  <div class="wpcm-d-flex flex-wrap">
    <div
      class=""
      :style="{ width, padding: '15px' }"
      v-for="(item, index) in items"
      :key="index"
    >
      <a
        :href="item.url"
        target="_blank"
        :style="{ width: '100%', display: 'block' }"
      >
        <el-image :src="item.src" style="width: 285px; height: 200px" fit="fit" />
        <h5 v-if="item.title">{{ item.title }}</h5>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    width: {
      type: String,
      default: "25%",
    },
    items: Array,
  },
};
</script>
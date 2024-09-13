<template>
  <div>
    <a v-if="link">
      <el-image :src="src" :fit="fit" :lazy="lazy" />
    </a>
  </div>
</template>

<script>
export default {
  name: 'wpcm-image',
  props: ['link', 'width', 'src', 'fit', 'alt', 'lazy' ]
}
</script>
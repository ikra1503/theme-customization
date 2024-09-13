<template>
  <div class="flex gray-bg breadcrumbs-wrap">
    <div class="wpcm-container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#" title>Lifeline Donation Pro</a>
        </li>
        <li class="breadcrumb-item active"><slot name="title"></slot></li>
      </ol>
    </div>
  </div>
  <!-- Breadcrumbs Wrap -->
</template>

<script>
export default {
	name: "bread-crumbs",
	props: {
		
	}
};
</script>

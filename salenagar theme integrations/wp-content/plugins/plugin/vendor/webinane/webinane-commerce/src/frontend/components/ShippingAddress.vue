<template>
	<div>
		<transition name="fade">
			<slot></slot>
		</transition>
	</div>
</template>

<script>
	export default {
		props: {
			ship_diff: Boolean
		}
	}
</script>
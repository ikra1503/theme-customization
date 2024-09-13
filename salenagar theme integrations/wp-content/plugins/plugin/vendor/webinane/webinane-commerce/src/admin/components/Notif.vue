<template>
	<div>
		<transition name="fade">
			<div :class="'alert alert-'+type" v-show="result" @click="hideMsg">
				{{msg}}
			</div>
		</transition>
	</div>
</template>

<script>
export default {
	props: {
		result: Boolean,
		type: String,
		msg: String
	},
	watch: {
		result: function (val) {
	      this.hideMsg()
	    },
	},
	methods: {
		hideMsg() {
			let thisis = this
			if( this.result ) {
				setTimeout(function(){
					thisis.$emit('done', true);
				}, 5000)
			}
		}
	}
}
</script>

<style>
	.alert {
		position: fixed;
		top: 33px;
	}
</style>
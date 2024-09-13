const { __, setLocaleData } = wp.i18n;
// inject a handler for `myOption` custom option
var trans = {
	methods: {
		__(str) {
			return __(str, 'wp-commerce')
		}
	}
}

var dep_visibility = {
	data() {
		return {
			isVisible: false,
		}
	},
	methods: {
		checkIsVisible() {
			let dep = this.$root.dep_fields
			let thisis = this
			if( ! _.size(this.$root.dep_fields) ) {
				this.isVisible = true
				return
			}
			if( this.$root.dep_fields[this.field.id] !== undefined ) {
				if( this.$root.dep_fields[this.field.id] === true ) {
					this.isVisible = true
					return
				} else {
					this.isVisible = false
					return
				}
			}
			this.isVisible = true
		}
	}
}

export {
	trans,
	dep_visibility
}

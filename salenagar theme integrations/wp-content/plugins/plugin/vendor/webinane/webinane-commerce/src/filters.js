
Vue.filter('dateformat', function (value) {
	let options = { year: 'numeric', month: '2-digit', day: '2-digit' };

	let date = new Date(value);
	return date.toLocaleDateString("en-US", options)
})
Vue.filter('number', function (value) {
	return parseInt(value)
})

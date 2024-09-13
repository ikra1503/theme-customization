import App from './dashboard/App.vue';
import i18n from './dashboard/i18n'
const ElementUI = window.ELEMENT
ElementUI.locale(window.ELEMENT.lang.en)

Vue.use(ElementUI);
Vue.use(i18n)

if( document.getElementById('wpcm-admin-dashboard') ) {

	Vue.prototype.$wpcm_i18n = i18n

	new Vue({
		el: '#wpcm-admin-dashboard',
		components: {
			App
		}
	})
}

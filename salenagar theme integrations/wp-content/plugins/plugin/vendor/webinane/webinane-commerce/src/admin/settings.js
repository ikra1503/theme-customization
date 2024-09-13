// import 'element-ui/lib/theme-chalk/index.css';
import '../main.scss';
import i18n from '../i18n.js'
import store from '../stores/settings'
import Connect from './components/Connect.vue';
import Settings from './settings/Settings.vue'
const ElementUI = window.ELEMENT
ElementUI.locale(window.ELEMENT.lang.en)

window.$ = jQuery
Vue.use(ElementUI);
Vue.use(i18n)

Vue.component('wpcm-fields', require('../components/fields/Fields.vue').default);

if( document.querySelector('.wpcm-settings-wrapper') ) {

	const app = new Vue({
    store,
		components: {
			Settings
		},
		el: '.wpcm-settings-wrapper',
		data: {
		},

		computed: {
		},
		mounted() {
		},
		methods: {}

	});
}



if( document.getElementById('wpcm-admin-live-connect') ) {
	
	new Vue({
		el: '#wpcm-admin-live-connect',
		components: {
			Connect
		}
	})
}
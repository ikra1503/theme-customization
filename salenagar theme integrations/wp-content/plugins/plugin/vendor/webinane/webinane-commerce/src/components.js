
// require('./components/fields/fields')

Vue.component('billing-address', require('./admin/components/orders/BillingAddress.vue').default);
Vue.component('shipping-address', require('./admin/components/orders/ShippingAddress.vue').default);
Vue.component('general', require('./admin/components/orders/General.vue').default);
Vue.component('order-items', require('./admin/components/orders/Items.vue').default);
Vue.component('order-notes', require('./admin/components/orders/Notes.vue').default);
Vue.component('notif', require('./admin/components/Notif.vue').default);
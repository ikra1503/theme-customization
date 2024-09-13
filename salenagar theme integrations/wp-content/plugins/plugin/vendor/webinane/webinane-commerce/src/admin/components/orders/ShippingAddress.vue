<template>
    <div>
        <div class="wpcm-order-detailbox" @click="closeEditing($event)" v-loading="loading">
            <h4 class="wpcm-order-detail-header">{{ $webinane_i18n.shipping }}</h4>
            <div class="wpcm-order-detail-content">
                <form class="wpcm-order-form" action="">
                    <div class="wpcm-billing-btns">
                        <a href="#" @click.prevent="loadShipping" class="wpcm-primary-colr">
                            <i class="fa fa-upload" v-if="loading !== 'load'"></i>
                            <i class="fa fa-refresh fa-spin" v-if="loading == 'load'"></i>
                            {{ $webinane_i18n.load_shipping_add }}
                        </a>
                        <a href="#" @click.prevent="copyBilling" class="wpcm-primary-colr">
                            <i class="far fa-copy" v-if="loading != 'copy'"></i>
                            <i class="fa fa-refresh fa-spin" v-if="loading == 'copy'"></i>
                            {{ $webinane_i18n.copy_billing_add }}
                        </a>
                    </div>
                    <div class="wpcm-billing-info" v-if="$root.customer_data.meta_data">
                        <div class="wpcm-biling-group">
                            <label>{{ $webinane_i18n.name }}:</label>
                            <span v-if="isEditing('shipping_name') == false">{{$root.customer_data.meta_data.shipping_first_name}} {{$root.customer_data.meta_data.shipping_last_name}}</span>
                            <input v-if="isEditing('shipping_name')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_first_name" placeholder="$webinane_i18n.first_name">
                            <input v-if="isEditing('shipping_name')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_last_name" placeholder="$webinane_i18n.last_name">
                            <a v-if="isEditing('shipping_name')" href="#" @click.prevent="saveField('shipping_name', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('shipping_name') == false" href="#" title="" @click.prevent="editField('shipping_name')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                        <div class="wpcm-biling-group">
                            <label>{{ $webinane_i18n.company }}:</label>
                            <span v-if="isEditing('company') == false">{{$root.customer_data.meta_data.shipping_company}}</span>
                            <input v-if="isEditing('shipping_company')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_company" >
                            <a v-if="isEditing('shipping_company')" href="#" @click.prevent="saveField('shipping_company', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('shipping_company') == false" href="#" title="" @click.prevent="editField('shipping_company')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                        
                        <div class="wpcm-biling-group">
                            <label>{{ $webinane_i18n.phone }}:</label>
                            <span v-if="isEditing('shipping_phone_no') == false">{{$root.customer_data.meta_data.shipping_phone_no}}</span>
                            <input v-if="isEditing('shipping_phone_no')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_phone_no" >
                            <a v-if="isEditing('shipping_phone_no')" href="#" @click.prevent="saveField('shipping_phone_no', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('shipping_phone_no') == false" href="#" title="" @click.prevent="editField('shipping_phone_no')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                        <div class="wpcm-biling-group">
                            <label>{{ $webinane_i18n.address }}:</label>
                            <span v-if="isEditing('shipping_address') == false">
                                {{$root.customer_data.meta_data.shipping_address_line_1}}<br/> 
                                {{$root.customer_data.meta_data.shipping_city}}<br/> 
                                {{$root.customer_data.meta_data.shipping_zip }} <br/>
                                <template v-if="$root.customer_data.meta_data.shipping_state">
                                    {{$root.customer_data.meta_data.shipping_state}} <br/>
                                </template>
                                {{$root.customer_data.meta_data.shipping_base_country}}
                            </span>
                            <input v-if="isEditing('shipping_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_address_line_1" >
                            <label v-if="isEditing('shipping_address')">{{ $webinane_i18n.address_2 }}:</label>
                            <input v-if="isEditing('shipping_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_address_line_2" >
                            <label v-if="isEditing('shipping_address')">{{ $webinane_i18n.zip }}:</label>
                            <input v-if="isEditing('shipping_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_zip" >
                            <label v-if="isEditing('shipping_address')">{{ $webinane_i18n.city }}:</label>
                            <input v-if="isEditing('shipping_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_city" >
                            <label v-if="isEditing('shipping_address')">{{ $webinane_i18n.country }}:</label>
                            <input v-if="isEditing('shipping_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_country" >
                            <label v-if="isEditing('shipping_address')">{{ $webinane_i18n.state }}:</label>
                            <input v-if="isEditing('shipping_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.shipping_state" >
                            <a v-if="isEditing('shipping_address')" href="#" @click.prevent="saveField('address', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('shipping_address') == false" href="#" title="" @click.prevent="editField('shipping_address')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'shipping-address',
    data() {
        return {
            loading: false,
            l_el: '', // Loading specific element
            fields: {
                name: 'Saludin Bhuiyan',
            },
            editing: false,
            editing_field: ''
        }
    },
    mounted() {
        let thisis = this
        jQuery(document).on('keyup',function(evt) {
            if (evt.keyCode == 27) {
               thisis.editing = false
            }
        });
        
    },
    methods: {
        editField(field) {
            this.editing = true
            this.editing_field = field
        },
        isEditing(field) {
            return (this.editing == true && this.editing_field == field )
        },
        saveField(field, event) {
            let thisis = this
            let target = event.target

            this.loading = true

            jQuery(target).addClass('fa-circle-notch fa-spin').removeClass('fa-check');

            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action: '_admin_orders_fields', customer: thisis.$root.customer_data, customer_id: thisis.$root.customer},
                success: (res) => {

                    thisis.$notify.success({
                      title: this.$webinane_i18n.success,
                      message: res.message,
                      offset: 30
                    });

                    thisis.editing = false
                    this.loading = false
                    thisis.editing_field = ''

                },
                error: (res) => {
                    
                    thisis.$notify.error({
                      title: this.$webinane_i18n.error,
                      message: res.statusText,
                      offset: 30
                    });

                    thisis.editing = false
                    thisis.editing_field = ''
                    this.loading = false
                }
            })
        },
        loadShipping() {
            let thisis = this
            let post_id = jQuery('#post_ID').val()
            let $ = jQuery

            if( this.$root.customer == '' ) {
                alert(this.$webinane_i18n.please_choose_customer_to_load_data);
                return;
            }

            this.loading = 'load'

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action: '_wpcommerce_admin_orders_customer_data', subaction: 'load_shipping', customer: thisis.$root.customer_data, customer_id: thisis.$root.customer, post_id: post_id},
                success: (res) => {
                    if( res.customer) {
                        this.$root.customer_data = res.customer
                    }
                    this.$notify.success({
                      title: this.$webinane_i18n.success,
                      message: this.$webinane_i18n.ship_data_loaded,
                      offset: 30
                    });
                    this.loading = false
                },
                error: (res) => {
                    this.loading = false
                    this.$notify.error({
                      title: this.$webinane_i18n.error,
                      message: res.statusText,
                      offset: 30
                    });
                }
            })
        },
        copyBilling() {

            if( ! confirm(this.$webinane_i18n.overwrite_ship_info)) {
                return;
            }

            let thisis = this
            let post_id = jQuery('#post_ID').val()
            let $ = jQuery

            if( this.$root.customer == '' ) {
                alert(this.$webinane_i18n.please_choose_customer_to_load_data);
                return;
            }

            this.loading = 'copy'

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action: '_wpcommerce_admin_orders_customer_data', subaction: 'copy_billing', customer: thisis.$root.customer_data, customer_id: thisis.$root.customer, post_id: post_id},
                success: function(res) {
                    thisis.$root.customer_data = res.customer
                },
                complete: function(res) {
                    thisis.loading = false
                }
            })
        },
        closeEditing(event) {
        }
    }
}
</script>
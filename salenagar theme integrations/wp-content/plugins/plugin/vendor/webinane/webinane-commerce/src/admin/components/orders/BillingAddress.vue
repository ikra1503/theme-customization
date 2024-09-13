<template>
	<div>
		<div class="wpcm-order-detailbox" v-loading="loading">
            <h4 class="wpcm-order-detail-header">{{ $webinane_i18n.billing }}</h4>
            <div class="wpcm-order-detail-content">
                <form class="wpcm-order-form" action="">
                    <div class="wpcm-billing-btns">
                        <a href="#" class="wpcm-primary-colr" @click.prevent="loadBilling">
                            <i class="fa fa-upload" v-if="! loading"></i>
                            <i class="fa fa-refresh fa-spin" v-if="loading"></i>
                            {{ $webinane_i18n.load_billing_add }}
                        </a>
                    </div>
                    <div class="wpcm-billing-info">
                        <div class="wpcm-biling-group">
                            <label>{{ $webinane_i18n.name }}:</label>
                            <span v-if="isEditing('name') == false">{{$root.customer_data.name}}</span>
                            <input v-if="isEditing('name')" type="text" class="wpcm-form-input" v-model="$root.customer_data.name" >
                            <a v-if="isEditing('name')" href="#" @click.prevent="saveField('name', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('name') == false" href="#" title="" @click.prevent="editField('name')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                        <div class="wpcm-biling-group" v-if="$root.customer_data.meta_data">
                            <label>{{ $webinane_i18n.company }}:</label>
                            <span v-if="isEditing('billing_company') == false">{{$root.customer_data.meta_data.billing_company}}</span>
                            <input v-if="isEditing('billing_company')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.billing_company" >
                            <a v-if="isEditing('billing_company')" href="#" @click.prevent="saveField('billing_company', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('billing_company') == false" href="#" title="" @click.prevent="editField('billing_company')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                        <div class="wpcm-biling-group">
                            <label>{{ $webinane_i18n.email_id }}:</label>
                            <span v-if="isEditing('email') == false">{{$root.customer_data.email}}</span>
                            <input v-if="isEditing('email')" type="text" class="wpcm-form-input" v-model="$root.customer_data.email" >
                            <a v-if="isEditing('email')" href="#" @click.prevent="saveField('email', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('email') == false" href="#" title="" @click.prevent="editField('email')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                        <div class="wpcm-biling-group" v-if="$root.customer_data.meta_data">
                            <label>{{ $webinane_i18n.phone }}:</label>
                            <span v-if="isEditing('billing_phone_no') == false">{{$root.customer_data.meta_data.billing_phone_no}}</span>
                            <input v-if="isEditing('billing_phone_no')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.billing_phone_no" >
                            <a v-if="isEditing('billing_phone_no')" href="#" @click.prevent="saveField('billing_phone_no', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('billing_phone_no') == false" href="#" title="" @click.prevent="editField('billing_phone_no')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                        <div class="wpcm-biling-group" v-if="$root.customer_data.meta_data">
                            <label>{{ $webinane_i18n.address }}:</label>
                            <span v-if="isEditing('address') == false">
                            	{{$root.customer_data.meta_data.billing_address_line_1}}<br/> 
                            	{{$root.customer_data.meta_data.billing_city}}<br/> 
                            	{{$root.customer_data.meta_data.billing_zip }} <br/>
                            	<template v-if="$root.customer_data.meta_data.billing_state">
	                            	{{$root.customer_data.meta_data.billing_state}} <br/>
	                            </template>
                            	{{$root.customer_data.meta_data.billing_base_country}}
                            </span>
                            <input v-if="isEditing('billing_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.billing_address_line_1" >
                            <label v-if="isEditing('billing_address')">{{ $webinane_i18n.address_2 }}:</label>
                            <input v-if="isEditing('billing_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.billing_address_line_2" >
                            <label v-if="isEditing('billing_address')">{{ $webinane_i18n.zip }}:</label>
                            <input v-if="isEditing('billing_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.billing_zip" >
                            <label v-if="isEditing('billing_address')">{{ $webinane_i18n.city }}:</label>
                            <input v-if="isEditing('billing_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.billing_city" >
                            <label v-if="isEditing('billing_address')">{{ $webinane_i18n.country }}:</label>
                            <input v-if="isEditing('billing_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.billing_base_country" >
                            <label v-if="isEditing('billing_address')">{{ $webinane_i18n.state }}:</label>
                            <input v-if="isEditing('billing_address')" type="text" class="wpcm-form-input" v-model="$root.customer_data.meta_data.billing_state" >
                            <a v-if="isEditing('billing_address')" href="#" @click.prevent="saveField('billing_address', $event)" title="" class="wpcm-primary-bgcolr"><i class="fa fa-check"></i></a>
                            <a v-if="isEditing('billing_address') == false" href="#" title="" @click.prevent="editField('billing_address')"><i class="fa fa-pencil-alt"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</template>
<script>
export default {
    name: 'billing-address',
    data() {
        return {
            loading: false,
        	fields: {
        		name: 'Saludin Bhuiyan',
        	},
        	editing: false,
        	editing_field: ''
        }
    },
    mounted() {

        jQuery(document).on('keyup', (evt) => {
            if (evt.keyCode == 27) {
               this.editing = false
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

    		jQuery(target).addClass('fa-circle-notch fa-spin').removeClass('fa-check');
            this.loading = true

    		jQuery.ajax({
    			url: ajaxurl,
    			type: 'post',
    			data: {action: '_admin_orders_fields', customer: thisis.$root.customer_data, customer_id: thisis.$root.customer},
    			success: (res) => {
		    		
                    this.loading = false
                    this.$notify.success({
                        title: this.$webinane_i18n.success,
                        message: res.message,
                        offset: 30
                    });

		    		this.editing = false
		    		this.editing_field = ''

    			},
    			error: (res) => {

                    this.loading = false
                    thisis.$notify.error({
                        title: this.$webinane_i18n.error,
                        message: res.statusText,
                        offset: 30
                    });

		    		this.editing = false
		    		this.editing_field = ''
    			}
    		})
    	}, 
    	loadBilling() {
    		let thisis = this
            let post_id = jQuery('#post_ID').val()
            let $ = jQuery

            if( this.$root.customer == '' ) {
                alert(this.$webinane_i18n.please_choose_customer_to_load_data);
                return;
            }

            this.loading = true

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action: '_wpcommerce_admin_orders_customer_data', subaction: 'load_billing', customer: thisis.$root.customer_data, customer_id: thisis.$root.customer, post_id: post_id},
                success: (res) => {
                    this.$root.customer_data = res.customer
                },
                complete: (res) => {
                    this.loading = false
                }
            })
    	}
    }
}
</script>
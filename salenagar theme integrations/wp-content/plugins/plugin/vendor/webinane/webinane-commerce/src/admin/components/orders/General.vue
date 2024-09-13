<template>
    <div>
        <div class="wpcm-row" v-loading="loading">
            <div class="wpcm-col-lg-6 wpcm-col-md-12">
                <div class="wpcm-order-detailbox">
                    <h4 class="wpcm-order-detail-header">{{ $webinane_i18n.general }}</h4>
                    <div class="wpcm-order-detail-content wpcm-order-general-box">

                            <div class="wpcm-form-group">
                                <label>{{ $webinane_i18n.date_created }}</label>
                                <div class="wpcm-datetime-view">
                                    <el-date-picker
                                      v-model="$root.order.post_date"
                                      type="date"
                                      placeholder="$webinane_i18n.pick_date"
                                      size="large">
                                    </el-date-picker>
                                </div>
                            </div>
                            <div class="wpcm-form-group">
                                <label>{{ $webinane_i18n.status }}</label>
                                <div class="el-custom-select wpcm-custom-select2">
                                    <el-select v-model="$root.order.post_status" placeholder="$webinane_i18n.order_status" size="large">
                                        <el-option v-if="post_statuses" v-for="(label, key) in post_statuses" :key="key" :label="label.label" :value="label.code"></el-option>
                                    </el-select>
                                </div>
                            </div>
                            <div class="wpcm-form-group">
                                <label>{{ $webinane_i18n.customer }}</label>
                                <div class="el-custom-select wpcm-custom-select2">
                                    <el-select v-model="$root.customer" :placeholder="$webinane_i18n.customer" size="large" @change="updateCustomerData()">
                                        <el-option v-if="$root.customers" v-for="(cust) in $root.customers" :key="cust.value" :label="cust.label" :value="cust.value"></el-option>
                                    </el-select>
                                    <a href="#" @click.prevent="dialogFormVisible = true">{{$webinane_i18n.add_new}}</a>
                                    <span v-if="customer"> | </span>
                                    <a href="#" v-if="customer" @click.prevent="deleteCustomer()"><i class="dashicons dashicons-trash"></i></a> 
                                </div>

                            </div>
                    </div>
                </div>
            </div>
            <div class="wpcm-col-lg-6 wpcm-col-md-12">
                <div class="wpcm-order-detailbox">
                    <h4 class="wpcm-order-detail-header">{{ title }}</h4>
                    <div class="wpcm-order-detail-content">
                        
                            <div class="wpcm-custom-select">
                                <select class="wpcm-form-input" v-model="order_action">
                                    <option value="">{{ $webinane_i18n.choose_an_action}}</option> 
                                    <option value="email_invoice">{{ $webinane_i18n.send_inv_via_email }}</option> 
                                    <option value="notification">{{ $webinane_i18n.email_new_order_notif }}</option> 
                                </select>
                            </div>
                            <div class="wpcm-action-btns">
                                <a class="wpcm-secondary-colr wpcm-del-btn" href="#" title="" @click.prevent="removeOrder">
                                    <i class="fa fa-trash-alt"></i>
                                </a>
                                <a class="wpcm-btn" href="#" @click.prevent="updateGeneral($event)" title="">{{ $webinane_i18n.update }}</a>
                            </div>
                            <div v-if="$root.order.meta" class="wpcm-order-general-box">
                                <div class="wpcm-form-group" v-for="meta_inf in $root.order.meta">
                                    <label>{{ meta_inf.label }}:</label>
                                    <div class="wpcm-datetime-view" v-html="meta_inf.value"></div>
                                </div>
                                <div v-html="hooked_vars"></div>
                            </div>
                    </div>
                </div>
            </div>

        </div>
        <el-dialog :title="$webinane_i18n.add_new" :visible.sync="dialogFormVisible">
            <el-form :model="form" v-loading="dialogLoading">
                <el-form-item :label="$webinane_i18n.name" :label-width="formLabelWidth">
                    <el-input v-model="form.name" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item :label="$webinane_i18n.email" :label-width="formLabelWidth">
                    <el-input v-model="form.email" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item :label="$webinane_i18n.users" :label-width="formLabelWidth">
                    <el-select 
                        v-model="form.user_id" 
                        :placeholder="$webinane_i18n.users_search_keyword" 
                        filterable
                        remote
                        reserve-keyword
                        :remote-method="getUsers"
                        :loading="loading"
                        size="large">
                        <el-option v-if="users" v-for="(label, key) in users" :key="label.ID" :label="label.data.display_name" :value="label.ID"></el-option>
                    </el-select>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false" round>{{$webinane_i18n.cancel}}</el-button>
                <el-button type="primary" @click="addNewCustomer()" round>{{$webinane_i18n.add_new}}</el-button>
            </span>
        </el-dialog>
    </div>
</template>
<script>

export default {
    name: 'general',
    components: {},
    props: ['title'],
    data() {
        return {
            loading: false,
            dialogLoading: false,
            formLabelWidth: '120px',
            hooked_vars: '',
            fields: {
                name: 'Saludin Bhuiyan',
            },
            editing: false,
            editing_field: '',
            customer: {},
            order_action: '',
            dialogFormVisible: false,
            users: [],
            form: {
                name: '',
                email: '',
            },
            post_statuses: [
                { code: 'processing', label: this.$webinane_i18n.processing },
                { code: 'pending_payment', label: this.$webinane_i18n.pending_payment },
                { code: 'hold', label: this.$webinane_i18n.hold },
                { code: 'completed', label: this.$webinane_i18n.completed },
                { code: 'cancelled', label: this.$webinane_i18n.cancelled },
                { code: 'refunded', label: this.$webinane_i18n.refunded },
                { code: 'failed', label: this.$webinane_i18n.failed },
            ]
        }
    },
    mounted() {
        let thisis = this;
        setTimeout(function(){
            jQuery('#wpcm-datepicker').datetimepicker({
                sideBySide: true
            });
        }, 1000);
    },
    methods: {
        /*setValue(obj, key, value) {
            obj[key] = value
        },*/
        updateGeneral(event) {

            let target = event.target
            let thisis = this

            //jQuery(target).append('<i class="fa fa-circle-notch fa-spin"></i>')

            this.loading = true
 
            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action:'_wpcommerce_admin_order_update_general', customer:thisis.$root.customer, order:thisis.$root.order, order_action: thisis.order_action},
                success: (res) => {
                    this.loading = false
                    //jQuery(target).find('.fa').remove()
                    
                    this.$notify.success({
                      title: this.$webinane_i18n.success,
                      message: res.message,
                      offset: 30
                    });
                },
                error: function(res) {
                    this.loading = false
                    //jQuery(target).find('.fa').remove()

                    thisis.$notify.error({
                      title: this.$webinane_i18n.error,
                      message: res.statusText,
                      offset: 30
                    });
                }
            })
        },
        removeOrder() {
            this.$confirm(this.$webinane_i18n.sure_want_del_order, 'Warning', {
                confirmButtonText: this.$webinane_i18n.ok,
                cancelButtonText: this.$webinane_i18n.cancel,
                type: 'warning'
            }).then(() => {
                let thisis = this
                let $ = jQuery
                let post_id = jQuery('#post_ID').val()

                this.loading = true

                $.ajax({
                    url: ajaxurl,
                    type: 'post',
                    data: {action: '_wpcommerce_admin_order_delete', post_id: post_id},
                    success: (res) => {
                        this.loading = false
                        if( res.success === true ) {
                            this.$notify.success({
                              title: this.$webinane_i18n.success,
                              message: this.$webinane_i18n.order_del_success_ful,
                              offset: 30
                            });
                            setTimeout(function(){
                                location.href = res.data.url;
                            }, 2000);
                        } else {
                            this.$notify.error({
                              title: this.$webinane_i18n.error,
                              message: res.data,
                              offset: 30
                            });
                        }
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
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: this.$webinane_i18n.delete_canceled
                });          
            });
        },
        selected(value) {
            if( value && value.code !== undefined ) {
                this.$root.order.post_status = value.code
            } else {
                this.$root.order.post_status = {}
            }
        },
        select2Vale(value) {
            return _.find(this.post_statuses, function(status){
                return (status.code == value)
            })
        },
        getGateway(gateway) {
            let found = _.find(this.$root.gateways, function(gtw, name){
                return name == gateway
            })

            if( found ) {
                return found.name
            }

            return gateway
        },
        addNewCustomer() {
            let thisis = this
            let $ = jQuery
            let post_id = jQuery('#post_ID').val()

            this.loading = true
            this.dialogLoading = true

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action: '_wpcommerce_admin_add_new_customer', form: this.form},
                success: (res) => {
                    this.loading = false
                    this.dialogLoading = false
                    if( res.success === true ) {
                        this.$notify.success({
                          title: this.$webinane_i18n.success,
                          message: res.data.message,
                          offset: 30
                        });
                        this.$parent.customers = res.data.customers
                        this.dialogFormVisible = false
                    } else {
                        this.$notify.error({
                          title: this.$webinane_i18n.error,
                          message: (res.data) ? res.data.message: this.$webinane_i18n.failed,
                          offset: 30
                        });
                    }
                },
                complete: (res) => {
                    if(res.status !== 200 ) {
                        this.loading = false
                        this.dialogLoading = false
                        this.$notify.error({
                          title: this.$webinane_i18n.error,
                          message: res.statusText,
                          offset: 30
                        });
                    }
                }
            })
        },
        getUsers(query) {
            let thisis = this
            let $ = jQuery
            let post_id = jQuery('#post_ID').val()

            this.loading = true

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action: '_wpcommerce_admin_get_users', query: query},
                success: (res) => {
                    this.loading = false
                    if( res.success === true ) {
                        this.users = res.data.users
                    } else {
                    }
                },
                complete: (res) => {
                    if(res.status !== 200 ) {
                        this.loading = false
                        this.$notify.error({
                          title: this.$webinane_i18n.error,
                          message: res.statusText,
                          offset: 30
                        });
                    }
                }
            })
        },
        deleteCustomer() {
            this.$confirm(this.$webinane_i18n.sure_remove_customer, 'Warning', {
                confirmButtonText: this.$webinane_i18n.ok,
                cancelButtonText: this.$webinane_i18n.cancel,
                type: 'warning'
            }).then(() => {
                this.loading = true
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'post',
                    data: {action: '_wpcommerce_admin_customer_remove', customer: this.$root.customer},
                    success: (res) => {
                        this.$notify({
                            type: (res.success) ? 'success' : 'error',
                            title: (res.success) ? this.$webinane_i18n.success : this.$webinane_i18n.error,
                            message: res.data.message,
                            offset: 30
                        });
                        if(res.success && res.data.customers) {
                            this.$root.customers = res.data.customers
                            this.$root.customer = this.$root.customers[0].id
                        }
                        this.loading = false

                    },
                    error: (res) => {
                        this.$notify.error({
                          title: this.$webinane_i18n.error,
                          message: res.statusText,
                          offset: 30
                        });
                        this.loading = false
                    }
                })
            }).catch((e) => {

                this.$message({
                    type: 'info',
                    message: this.$webinane_i18n.delete_canceled
                });          
            });
        },
        updateCustomerData() {
            this.loading = true
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'post',
                    data: {action: '_wpcommerce_admin_customer_update_data', customer: this.$root.customer},
                    success: (res) => {
                        if(res.success && res.data.customer) {
                            this.$root.customer_data = res.data.customer
                        }
                        this.loading = false
                    }
                })
        }
    }
}
</script>
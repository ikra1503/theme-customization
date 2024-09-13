<template>
  <div class="mt-4 wpcm-container" v-loading="loading">

    <div class="mt-3 text-right">
      <div class="w-50 d-inline-block">
        <el-input placeholder="Please type to search" v-model="query" class="input-with-select">
          <el-button slot="append" icon="el-icon-search" @click="getData()"></el-button>
        </el-input>
      </div>
    </div>
    <el-table :data="tableData" style="width: 100%; margin-top: 30px">
      <el-table-column type="selection" width="55"></el-table-column>
      <el-table-column fixed :label="$wpcm_i18n.date" width="150">
        <template slot-scope="scope">{{ moment(scope.row.created_at).format('MMMM Do YYYY') }}</template>
      </el-table-column>
      <el-table-column prop="name" :label="$wpcm_i18n.name"></el-table-column>
      <el-table-column prop="email" :label="$wpcm_i18n.email"></el-table-column>
      <el-table-column :label="$wpcm_i18n.user">
        <template slot-scope="scope">
          <a
            :href="'user-edit.php?user_id='+scope.row.user_id"
            v-if="scope.row.user"
            target="_target"
          >{{ scope.row.user.display_name }}</a>
          <span v-else>NULL</span>
        </template>
      </el-table-column>
      <el-table-column fixed="right" :label="$wpcm_i18n.operations" width="120">
        <template slot-scope="scope">
          <el-button-group>
            <el-button @click="showPopup(scope.row)" type="success" size="mini">
              <i class="el-icon-edit"></i>
            </el-button>
            <el-button @click="remove(scope.row.id)" type="danger" size="mini">
              <i class="el-icon-close"></i>
            </el-button>
          </el-button-group>
        </template>
      </el-table-column>
    </el-table>

    <div class="mt-4 text-right">
      <el-pagination
        layout="prev, pager, next"
        current-change="pageChange"
        :page-size="per_page"
        :total="total">
      </el-pagination>
    </div>

    <el-dialog :title="$wpcm_i18n.edit_user" :visible.sync="dialogFormVisible" width="65%">
      <Edit
        ref="edit_user"
        v-if="dialogFormVisible"
        @onClose="dialogFormVisible = false"
        :user="current_user"
        :users="users"
      ></Edit>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false">{{ $wpcm_i18n.cancel }}</el-button>
        <el-button type="primary" @click="updateUser()">{{ $wpcm_i18n.confirm }}</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import Edit from "./customers/Edit.vue";
export default {
  components: {
    Edit
  },
  data() {
    return {
      tableData: [],
      query: '',
      loading: false,
      dialogFormVisible: false,
      current_user: {},
      total: 0,
      page: 1,
      per_page: 10,
      users: []
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      let $ = jQuery;
      this.loading = true;
      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          action: "webinane_commerce_customers_data",
          nonce: wpcm_data.nonce,
          page: this.page,
          query: this.query
        },
        success: res => {
          this.tableData = res.data.data;
          this.total = res.data.total
          this.per_page = res.data.per_page
          this.users = res.data.users
        },
        complete: res => {
          this.loading = false;
        }
      });
    },
    handleClick() {
      console.log("click");
    },
    moment(date) {
      return moment(date);
    },

    showPopup(user) {
      this.current_user = user;
      this.dialogFormVisible = true;
    },
    updateUser() {
      this.$refs.edit_user.update();
    },
    remove(id) {
      this.$confirm(this.$wpcm_i18n.alert_remove_record, this.$wpcm_i18n.warning, {
        confirmButtonText: this.$wpcm_i18n.ok,
        cancelButtonText: this.$wpcm_i18n.cancel,
        type: "warning"
      })
        .then(() => {
          let $ = jQuery;
          this.loading = true;
          $.ajax({
            url: ajaxurl,
            type: "post",
            data: {
              action: "webinane_commerce_customers_remove",
              id: id,
              nonce: wpcm_data.nonce
            },
            success: res => {
              if (res.success) {
                this.$notify({
                  type: "success",
                  title: this.$wpcm_i18n.success,
                  message: res.data.message,
                  offset: 40
                });
                this.getData();
              } else {
                this.$notify({
                  type: "error",
                  title: this.$wpcm_i18n.error,
                  message: res.data.message,
                  offset: 40
                });
              }
            },
            complete: res => {
              this.loading = false;
            }
          });
        })
        .catch(() => {});
    },
    pageChange(page) {
      this.page = page
      this.getData()
    }
  }
};
</script>
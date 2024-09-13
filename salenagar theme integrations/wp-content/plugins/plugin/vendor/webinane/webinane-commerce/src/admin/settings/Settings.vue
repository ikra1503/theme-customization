<template>
  <div :style="{ position: 'relative' }">
    <div class="settings-tab-area" v-loading="loading">
      <el-tabs type="border-card" class="main-tabs-list" v-if="tabs && values">
        <el-tab-pane v-for="tab in tabs" :key="tab.id" :id="tab.id">
          <span slot="label"
            ><i v-if="tab.icon" :class="tab.icon"></i> {{ tab.title }}</span
          >
          <el-tabs
            type="border-card"
            class="child-tabs-list"
            v-if="tab.children"
            :id="tab.id"
          >
            <el-tab-pane
              :label="c_tab.title"
              v-for="c_tab in tab.children"
              :id="c_tab.id"
              :key="c_tab.id"
            >
              <h2 class="tab-heading" v-if="c_tab.heading">
                {{ c_tab.heading }}
              </h2>
              <wpcm-fields
                :fields="c_tab.fields"
                :values="values"
                @input="setValues"
              />
            </el-tab-pane>
          </el-tabs>
          <div class="settings-tab-content" v-else>
            <h2 class="tab-heading" v-if="tab.heading">{{ tab.heading }}</h2>
            <wpcm-fields
              :fields="tab.fields"
              :values="values"
              @input="setValues"
            ></wpcm-fields>
          </div>
        </el-tab-pane>
      </el-tabs>
      <div class="import-export-btns">
        <el-tooltip class="item" content="Export Settings" placement="top">
          <el-button
            @click="exportSettings()"
            icon="el-icon-upload2"
          ></el-button>
        </el-tooltip>
        <el-tooltip class="item" content="Import Settings" placement="top">
          <el-button
            icon="el-icon-download"
            @click="dialogVisible = true"
          ></el-button>
        </el-tooltip>
        <el-dialog
          title="IMPORT SETTINGS"
          :visible.sync="dialogVisible"
          width="30%"
          :before-close="handleClose"
          class="import-modal"
        >
          <div class="import-opt">
            <el-radio-group v-model="import_radio">
              <el-radio :label="3">From File</el-radio>
              <el-radio :label="6">From URL</el-radio>
              <el-radio :label="9">Paste Content</el-radio>
            </el-radio-group>
          </div>
          <div v-if="import_radio === 3" class="chose-import-file">
            <span>Choose the import file</span>
            <el-upload
              class="upload-demo"
              ref="upload"
              accept="application/json"
              action="https://jsonplaceholder.typicode.com/posts/"
              :auto-upload="false"
            >
              <div class="el-upload__tip" slot="tip">
                Please Select a .json file.
              </div>
              <el-button slot="trigger" size="small" type="primary"
                >Choose file</el-button
              >
            </el-upload>
          </div>
          <div v-else-if="import_radio === 6" class="url-import">
            <el-input
              placeholder="Please URL"
              v-model="import_input"
            ></el-input>
          </div>
          <div v-else class="paste-content-import">
            <el-input
              placehoder="Please paste content here"
              type="textarea"
              rows="5"
              v-model="import_input"
            ></el-input>
          </div>
          <span slot="footer" class="dialog-footer">
            <el-button @click="dialogVisible = false">Cancel</el-button>
            <el-button type="primary" @click="importSettings()"
              >Import</el-button
            >
          </span>
        </el-dialog>
      </div>
    </div>
    <div class="save-settings">
      <el-button type="primary" @click="saveChange()">SAVE CHANGES</el-button>
    </div>
  </div>
</template>

<script>
const { mapState } = window.Vuex;
import Editor from "../../components/fields/Editor.vue";
import Fields from "../../components/fields/Fields.vue";
export default {
  components: {
    Editor,
    Fields,
  },
  data() {
    return {
      tabs: [],
      // values: {},
      form: {},
      dialogVisible: false,
      import_radio: 3,
      import_input: "",
      // loading: false,
      dialog_loading: false,
    };
  },
  computed: {
    ...mapState(['loading', 'values'])
  },
  mounted() {
    this.getData();
  },
  methods: {
    handleClose(done) {
      this.$confirm("Are you sure to close this dialog?")
        .then((_) => {
          done();
        })
        .catch((_) => {});
    },
    getData() {
      this.$store.dispatch('getData')
      .then(res => {
        if (res.options.gateways === undefined) {
          res.options.gateways = {};
        }
        if(_.isArray(res.options.gateways)) {
          res.options.gateways = {}
        }
        this.tabs = res.data;

        // add missing keys for dependency field
        if ( res.options.menu_donation_button == undefined ) {
          res.options['menu_donation_button'] = true;
        }
        if ( res.options.donation_general_type == undefined ) {
          res.options['donation_general_type'] = 'donation_popup_box';
        }
        if ( res.options.donation_Cpost_type == undefined ) {
          res.options['donation_Cpost_type'] = 'donation_popup_box';
        }
        // this.values = res.options;
        this.$store.commit('setValues', res.options)
      })
      .catch(error => {
        this.$notify.error({title: 'Error', message: error, offset: 40})
      })
    },
    setValues(id, value) {
      this.form[id] = value
    },
    saveChange() {
      this.$store.dispatch('saveChanges')
      .then(res => {
        this.$notify.success({
          title: "Success",
          message: res.message,
          offset: 33,
        });
      })
      .catch(error => {
        this.$notify.error({
          title: "error",
          message: res.responseText,
          offset: 40,
        });
      })
    },
    exportSettings() {
      this.loading = true;
      // this.loading_name = 'export'
      let $ = jQuery;

      $.ajax({
        url: ajaxurl,
        type: "post",
        //content_type: "application/json",
        data: {
          action: "_wpcommerce_admin_settings",
          subaction: "export_settings",
          nonce: wpApiSettings.nonce,
        },
        success: (response, status, xhr) => {
          this.loading = false;

          // check for a filename
          var filename = "";
          var disposition = xhr.getResponseHeader("Content-Disposition");
          if (disposition && disposition.indexOf("attachment") !== -1) {
            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
            var matches = filenameRegex.exec(disposition);
            if (matches != null && matches[1])
              filename = matches[1].replace(/['"]/g, "");
          }

          var type = xhr.getResponseHeader("Content-Type");
          var blob = new Blob([response], { type: type });

          if (typeof window.navigator.msSaveBlob !== "undefined") {
            // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
            window.navigator.msSaveBlob(blob, filename);
          } else {
            var URL = window.URL || window.webkitURL;
            var downloadUrl = URL.createObjectURL(blob);

            if (filename) {
              // use HTML5 a[download] attribute to specify filename
              var a = document.createElement("a");
              // safari doesn't support this yet
              if (typeof a.download === "undefined") {
                window.location = downloadUrl;
              } else {
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
              }
            } else {
              window.location = downloadUrl;
            }

            setTimeout(function () {
              URL.revokeObjectURL(downloadUrl);
            }, 100); // cleanup
          }
        },
        error: (res) => {
          this.loading = false;
          this.$notify.error({
            title: "Error",
            message: res.statusText,
            offset: 30,
          });
        },
      });
    },
    importSettings() {
      let $ = jQuery;

      this.$confirm(
        "This will permanently overwite all settings. Continue?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning",
        }
      )
        .then(() => {
          this.loading = true;
          this.dialog_loading = true;

          if (this.import_radio === 3) {
            this.import_input = this.$refs.upload.uploadFiles[0].raw;
          }
          if (this.import_radio === 9) {
            try {
              this.import_input = JSON.parse(this.import_input);
            } catch (e) {
              this.$notify.error({
                title: "Error",
                message: "Invalid input data",
              });
            }
          }

          var formData = new FormData();

          // add assoc key values, this will be posts values
          formData.append("file", this.import_input);
          formData.append("input_type", this.import_radio);
          formData.append("action", "_wpcommerce_admin_settings");
          formData.append("subaction", "import_settings");
          formData.append("nonce", wpApiSettings.nonce);

          $.ajax({
            url: ajaxurl,
            type: "post",
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: (response, status, xhr) => {
              this.loading = false;
              let type = response.success == false ? "error" : "success";
              this.$notify({
                type: type,
                title: type,
                message: response.data,
                offset: 30,
              });
              if (response.success) {
                window.location = window.location; // Reload the page so new imported data should be reflected.
              }
            },
            error: (response) => {
              this.$notify.error({
                title: "Error",
                message: response.statusText,
                offset: 30,
              });
            },
            complete: (res) => {
              this.loading = false;
              this.dialog_loading = false;
            },
          });
        })
        .catch(() => {
          this.loading = false;
          this.dialog_loading = false;
          this.$message({
            type: "info",
            message: "canceled",
          });
        });
    },
  },
};
</script>
<style lang="scss">
.wpcm-dashboard-wrapper {
  .el-radio {
    margin-right: 10px;
  }
  .el-switch {
    position: relative;
    margin-bottom: 10px;
    .el-switch__core {
      height: 40px;
      width: 95px !important;
      box-shadow: 0 0 24px rgba(0, 0, 0, 0.08);
      border-radius: 60px;
      &::after {
        height: 36px;
        width: 36px;
        box-shadow: 3px 4px 15px 0px rgba(0, 0, 0, 0.25);
      }
    }
    &.is-checked {
      .el-switch__core {
        background-color: #2f88e4;
        background-image: linear-gradient(#2f88e4, #2874df);
        border-color: #2f88e4;
        &::after {
          margin-left: -37px;
        }
      }
    }
    .el-switch__label {
      font-size: 13px;
      color: #fff;
      position: absolute;
      left: 50%;
      margin-right: 0;
      z-index: 1;
      &.el-switch__label--left {
        margin-left: -4px;
        opacity: 0;
        visibility: hidden;
        &.is-active {
          opacity: 1;
          visibility: visible;
        }
      }
      &.el-switch__label--right {
        margin-left: -25px;
        opacity: 0;
        visibility: hidden;
        &.is-active {
          opacity: 1;
          visibility: visible;
        }
      }
    }
  }
  box-shadow: 0 0 57px rgba(0, 0, 0, 0.09);
  .tab-heading {
    font-size: 40px;
    color: #000000;
    font-weight: 700;
    position: relative;
    padding-bottom: 8px;
    margin-bottom: 20px;
    &:before {
      content: "";
      height: 2px;
      width: 40px;
      background-color: #2b7de1;
      position: absolute;
      left: 0;
      bottom: 0;
    }
  }
  .save-settings {
    text-align: center;
    background-color: #fbfbfb;
    padding: 25px;
    position: sticky;
    width: 100%;
    left: 0;
    bottom: 0;
    z-index: 30;

    .el-button {
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      padding: 20px 40px;
      border-radius: 2px;
      background-color: #2f88e4;
      background-image: linear-gradient(#2f88e4, #2874df);
    }
  }
  .enable-settings {
    padding-bottom: 30px;
    margin-bottom: 25px;
    border-bottom: 1px solid #ececec;
    margin-top: 30px;
    .enable-label {
      font-size: 16px;
      color: #666666;
      margin-right: 70px;
    }
    .enable-desc {
      font-size: 14px;
      color: #999999;
      font-style: italic;
      margin-left: 15px;
    }
  }
  .settings-tab-area {
    position: relative;
    .import-export-btns {
      position: absolute;
      right: 22px;
      top: 36px;
      > .el-button {
        background-color: #354052;
        color: #fff;
        font-size: 20px;
        border: none;
        padding: 10px 12px;
        &:hover {
          background-color: #4385f5;
        }
        & + .el-button {
          margin-left: 5px;
        }
      }
    }
  }
  .el-form {
    .el-form-item {
      margin-bottom: 3rem;
      .el-form-item__label {
        color: #666666;
        font-weight: 500;
        line-height: normal;
        margin-bottom: 0;
        line-height: 30px;
      }
      .el-input {
        input {
          height: 58px;
          border-radius: 2px;
          border: 2px solid #e1e2e6;
          color: #999999;
          font-size: 14px;
          padding: 12px 15px;
          background-color: #fff;
        }
      }
      .el-date-editor {
        input {
          padding-left: 30px;
          padding-right: 30px;
        }
      }
      .el-form-item__content {
        line-height: normal;
        .el-button.el-popover__reference {
          background-color: #c0c0c0;
          border: none;
          color: #fff;
          padding: 0;
          border-radius: 50%;
          height: 18px;
          width: 18px;
          line-height: 18px;
        }
        .el-select {
          width: 100%;
          .el-input__suffix {
            background-color: #f8f8f8;
            height: 34px;
            display: block;
            width: 32px;
            border-radius: 5px;
            right: 15px;
            border: 1px solid #ebebeb;
            top: 50%;
            margin-top: -17px;
            .el-select__caret {
              color: #6a6a6a;
              line-height: 30px;
            }
          }
        }
        .wpcm-option-row {
          padding: 0;
          border: none;
        }
      }
      .el-slider {
        .el-slider__runway {
          margin: 32px 0 16px;
        }
      }
    }
  }
  .main-tabs-list {
    box-shadow: none;
    border: none;
    > .el-tabs__header {
      .el-tabs__nav-wrap {
        background-color: #011025;
      }
      .el-tabs__item {
        height: auto;
        border: none;
        border-right: 1px solid #2b3648;
        padding: 28px 34px !important;
        text-align: center;
        line-height: normal;
        &.is-active {
          color: #fff;
          background-color: #4385f5;
          border-color: #4385f5;
          i {
            color: #fff;
          }
        }
        span {
          font-size: 14px;
          color: #fff;
          i {
            display: block;
            color: #8494ad;
            font-size: 30px;
            margin-bottom: 10px;
          }
        }
      }
    }
    .el-tabs__content {
      padding: 0;
      .el-tabs--border-card {
        border: none;
      }
      .el-tabs__content {
        padding: 60px 22%;
      }
      .settings-tab-content {
        padding: 60px 22%;
        .el-tabs__content {
          padding: 0;
        }
        .el-tabs__nav-wrap::after {
          display: none;
        }
        .el-tabs__nav {
          .el-checkbox {
            color: #333;
            font-weight: normal;
            .el-checkbox__label {
              font-size: 15px;
            }
            .el-checkbox__input {
              .el-checkbox__inner {
                border: 1px solid #d8d8d8;
                background-color: #f9f9f9;
                height: 20px;
                width: 20px;
                &::after {
                  height: 10px;
                  width: 6px;
                  left: 6px;
                  top: 2px;
                  border: 2px solid #fff;
                  border-left: 0;
                  border-top: 0;
                }
              }
              &.is-checked {
                .el-checkbox__inner {
                  background-color: #409eff;
                  border-color: #409eff;
                }
              }
            }
          }
          .el-tabs__active-bar {
            display: none;
          }
        }
        div {
          .tab-heading {
            font-size: 28px;
          }
        }
        .el-tabs__content {
          padding: 50px 0 0 !important;
        }
      }
    }
  }
  .child-tabs-list {
    > .el-tabs__header {
      .el-tabs__nav-wrap {
        background-color: #f4f4f4;
      }
      .el-tabs__item {
        height: auto;
        border: none;
        padding: 14px 34px !important;
        text-align: center;
        font-size: 14px;
        color: #000;
        position: relative;
        & + .el-tabs__item {
          &:after {
            content: "";
            width: 1px;
            height: 13px;
            background-color: #bfbfbf;
            position: absolute;
            left: 0;
            top: 50%;
            margin-top: -6px;
          }
        }
        &:hover {
          color: #2b7de1 !important;
        }
        &.is-active {
          background-color: #f4f4f4;
          color: #2b7de1;
        }
      }
    }
  }
  .import-modal {
    .el-dialog__header {
      background-color: #eaf1f6;
      padding: 24px 35px;
      span {
        font-size: 22px;
        font-weight: 700;
        color: #000;
      }
      .el-dialog__headerbtn {
        height: 34px;
        width: 34px;
        line-height: 38px;
        border-radius: 50%;
        background-color: #fff;
        text-align: center;
        .el-dialog__close {
          color: #000;
          font-size: 20px;
        }
      }
    }
    .el-dialog__body {
      padding: 30px 35px;
    }
    .import-opt {
      margin-bottom: 30px;
    }
    .chose-import-file {
      > span {
        font-size: 14px;
        color: #000;
        display: block;
        padding-bottom: 22px;
      }
      .upload-demo {
        .el-button {
          border-radius: 4px;
          border: 1px solid #d8d8d8;
          box-shadow: 0 0 5px rgba(0, 0, 0, 0.11);
          background-color: #fafafa;
          font-size: 13px;
          font-weight: 500;
          color: #000;
          padding: 14px 24px;
        }
        .el-upload__tip {
          font-size: 13px;
          color: #999999;
          margin-top: 12px;
        }
      }
    }
    .el-input {
      input {
        height: 58px;
        border-radius: 2px;
        border: 2px solid #e1e2e6;
        color: #999999;
        font-size: 14px;
        padding: 12px 15px;
        background-color: #fff;
      }
    }
  }
}
.el-tooltip__popper.is-dark {
  border-radius: 30px;
  background-color: #ffffff;
  font-size: 12px;
  color: #000000;
  padding: 4px 15px;
  .popper__arrow {
    border-top-color: #ffffff;
    &:after {
      border-top-color: #ffffff;
    }
  }
}
#payment_settings .el-tabs__content #pane-1 {
  margin: 0 -26%;
}
</style>

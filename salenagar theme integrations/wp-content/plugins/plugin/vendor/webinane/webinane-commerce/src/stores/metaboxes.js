const Vuex = window.Vuex;
const $ = jQuery

const state = {
  loading: false,
  values: {},
  // fields: []
}

const actions = {
  getData({ state }) {
    return new Promise((resolve, reject) => {
      state.loading = true,
        $.ajax({
          url: ajaxurl,
          type: "post",
          dataType: "json",
          //contentType: 'application/json',
          data: {
            action: "_wpcommerce_admin_settings",
            subaction: "fields_data",
            nonce: wpApiSettings.nonce,
          },
          success: (res) => {
            resolve(res)
          },
          complete: (res) => {
            state.loading = false;
            if (res.status !== 200) {
              reject(res)
            }
          },
        });
    })
  },
  saveChanges({ state }) {
    return new Promise((resolve, reject) => {
      state.loading = true
      const request_data = {
        action: "_wpcommerce_admin_settings",
        subaction: "save_data",
        data: JSON.stringify(state.values),
        nonce: wpApiSettings.nonce,
      };
      $.ajax({
        url: ajaxurl + "?action=_wpcommerce_admin_settings",
        type: "post",
        dataType: "json",
        // contentType: 'application/json',
        data: request_data,
        success: (res) => {
          resolve(res)
        },
        complete: (res) => {
          state.loading = false;
          if(res.status !== 200) {
            reject(res)
          }
        },
      });
    })
  },
}

const mutations = {
  setValues(state, values) {
    state.values = values
  },
  setValue(state, data) {
    const { key, val } = data
    // state.values[key] = val
    Vue.set(state.values, key, val)
  }
}

export default new Vuex.Store({
  state,
  actions,
  mutations
});

jQuery((e=>{function o(o){const n=o.hasClass("xc-open");e(".xc-open").removeClass("xc-open"),n?o.removeClass("xc-open"):o.addClass("xc-open")}e(window).on("x_currency/change_site_currency",(function(e){const o=e.detail.code;if("string"!=typeof o)return;const n=new URLSearchParams(window.location.search);n.set("currency",o);const c=n.toString(),t=window.location.origin+window.location.pathname+"?"+c;window.location.href=t})),e(".x-currency-shortcode").on("click",".switch",(function(n){n.preventDefault(),n.stopPropagation();let c=e(this).closest(".x-currency-shortcode");o(c),function(e){let o=e.find(".currency-wrap").get(0).getBoundingClientRect();innerHeight-(o.top+o.height/2)<15?(e.removeClass("open-bottom"),e.addClass("open-top")):(e.removeClass("open-top"),e.addClass("open-bottom"))}(c)})),e(".x-currency-shortcode .currency-wrap li").on("click",(function(n){n.preventDefault(),n.stopPropagation();let c=e(this);c.siblings(".active").removeClass("active"),c.addClass("active"),o(c.closest(".x-currency-shortcode")),e(window).trigger({type:"x_currency/change_site_currency",detail:{code:c.data("code")}})})),e(document).on("click",(function(){e(".xc-open").removeClass("xc-open")})),e(".x-currency-sticky .dropdown-ul li").on("click",(function(o){o.preventDefault(),o.stopPropagation(),e(window).trigger({type:"x_currency/change_site_currency",detail:{code:e(this).data("code")}})}))}));
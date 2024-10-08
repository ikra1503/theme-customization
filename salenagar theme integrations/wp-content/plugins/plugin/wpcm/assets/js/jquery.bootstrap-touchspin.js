/*
 *  Bootstrap TouchSpin - v4.2.5
 *  A mobile and touch friendly input spinner component for Bootstrap 3 & 4.
 *  http://www.virtuosoft.eu/code/bootstrap-touchspin/
 *
 *  Made by István Ujj-Mészáros
 *  Under Apache License v2.0 License
 */

!(function (o) {
  "function" == typeof define && define.amd
    ? define(["jquery"], o)
    : "object" == typeof module && module.exports
    ? (module.exports = function (t, n) {
        return void 0 === n && (n = "undefined" != typeof window ? require("jquery") : require("jquery")(t)), o(n), n;
      })
    : o(jQuery);
})(function (j) {
  "use strict";
  var D = 0;
  j.fn.TouchSpin = function (y) {
    var k = {
        min: 0,
        max: 100,
        initval: "",
        replacementval: "",
        step: 1,
        decimals: 0,
        stepinterval: 100,
        forcestepdivisibility: "round",
        stepintervaldelay: 500,
        verticalbuttons: !1,
        verticalup: "+",
        verticaldown: "-",
        verticalupclass: "",
        verticaldownclass: "",
        prefix: "",
        postfix: "",
        prefix_extraclass: "",
        postfix_extraclass: "",
        booster: !0,
        boostat: 10,
        maxboostedstep: !1,
        mousewheel: !0,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        buttondown_txt: "-",
        buttonup_txt: "+",
        callback_before_calculation: function (t) {
          return t;
        },
        callback_after_calculation: function (t) {
          return t;
        },
      },
      C = {
        min: "min",
        max: "max",
        initval: "init-val",
        replacementval: "replacement-val",
        step: "step",
        decimals: "decimals",
        stepinterval: "step-interval",
        verticalbuttons: "vertical-buttons",
        verticalupclass: "vertical-up-class",
        verticaldownclass: "vertical-down-class",
        forcestepdivisibility: "force-step-divisibility",
        stepintervaldelay: "step-interval-delay",
        prefix: "prefix",
        postfix: "postfix",
        prefix_extraclass: "prefix-extra-class",
        postfix_extraclass: "postfix-extra-class",
        booster: "booster",
        boostat: "boostat",
        maxboostedstep: "max-boosted-step",
        mousewheel: "mouse-wheel",
        buttondown_class: "button-down-class",
        buttonup_class: "button-up-class",
        buttondown_txt: "button-down-txt",
        buttonup_txt: "button-up-txt",
      };
    return this.each(function () {
      var i,
        p,
        a,
        u,
        o,
        s,
        t,
        n,
        e,
        r,
        c = j(this),
        l = c.data(),
        d = 0,
        f = !1;
      function b() {
        "" === i.prefix && (p = o.prefix.detach()), "" === i.postfix && (a = o.postfix.detach());
      }
      function h() {
        var t, n, o;
        "" !== (t = i.callback_before_calculation(c.val()))
          ? (0 < i.decimals && "." === t) ||
            ((n = parseFloat(t)),
            isNaN(n) && (n = "" !== i.replacementval ? i.replacementval : 0),
            (o = n).toString() !== t && (o = n),
            null !== i.min && n < i.min && (o = i.min),
            null !== i.max && n > i.max && (o = i.max),
            (o = (function (t) {
              switch (i.forcestepdivisibility) {
                case "round":
                  return (Math.round(t / i.step) * i.step).toFixed(i.decimals);
                case "floor":
                  return (Math.floor(t / i.step) * i.step).toFixed(i.decimals);
                case "ceil":
                  return (Math.ceil(t / i.step) * i.step).toFixed(i.decimals);
                default:
                  return t;
              }
            })(o)),
            Number(t).toString() !== o.toString() && (c.val(o), c.trigger("change")))
          : "" !== i.replacementval && (c.val(i.replacementval), c.trigger("change"));
      }
      function v() {
        if (i.booster) {
          var t = Math.pow(2, Math.floor(d / i.boostat)) * i.step;
          return i.maxboostedstep && t > i.maxboostedstep && ((t = i.maxboostedstep), (s = Math.round(s / t) * t)), Math.max(i.step, t);
        }
        return i.step;
      }
      function x() {
        h(), (s = parseFloat(i.callback_before_calculation(o.input.val()))), isNaN(s) && (s = 0);
        var t = s,
          n = v();
        (s += n), null !== i.max && s > i.max && ((s = i.max), c.trigger("touchspin.on.max"), _()), o.input.val(i.callback_after_calculation(Number(s).toFixed(i.decimals))), t !== s && c.trigger("change");
      }
      function g() {
        h(), (s = parseFloat(i.callback_before_calculation(o.input.val()))), isNaN(s) && (s = 0);
        var t = s,
          n = v();
        (s -= n), null !== i.min && s < i.min && ((s = i.min), c.trigger("touchspin.on.min"), _()), o.input.val(i.callback_after_calculation(Number(s).toFixed(i.decimals))), t !== s && c.trigger("change");
      }
      function m() {
        _(),
          (d = 0),
          (f = "down"),
          c.trigger("touchspin.on.startspin"),
          c.trigger("touchspin.on.startdownspin"),
          (e = setTimeout(function () {
            t = setInterval(function () {
              d++, g();
            }, i.stepinterval);
          }, i.stepintervaldelay));
      }
      function w() {
        _(),
          (d = 0),
          (f = "up"),
          c.trigger("touchspin.on.startspin"),
          c.trigger("touchspin.on.startupspin"),
          (r = setTimeout(function () {
            n = setInterval(function () {
              d++, x();
            }, i.stepinterval);
          }, i.stepintervaldelay));
      }
      function _() {
        switch ((clearTimeout(e), clearTimeout(r), clearInterval(t), clearInterval(n), f)) {
          case "up":
            c.trigger("touchspin.on.stopupspin"), c.trigger("touchspin.on.stopspin");
            break;
          case "down":
            c.trigger("touchspin.on.stopdownspin"), c.trigger("touchspin.on.stopspin");
        }
        (d = 0), (f = !1);
      }
      !(function () {
        if (c.data("alreadyinitialized")) return;
        if ((c.data("alreadyinitialized", !0), (D += 1), c.data("spinnerid", D), !c.is("input"))) return console.log("Must be an input.");
        (i = j.extend(
          {},
          k,
          l,
          ((s = {}),
          j.each(C, function (t, n) {
            var o = "bts-" + n;
            c.is("[data-" + o + "]") && (s[t] = c.data(o));
          }),
          s),
          y
        )),
          "" !== i.initval && "" === c.val() && c.val(i.initval),
          h(),
          (function () {
            var t = c.val(),
              n = c.parent();
            "" !== t && (t = i.callback_after_calculation(Number(t).toFixed(i.decimals)));
            c.data("initvalue", t).val(t),
              c.addClass("form-control"),
              n.hasClass("input-group")
                ? (function (t) {
                    t.addClass("bootstrap-touchspin");
                    var n,
                      o,
                      s = c.prev(),
                      p = c.next(),
                      a = '<span class="input-group-addon input-group-prepend bootstrap-touchspin-prefix input-group-prepend bootstrap-touchspin-injected"><span class="input-group-text">' + i.prefix + "</span></span>",
                      e = '<span class="input-group-addon input-group-append bootstrap-touchspin-postfix input-group-append bootstrap-touchspin-injected"><span class="input-group-text">' + i.postfix + "</span></span>";
                    s.hasClass("input-group-btn") || s.hasClass("input-group-prepend")
                      ? ((n = '<button class="' + i.buttondown_class + ' bootstrap-touchspin-down bootstrap-touchspin-injected" type="button">' + i.buttondown_txt + "</button>"), s.append(n))
                      : ((n = '<span class="input-group-btn input-group-prepend bootstrap-touchspin-injected"><button class="' + i.buttondown_class + ' bootstrap-touchspin-down" type="button">' + i.buttondown_txt + "</button></span>"),
                        j(n).insertBefore(c));
                    p.hasClass("input-group-btn") || p.hasClass("input-group-append")
                      ? ((o = '<button class="' + i.buttonup_class + ' bootstrap-touchspin-up bootstrap-touchspin-injected" type="button">' + i.buttonup_txt + "</button>"), p.prepend(o))
                      : ((o = '<span class="input-group-btn input-group-append bootstrap-touchspin-injected"><button class="' + i.buttonup_class + ' bootstrap-touchspin-up" type="button">' + i.buttonup_txt + "</button></span>"),
                        j(o).insertAfter(c));
                    j(a).insertBefore(c), j(e).insertAfter(c), (u = t);
                  })(n)
                : (function () {
                    var t,
                      n = "";
                    c.hasClass("input-sm") && (n = "input-group-sm");
                    c.hasClass("input-lg") && (n = "input-group-lg");
                    t = i.verticalbuttons
                      ? '<div class="input-group ' +
                        n +
                        ' bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon input-group-prepend bootstrap-touchspin-prefix"><span class="input-group-text">' +
                        i.prefix +
                        '</span></span><span class="input-group-addon bootstrap-touchspin-postfix input-group-append"><span class="input-group-text">' +
                        i.postfix +
                        '</span></span><span class="input-group-btn-vertical"><button class="' +
                        i.buttondown_class +
                        " bootstrap-touchspin-up " +
                        i.verticalupclass +
                        '" type="button">' +
                        i.verticalup +
                        '</button><button class="' +
                        i.buttonup_class +
                        " bootstrap-touchspin-down " +
                        i.verticaldownclass +
                        '" type="button">' +
                        i.verticaldown +
                        "</button></span></div>"
                      : '<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-btn input-group-prepend"><button class="' +
                        i.buttondown_class +
                        ' bootstrap-touchspin-down" type="button">' +
                        i.buttondown_txt +
                        '</button></span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span class="input-group-text">' +
                        i.prefix +
                        '</span></span><span class="input-group-addon bootstrap-touchspin-postfix input-group-append"><span class="input-group-text">' +
                        i.postfix +
                        '</span></span><span class="input-group-btn input-group-append"><button class="' +
                        i.buttonup_class +
                        ' bootstrap-touchspin-up" type="button">' +
                        i.buttonup_txt +
                        "</button></span></div>";
                    (u = j(t).insertBefore(c)), j(".bootstrap-touchspin-prefix", u).after(c), c.hasClass("input-sm") ? u.addClass("input-group-sm") : c.hasClass("input-lg") && u.addClass("input-group-lg");
                  })();
          })(),
          (o = {
            down: j(".bootstrap-touchspin-down", u),
            up: j(".bootstrap-touchspin-up", u),
            input: j("input", u),
            prefix: j(".bootstrap-touchspin-prefix", u).addClass(i.prefix_extraclass),
            postfix: j(".bootstrap-touchspin-postfix", u).addClass(i.postfix_extraclass),
          }),
          b(),
          c.on("keydown.touchspin", function (t) {
            var n = t.keyCode || t.which;
            38 === n ? ("up" !== f && (x(), w()), t.preventDefault()) : 40 === n && ("down" !== f && (g(), m()), t.preventDefault());
          }),
          c.on("keyup.touchspin", function (t) {
            var n = t.keyCode || t.which;
            38 === n ? _() : 40 === n && _();
          }),
          c.on("blur.touchspin", function () {
            h(), c.val(i.callback_after_calculation(c.val()));
          }),
          o.down.on("keydown", function (t) {
            var n = t.keyCode || t.which;
            (32 !== n && 13 !== n) || ("down" !== f && (g(), m()), t.preventDefault());
          }),
          o.down.on("keyup.touchspin", function (t) {
            var n = t.keyCode || t.which;
            (32 !== n && 13 !== n) || _();
          }),
          o.up.on("keydown.touchspin", function (t) {
            var n = t.keyCode || t.which;
            (32 !== n && 13 !== n) || ("up" !== f && (x(), w()), t.preventDefault());
          }),
          o.up.on("keyup.touchspin", function (t) {
            var n = t.keyCode || t.which;
            (32 !== n && 13 !== n) || _();
          }),
          o.down.on("mousedown.touchspin", function (t) {
            o.down.off("touchstart.touchspin"), c.is(":disabled") || (g(), m(), t.preventDefault(), t.stopPropagation());
          }),
          o.down.on("touchstart.touchspin", function (t) {
            o.down.off("mousedown.touchspin"), c.is(":disabled") || (g(), m(), t.preventDefault(), t.stopPropagation());
          }),
          o.up.on("mousedown.touchspin", function (t) {
            o.up.off("touchstart.touchspin"), c.is(":disabled") || (x(), w(), t.preventDefault(), t.stopPropagation());
          }),
          o.up.on("touchstart.touchspin", function (t) {
            o.up.off("mousedown.touchspin"), c.is(":disabled") || (x(), w(), t.preventDefault(), t.stopPropagation());
          }),
          o.up.on("mouseup.touchspin mouseout.touchspin touchleave.touchspin touchend.touchspin touchcancel.touchspin", function (t) {
            f && (t.stopPropagation(), _());
          }),
          o.down.on("mouseup.touchspin mouseout.touchspin touchleave.touchspin touchend.touchspin touchcancel.touchspin", function (t) {
            f && (t.stopPropagation(), _());
          }),
          o.down.on("mousemove.touchspin touchmove.touchspin", function (t) {
            f && (t.stopPropagation(), t.preventDefault());
          }),
          o.up.on("mousemove.touchspin touchmove.touchspin", function (t) {
            f && (t.stopPropagation(), t.preventDefault());
          }),
          c.on("mousewheel.touchspin DOMMouseScroll.touchspin", function (t) {
            if (i.mousewheel && c.is(":focus")) {
              var n = t.originalEvent.wheelDelta || -t.originalEvent.deltaY || -t.originalEvent.detail;
              t.stopPropagation(), t.preventDefault(), n < 0 ? g() : x();
            }
          }),
          c.on("touchspin.destroy", function () {
            var t;
            (t = c.parent()),
              _(),
              c.off(".touchspin"),
              t.hasClass("bootstrap-touchspin-injected") ? (c.siblings().remove(), c.unwrap()) : (j(".bootstrap-touchspin-injected", t).remove(), t.removeClass("bootstrap-touchspin")),
              c.data("alreadyinitialized", !1);
          }),
          c.on("touchspin.uponce", function () {
            _(), x();
          }),
          c.on("touchspin.downonce", function () {
            _(), g();
          }),
          c.on("touchspin.startupspin", function () {
            w();
          }),
          c.on("touchspin.startdownspin", function () {
            m();
          }),
          c.on("touchspin.stopspin", function () {
            _();
          }),
          c.on("touchspin.updatesettings", function (t, n) {
            !(function (t) {
              (function (t) {
                if (((i = j.extend({}, i, t)), t.postfix)) {
                  var n = c.parent().find(".bootstrap-touchspin-postfix");
                  0 === n.length && a.insertAfter(c), c.parent().find(".bootstrap-touchspin-postfix .input-group-text").text(t.postfix);
                }
                if (t.prefix) {
                  var o = c.parent().find(".bootstrap-touchspin-prefix");
                  0 === o.length && p.insertBefore(c), c.parent().find(".bootstrap-touchspin-prefix .input-group-text").text(t.prefix);
                }
                b();
              })(t),
                h();
              var n = o.input.val();
              "" !== n && ((n = Number(i.callback_before_calculation(o.input.val()))), o.input.val(i.callback_after_calculation(Number(n).toFixed(i.decimals))));
            })(n);
          });
        var s;
      })();
    });
  };
});

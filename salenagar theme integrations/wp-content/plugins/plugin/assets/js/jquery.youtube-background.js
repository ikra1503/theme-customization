/**
 * jquery.youtube-background v1.0.8 | Nikola Stamatovic <@stamat> | MIT
 */

!(function () {
  "use strict";
  function t(t, e) {
    return t.classList ? t.classList.contains(e) : new RegExp("\\b" + e + "\\b").test(t.className);
  }
  function e(e, i) {
    e.classList ? e.classList.add(i) : t(e, i) || (e.className += " " + i);
  }
  function i(t, e) {
    t.classList ? t.classList.remove(e) : (t.className = t.className.replace(new RegExp("\\b" + e + "\\b", "g"), ""));
  }
  var a = document.createElement("script");
  a.src = "https://www.youtube.com/player_api";
  var s,
    o = document.getElementsByTagName("script")[0];
  function n(t, e, i, a) {
    (this.is_mobile = (function () {
      let t = !1;
      var e;
      return (
        (e = navigator.userAgent || navigator.vendor || window.opera),
        (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(
          e
        ) ||
          /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
            e.substr(0, 4)
          )) &&
        (t = !0),
        t
      );
    })()),
      (this.element = t),
      (this.ytid = i),
      (this.uid = a),
      (this.player = null),
      (this.buttons = {}),
      (this.state = {}),
      (this.state.play = !1),
      (this.state.mute = !1),
      (this.params = {}),
      (this.defaults = {
        pause: !1,
        "play-button": !1,
        "mute-button": !1,
        autoplay: !0,
        muted: !0,
        loop: !0,
        mobile: !1,
        "load-background": !0,
        resolution: "16:9",
        onStatusChange: function () { },
        "inline-styles": !0,
        "fit-box": !1,
        offset: 200,
      }),
      (this.__init__ = function () {
        this.ytid &&
          (this.parseProperties(e),
            (this.params.resolution_mod = (function (t) {
              var e = t.split(/\s?:\s?/i);
              if (e.length < 2) return 16 / 9;
              var i = parseInt(e[0], 10),
                a = parseInt(e[1], 10);
              return isNaN(i) || isNaN(a) ? 16 / 9 : i / a;
            })(this.params.resolution)),
            (this.state.playing = this.params.autoplay),
            (this.state.muted = this.params.muted),
            this.buildHTML(),
            this.injectIFrame(),
            this.params["play-button"] &&
            this.generateActionButton({
              name: "play",
              className: "play-toggle",
              innerHtml: '<i class="fa"></i>',
              initialState: !1,
              stateClassName: "paused",
              condition_parameter: "autoplay",
              stateChildClassNames: ["fa-pause-circle", "fa-play-circle"],
              actions: ["play", "pause"],
            }),
            this.params["mute-button"] &&
            this.generateActionButton({
              name: "mute",
              className: "mute-toggle",
              innerHtml: '<i class="fa"></i>',
              initialState: !0,
              stateClassName: "muted",
              condition_parameter: "muted",
              stateChildClassNames: ["fa-volume-up", "fa-volume-mute"],
              actions: ["unmute", "mute"],
            }));
      }),
      this.__init__();
  }
  function r(t, e) {
    (this.elements = t),
      "string" == typeof t && (this.elements = document.querySelectorAll(t)),
      (this.index = {}),
      (this.re = {}),
      (this.re.YOUTUBE = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i),
      (this.re.VIMEO = /(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:[a-zA-Z0-9_\-]+)?/i),
      (this.__init__ = function () {
        for (var t = 0; t < this.elements.length; t++) {
          var i = this.elements[t],
            a = i.getAttribute("data-youtube"),
            s = this.getVidID(a);
          if (s) {
            var o = this.generateUID(s.id);
            if (o && "YOUTUBE" === s.type) {
              var r = new n(i, e, s.id, o);
              this.index[o] = r;
            }
          }
        }
        this.initYTPlayers();
      }),
      this.__init__();
  }
  o.parentNode.insertBefore(a, o),
    (n.prototype.initYTPlayer = function () {
      var t = this;
      window.hasOwnProperty("YT") &&
        (this.player = new YT.Player(this.uid, {
          events: {
            onReady: function (e) {
              t.onVideoPlayerReady(e);
            },
            onStateChange: function (e) {
              t.onVideoStateChange(e);
            },
            onError: function (t) { },
          },
        }));
    }),
    (n.prototype.onVideoPlayerReady = function (t) {
      this.params.autoplay && t.target.playVideo();
    }),
    (n.prototype.onVideoStateChange = function (t) {
      0 === t.data && this.params.loop && t.target.playVideo(), -1 === t.data && this.params.autoplay && t.target.playVideo(), 1 === t.data && (this.iframe.style.opacity = 1), this.params.onStatusChange(t);
    }),
    (n.prototype.parseProperties = function (t) {
      if (t) for (var e in this.defaults) t.hasOwnProperty(e) || (this.params[e] = this.defaults[e]);
      else this.params = this.defaults;
      for (var e in this.params) {
        var i = this.element.getAttribute("data-ytbg-" + e);
        null != i && ((i = "false" !== i && i), (this.params[e] = i));
      }
      this.params.pause && (this.params["play-button"] = this.params.pause);
    }),
    (n.prototype.injectIFrame = function () {
      (this.iframe = document.createElement("iframe")), this.iframe.setAttribute("frameborder", 0), this.iframe.setAttribute("allow", ["autoplay; mute"]);
      var t = "https://www.youtube.com/embed/" + this.ytid + "?enablejsapi=1&disablekb=1&controls=0&rel=0&iv_load_policy=3&cc_load_policy=0&playsinline=1&showinfo=0&modestbranding=1&fs=0&origin=" + window.location.origin;
      if (
        (this.params.muted && (t += "&mute=1"),
          this.params.autoplay && (t += "&autoplay=1"),
          this.params.loop && (t += "&loop=1"),
          (this.iframe.src = t),
          this.uid && (this.iframe.id = this.uid),
          this.params["inline-styles"] &&
          ((this.iframe.style.top = "50%"), (this.iframe.style.left = "50%"), (this.iframe.style.transform = "translateX(-50%) translateY(-50%)"), (this.iframe.style.position = "absolute"), (this.iframe.style.opacity = 0)),
          this.element.parentNode.appendChild(this.iframe),
          this.iframe.parentNode.removeChild(this.element),
          this.params["fit-box"])
      )
        (this.iframe.style.width = "100%"), (this.iframe.style.height = "100%");
      else {
        var e = this;
        function i() {
          var t = e.iframe.parentNode.offsetHeight + e.params.offset,
            i = e.iframe.parentNode.offsetWidth + e.params.offset,
            a = e.params.resolution_mod;
          a > i / t ? ((e.iframe.style.width = t * a + "px"), (e.iframe.style.height = t + "px")) : ((e.iframe.style.width = i + "px"), (e.iframe.style.height = i / a + "px"));
        }
        window.addEventListener("resize", i), i();
      }
    }),
    (n.prototype.buildHTML = function () {
      var t = this.element.parentNode,
        e = document.createElement("div");
      (e.className = "youtube-background"), t.insertBefore(e, this.element), e.appendChild(this.element);
      var i = this.element.id;
      (this.element.id = ""), (e.id = i);
      var a = { height: "100%", width: "100%", "z-index": "0", position: "absolute", overflow: "hidden", top: 0, left: 0, bottom: 0, right: 0 };
      if (
        (this.params["mute-button"] || (a["pointer-events"] = "none"),
          this.params["load-background"] &&
          ((a["background-image"] = "url(https://img.youtube.com/vi/" + this.ytid + "/maxresdefault.jpg)"), (a["background-size"] = "cover"), (a["background-repeat"] = "no-repeat"), (a["background-position"] = "center")),
          this.params["inline-styles"])
      ) {
        for (var s in a) e.style[s] = a[s];
        e.parentNode.style.position = "relative";
      }
      if (this.is_mobile && !this.params.mobile) return e;
      if (this.params["play-button"] || this.params["mute-button"]) {
        var o = document.createElement("div");
        (o.className = "video-background-controls"), (o.style.position = "absolute"), (o.style.top = "10px"), (o.style.right = "10px"), (o.style["z-index"] = 2), (this.controls_element = o), e.parentNode.appendChild(o);
      }
      return e;
    }),
    (n.prototype.play = function () {
      if (this.buttons.hasOwnProperty("play")) {
        var t = this.buttons.play;
        i(t.element, t.button_properties.stateClassName), e(t.element.firstChild, t.button_properties.stateChildClassNames[0]), i(t.element.firstChild, t.button_properties.stateChildClassNames[1]);
      }
      this.player && this.player.playVideo();
    }),
    (n.prototype.pause = function () {
      if (this.buttons.hasOwnProperty("play")) {
        var t = this.buttons.play;
        e(t.element, t.button_properties.stateClassName), i(t.element.firstChild, t.button_properties.stateChildClassNames[0]), e(t.element.firstChild, t.button_properties.stateChildClassNames[1]);
      }
      this.player && this.player.pauseVideo();
    }),
    (n.prototype.unmute = function () {
      if (this.buttons.hasOwnProperty("mute")) {
        var t = this.buttons.mute;
        i(t.element, t.button_properties.stateClassName), e(t.element.firstChild, t.button_properties.stateChildClassNames[0]), i(t.element.firstChild, t.button_properties.stateChildClassNames[1]);
      }
      this.player && this.player.unMute();
    }),
    (n.prototype.mute = function () {
      if (this.buttons.hasOwnProperty("mute")) {
        var t = this.buttons.mute;
        e(t.element, t.button_properties.stateClassName), i(t.element.firstChild, t.button_properties.stateChildClassNames[0]), e(t.element.firstChild, t.button_properties.stateChildClassNames[1]);
      }
      this.player && this.player.mute();
    }),
    (n.prototype.generateActionButton = function (a) {
      var s = document.createElement("button");
      (s.className = a.className),
        (s.innerHTML = a.innerHtml),
        e(s.firstChild, a.stateChildClassNames[0]),
        this.params[a.condition_parameter] === a.initialState && (e(s, a.stateClassName), i(s.firstChild, a.stateChildClassNames[0]), e(s.firstChild, a.stateChildClassNames[1]));
      var o = this;
      s.addEventListener("click", function (e) {
        t(this, a.stateClassName) ? ((o.state[a.name] = !1), o[a.actions[0]]()) : ((o.state[a.name] = !0), o[a.actions[1]]());
      }),
        (this.buttons[a.name] = { element: s, button_properties: a }),
        this.controls_element.appendChild(s);
    }),
    (r.prototype.getVidID = function (t) {
      if (null != t)
        for (var e in this.re) {
          var i = t.match(this.re[e]);
          if (i && i.length) return (this.re[e].lastIndex = 0), { id: i[1], type: e };
        }
      return null;
    }),
    (r.prototype.generateUID = function (t) {
      function e(t, e) {
        return (t = Math.ceil(t)), (e = Math.floor(e)), Math.floor(Math.random() * (e - t + 1)) + t;
      }
      for (var i = t + "-" + e(0, 9999); this.index.hasOwnProperty(i);) i = t + "-" + e(0, 9999);
      return i;
    }),
    (r.prototype.pauseVideos = function () {
      for (var t in this.index) this.index[t].pause();
    }),
    (r.prototype.playVideos = function () {
      for (var t in this.index) this.index[t].play();
    }),
    (r.prototype.initYTPlayers = function (t) {
      var e = this;
      (window.onYouTubeIframeAPIReady = function () {
        for (var i in e.index) e.index[i] instanceof n && e.index[i].initYTPlayer();
        t && setTimeout(t, 100);
      }),
        window.hasOwnProperty("YT") && window.YT.loaded && window.onYouTubeIframeAPIReady();
    }),
    "function" == typeof jQuery &&
    ((s = jQuery).fn.youtube_background = function (t) {
      var e = s(this);
      return new r(this, t), e;
    }),
    (window.VideoBackgrounds = r);
})();

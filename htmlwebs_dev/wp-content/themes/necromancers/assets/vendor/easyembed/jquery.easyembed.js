;
(function ($, window, document) {
    $.fn.easyEmbed = function (options) {
        var $that = this;

        // detect if device requires user interaction for playback
        var mobile = /iPad|iPhone|iPod/.test(navigator.userAgent);

        // translate shorthand
        var shorthand = $that.data('easy-embed').split(':');

        var settings = $.extend({
            // general settings
            id: ($that.data('id') || shorthand[1]) || 'ScMzIvxBSi4',
            provider: ($that.data('provider') || shorthand[0]) || 'youtube',
            width: $that.data('width') || 16,
            height: $that.data('height') || 9,

            // youtube settings
            controls: $that.data('controls') || false,
            showinfo: $that.data('showinfo') || false,

            // vimeo settings
            color: $that.data('color') || '00adef',
            title: $that.data('title') || false,
            byline: $that.data('byline') || false,
                        portrait: $that.data('portrait') || false,
                        setsize: $that.data('setsize') || false,
        }, options);

        var getSource = function () {
            switch (settings.provider.toLowerCase()) {
                case 'youtube':
                  return '//youtube.com/embed/' + settings.id + '?rel=0&autoplay=1'
                    + '&controls=' + (settings.controls + 0)
                    + '&showinfo=' + (settings.showinfo + 0);
                case 'vimeo':
                  return '//player.vimeo.com/video/' + settings.id + '?autoplay=1'
                    + '&color=' + settings.color
                    + '&title=' + (settings.title + 0)
                    + '&byline=' + (settings.byline + 0)
                    + '&portrait=' + (settings.controls + 0);
                case 'twitch-channel':
                  return '//player.twitch.tv/?channel=' + settings.id + '&parent=' + window.location.hostname;
                case 'twitch-video':
                  return '//player.twitch.tv/?video=' + settings.id + '&parent=' + window.location.hostname;
                case 'tiktok':
                  return '//www.tiktok.com/embed/v2/' + settings.id;
            }
        }

        var setThumbnail = function (src) {
            $that.css('background', 'black url(' + src + ') 50% 50% / cover no-repeat');
        };

        var setSize = function () {
            $that.css('height', $that.width() / settings.width * settings.height);
        }

        var setIframe = function () {
            $that.html($('<iframe>')
                .attr('src', getSource())
                .attr('width', '100%')
                .attr('height', '100%')
                .attr('frameborder', 0)
                .attr('allowfullscreen', 1));
            $that.addClass("playing-video");
                }

                if (settings.setsize) {
                    setSize();

                    $(window).resize(function () {
                            setSize();
                    })
                }

        if (!mobile) {
            $that.find('*').addBack().click(function () {
                setIframe();
            });
        } else {
            $that.find('*').addBack().click(function () {
                setIframe();
            });
        }

        return this;
    };

    $(document).ready(function () {
        if ($('[data-easy-embed]').length > 0) {
            $('[data-easy-embed]').each(function () {
                $(this).easyEmbed();
            })
        }
    })
})(jQuery, window, document);

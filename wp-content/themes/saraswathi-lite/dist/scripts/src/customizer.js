/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function(wp, $) {

    // Check if customizer exists
    if (!wp || !wp.customize) return;


    var $style = $('#saraswathi-inline-css'),
        $body = $('body'),
        $single = $('body.single,body.page'),
        noPostMetaMsg = saraswathi_ajaxvar.noPostMetaMsg,
        $archive = $('body.archive,body.home'),
        noSummaryMetaMsg = saraswathi_ajaxvar.noSummaryMetaMsg,
        $header = $('.saras-header'),
        $topbarContainer = $('.saras-topbar-container'),
        $mainMenu = $('.saras-main-menu'),
        $primaryNav = $('.saras-primary-nav'),
        $searchToggle = $('.saras-search-toggle'),
        $contentWrap = $('.saras-content-wrap'),
        $content = $('.saras-content'),
        $sidebar = $('.saras-sidebar'),
        $footer = $('.saras-footer'),
        $woo = $('body.woocommerce'),
        topbarlayouts = new Array('left', 'right', 'none'),
        sidebarlayouts = new Array('left', 'right', 'none'),
        logolayouts = new Array('left', 'right', 'center'),
        footerlayouts = new Array('left', 'right'),
        scrolllayouts = new Array('left', 'right', 'none'),
        api = wp.customize,
        Preview,
        hex2rgb = function(hex) {
            var pattern = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
            hex = hex.replace(pattern, function(m, r, g, b) {
                return r + r + g + g + b + b;
            });
            var rgb = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return rgb ? parseInt(rgb[1], 16) + ',' + parseInt(rgb[2], 16) + ',' + parseInt(rgb[3], 16) : null;
        },
        scrollTo = function(opts) {
            var flag = opts.flag,
                to = opts.to;
            if (to.length > 0)
                var offset = parseFloat(to.height() * 3),
                    top = to.offset().top - offset;
            if (!flag)
                $('html,body').animate({
                    scrollTop: top
                }, 300);


        },
        scopePageOnChange = function(opts) {
            var page = opts.page,
                value = opts.value,
                notPageTitle = opts.notPageTitle,
                notPageText = opts.notPageText,
                target = opts.target,
                noTargetMsgTitle = opts.noTargetMsgTitle,
                flag = opts.flag,
                noTargetMsgText = opts.noTargetMsgText;

            if (!page.length > 0) {
                if (!flag)
                    swal({
                        title: notPageTitle,
                        text: notPageText,
                    });


            } else {

                if (page.find(target).length > 0) {

                    scrollTo({
                        to: page.find(target),
                        flag: flag
                    });

                } else {
                    if (!flag)
                        swal({
                            title: noTargetMsgTitle,
                            text: noTargetMsgText,
                        });

                }

                opts.completeCallback();
            }


        },
        hasStyle = function() {
            return $style.length > 0;
        };

    // Saraswathi Customizer Previewer class (attached to the Customize API)
    api.saraswathiCustomizerPreview = {

        init: function() {
            var self = this; // Store a reference to "this" in case callback functions need to reference it.


        }

    };

    /**
     * Capture the instance of the Preview since it is private.
     */
    Preview = api.Preview;
    api.Preview = Preview.extend({
        initialize: function(params, options) {

            // cache the Preview
            api.saraswathiCustomizerPreview.preview = this;

            // call the Preview's initialize function
            Preview.prototype.initialize.call(this, params, options);
        }
    });

    // On document ready.
    $(function() {

        // Initialize Saraswathi Preview Init
        api.saraswathiCustomizerPreview.init();


        if (!hasStyle()) {
            $style = $('head').append('<style type="text/css" id="saraswathi-inline-css" />')
                .find('#saraswathi-inline-css');
        }
        // Set default values for alert system
        swal.setDefaults({
            confirmButtonColor: api.instance('saras_button_color_1').get(),
            type: 'info',
            confirmButtonText: saraswathi_ajaxvar.confirmButtonText,
            timer: 10000
        });

        // Site background.
        api('saras_saraswathi_body_bg_color', function(value) {
            value.bind(function(color) {
                $('html,body').css('background-color', color);
            });
        });


        //Sidebar Layout.
        api('saras_saraswathi_sidebar_layout', function(value) {
            var hasRun = false;
            value.bind(function(layout) {
                scopePageOnChange({
                    page: $sidebar,
                    notPageTitle: saraswathi_ajaxvar.noSidebar,
                    notPageText: saraswathi_ajaxvar.noSidebarText,
                    target: $sidebar.find('.widget'),
                    noTargetMsgTitle: saraswathi_ajaxvar.sorry,
                    noTargetMsgText: saraswathi_ajaxvar.noWidgetsText,
                    flag: hasRun,
                    completeCallback: function() {
                        $.each(sidebarlayouts, function(key, remove) {
                            if (remove !== layout) {
                                $content.removeClass(remove);
                                $sidebar.removeClass(remove);
                            }
                        });

                        $content.addClass(layout);
                        $sidebar.addClass(layout);
                        if ('none' === layout) {
                            $content.css('width', '100%');
                        } else {
                            $content.css('width', api.instance('saras_saraswathi_content_width').get() + '%');
                        }

                    },
                });
                hasRun = true;
            });
        });


        api('saras_disable_entry_date', function(value) {
            var hasRun = false;
            swal.close();

            value.bind(function(check) {
                scopePageOnChange({
                    page: $single,
                    notPageTitle: saraswathi_ajaxvar.entryDate,
                    notPageText: noPostMetaMsg,
                    target: '.post .posted-on',
                    noTargetMsgTitle: saraswathi_ajaxvar.sorry,
                    noTargetMsgText: saraswathi_ajaxvar.noEntryDate,
                    value: check,
                    flag: hasRun,
                    completeCallback: function() {
                        if (check) {
                            $single.find('.post .posted-on').hide();
                        } else {
                            $single.find('.post .posted-on').show();
                        }
                    },
                });
                hasRun = true;

            });

        });

        api('saras_disable_entry_author', function(value) {
            var hasRun = false;
            swal.close();

            value.bind(function(check) {
                scopePageOnChange({
                    page: $single,
                    notPageTitle: saraswathi_ajaxvar.entryAuthor,
                    notPageText: noPostMetaMsg,
                    target: '.author-meta',
                    noTargetMsgTitle: saraswathi_ajaxvar.sorry,
                    noTargetMsgText: saraswathi_ajaxvar.noEntryAuthor,
                    value: check,
                    flag: hasRun,
                    completeCallback: function() {
                        if (check) {
                            $single.find('.author-meta').hide();
                        } else {
                            $single.find('.author-meta').show();
                        }
                    },
                });
                hasRun = true;

            });
        });


        api('saras_disable_entry_category', function(value) {
            var hasRun = false;
            swal.close();

            value.bind(function(check) {
                scopePageOnChange({
                    page: $single,
                    notPageTitle: saraswathi_ajaxvar.entryCategory,
                    notPageText: noPostMetaMsg,
                    target: '.cat-links',
                    noTargetMsgTitle: saraswathi_ajaxvar.sorry,
                    noTargetMsgText: saraswathi_ajaxvar.noEntryCategory,
                    value: check,
                    flag: hasRun,
                    completeCallback: function() {
                        if (check) {
                            $single.find('.cat-links').hide();
                        } else {
                            $single.find('.cat-links').show();
                        }
                    },
                });
                hasRun = true;

            });
        });


        api('saras_disable_entry_tags', function(value) {
            var hasRun = false;
            swal.close();

            value.bind(function(check) {
                scopePageOnChange({
                    page: $single,
                    notPageTitle: saraswathi_ajaxvar.entryTags,
                    notPageText: noPostMetaMsg,
                    target: '.tags-links',
                    noTargetMsgTitle: saraswathi_ajaxvar.sorry,
                    noTargetMsgText: saraswathi_ajaxvar.noEntryTags,
                    value: check,
                    flag: hasRun,
                    completeCallback: function() {
                        if (check) {
                            $single.find('.tags-links').hide();
                        } else {
                            $single.find('.tags-links').show();
                        }
                    },
                });
                hasRun = true;

            });
        });



        api('saras_disable_entry_format', function(value) {
            var hasRun = false;
            swal.close();

            value.bind(function(check) {
                scopePageOnChange({
                    page: $single,
                    notPageTitle: saraswathi_ajaxvar.entryFormat,
                    notPageText: noPostMetaMsg,
                    target: '.entry-format',
                    noTargetMsgTitle: saraswathi_ajaxvar.sorry,
                    noTargetMsgText: saraswathi_ajaxvar.noEntryFormat,
                    value: check,
                    flag: hasRun,
                    completeCallback: function() {
                        if (check) {
                            $single.find('.entry-format').hide();
                        } else {
                            $single.find('.entry-format').show();
                        }
                    },
                });
                hasRun = true;

            });
        });


        api('saras_disable_entry_comment', function(value) {
            var hasRun = false;
            swal.close();

            value.bind(function(check) {
                scopePageOnChange({
                    page: $single,
                    notPageTitle: saraswathi_ajaxvar.entryComment,
                    notPageText: noPostMetaMsg,
                    target: '.comments-link',
                    noTargetMsgTitle: saraswathi_ajaxvar.sorry,
                    noTargetMsgText: saraswathi_ajaxvar.noEntryComment,
                    value: check,
                    flag: hasRun,
                    completeCallback: function() {
                        if (check) {
                            $single.find('.comments-link').hide();
                        } else {
                            $single.find('.comments-link').show();
                        }
                    },
                });
                hasRun = true;

            });

        });

        //Header
        //Logo Image Width.
        api('saras_logo_max_width', function(value) {
            var hasRun = false;

            value.bind(function(width) {
                scopePageOnChange({
                    page: $header,
                    notPageTitle: saraswathi_ajaxvar.noHeader,
                    notPageText: saraswathi_ajaxvar.noHeaderText,
                    target: $topbarContainer.find('.site-branding'),
                    noTargetMsgTitle: 'Sorry!',
                    noTargetMsgText: saraswathi_ajaxvar.noLogoSection,
                    flag: hasRun,
                    completeCallback: function() {
                        $topbarContainer.find('.logo img, .custom-logo-link img').css('max-width', width + 'px');
                    },
                });
                hasRun = true;
            });
        });

        //Footer

       //Footer text area.			
        api('saras_footer_textarea', function(value) {
            var hasRun = false;
            value.bind(function(text) {
                scopePageOnChange({
                    page: $footer,
                    notPageTitle: saraswathi_ajaxvar.noFooter,
                    notPageText: saraswathi_ajaxvar.noFooterText,
                    target: $footer.find('.saras-footer-textarea'),
                    noTargetMsgTitle: saraswathi_ajaxvar.sorry,
                    noTargetMsgText: saraswathi_ajaxvar.noFooterTextArea,
                    flag: hasRun,
                    completeCallback: function() {
 
                        $footer.find('.saras-footer-textarea').html(text);

                    },
                });
                hasRun = true;
            });
        });

		});

})(wp, jQuery);
/**
 * Enhance user experience on customizer screen through various JS Funcions.
 *
 * Contains functions that modify elements on customizer preview screen.
 */
;
(function(exports, $) {
    $.fn.sarasCustomizerControls = function() {
        var api = wp.customize;


        // Toggle Footer Text Area
        var footerTextTargets = new Array('saras_footer_textarea');
        hideOptionOnCheck({
            control: 'saras_enable_footer_textarea',
            target: footerTextTargets
        });


        function hideOptionOnCheck(opts) {
            api(opts.control, function(value) {
                value.bind(function(check) {
                    $.each(opts.target, function(key, value) {

                        if (!check) {
                            api.control(value).container.slideUp(100);

                        } else {
                            api.control(value).container.slideDown(100);
                        }



                    });

                });
            });
        }


        function hideOptionOnSelect(opts) {
            api(opts.control, function(value) {
                value.bind(function(select) {
                    $.each(opts.target, function(key, value) {
                        if ('hide' === opts.case) {
                            if (opts.value !== select) {
                                api.control(value).container.slideDown(100);
                            } else {
                                api.control(value).container.slideUp(100);
                            }
                        } else {
                            if (opts.value === select) {
                                api.control(value).container.slideDown(100);
                            } else {
                                api.control(value).container.slideUp(100);
                            }
                        }
                    });

                });
            });
        }

        hideOptionOnSelect({
            control: 'saras_saraswathi_site_layout',
            target: ['saras_saraswathi_grid_max_width'],
            value: 'grid'

        });
}


}(wp, jQuery));

jQuery(document).ready(function($) {

    // Init plugin (	shortcode ) scripts
    $(this).sarasCustomizerControls();
    //Invoke Chosen select
		if($('body.rtl').length	> 0 )
		$('.customize-control-select select').addClass('chosen-rtl');	
    $('.customize-control-select select').chosen({
        width: '100%'
    });
});
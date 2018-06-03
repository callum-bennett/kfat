jQuery(document).ready(function ($) {

	$('#customize-info .preview-notice').html('<a class="button button-primary" href="http://www.mojo-themes.com/item/harmonux-clean-responsive-ux-focused-wordpress-theme/?r=netbiel" target="_blank">Upgrade to HarmonUx Pro version</a>');
	$('#customize-info .preview-notice').append('<p style="color: #d10000">The pro version includes more Customizer options e.g. backgrounds, colors, fonts and layout adjustments, extended support and more!</p>');


	$(".harmonux_project_layout_width").noUiSlider({

		range:[900, 1280], slide:triggerChange, start:$("#harmonux_project_layout_width").val(), handles:1, step: 1, serialization:{
			to:$("#harmonux_project_layout_width"),  resolution: 1
		}

	});

	$(".harmonux_project_sidebar_resize").noUiSlider({

		range:[250, 350], slide:triggerChange, start:$("#harmonux_project_sidebar_resize").val(), handles:1, step: 1, serialization:{
			to:$("#harmonux_project_sidebar_resize"), resolution: 1
		}

	});


});

function triggerChange() {
	jQuery('input').change();






}
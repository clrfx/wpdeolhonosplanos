jQuery(document).ready(function () {
	jQuery("#wp-submit").prop("disabled", "disabled");
	var termodeuso;
	termodeuso = jQuery('<input id="termo-checkbox" type="checkbox" NAME="termo-de-uso" VALUE="agree">');
	termodeuso.click(function ()
            {
                if (!jQuery(this).attr("checked")) {
                    jQuery("#wp-submit").prop("disabled", "disabled");
                    jQuery(this).removeAttr("disabled");
                }
                else {
                    jQuery("#wp-submit").removeAttr("disabled");
                    jQuery(this).removeAttr("disabled");
                }
            });

	jQuery(".forgetmenot").append("<p><label id='termo-label' for='termo-de-uso'>Aceitar <a href='/termo-de-uso'>termo de uso</a></label></p>");
	jQuery("#termo-label").prepend(termodeuso);
});
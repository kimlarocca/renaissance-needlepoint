jQuery( function( $ ) {
    "use strict";

    /**************************
     * "zass-price-slider"
     **************************/

    if (typeof zass_price_slider_params !== 'undefined') {
        // Get markup ready for slider
        $('#min_price').hide();
        $('#max_price').hide();

        $('div.price_slider', '#zass-price-filter-form').show();
        $('div.price_label', '#zass-price-filter-form').show();

        // Price slider uses jquery ui
        var min_price = $('#min_price').data('min');
        var max_price = $('#max_price').data('max');

        var current_min_price = parseInt(min_price, 10);
        var current_max_price = parseInt(max_price, 10);

        if (zass_price_slider_params.min_price)
            current_min_price = parseInt(zass_price_slider_params.min_price);
        if (zass_price_slider_params.max_price)
            current_max_price = parseInt(zass_price_slider_params.max_price);

        var body = $('body');

        body.bind('price_slider_create price_slider_slide', function (event, min, max) {
            if (zass_price_slider_params.currency_pos == "left") {

                $("span.from", "#zass_price_range").html(zass_price_slider_params.currency_symbol + min);
                $("span.to", "#zass_price_range").html(zass_price_slider_params.currency_symbol + max);

            } else if (zass_price_slider_params.currency_pos == "left_space") {

                $("span.from", "#zass_price_range").html(zass_price_slider_params.currency_symbol + " " + min);
                $("span.to", "#zass_price_range").html(zass_price_slider_params.currency_symbol + " " + max);

            } else if (zass_price_slider_params.currency_pos == "right") {

                $("span.from", "#zass_price_range").html(min + zass_price_slider_params.currency_symbol);
                $("span.to", "#zass_price_range").html(max + zass_price_slider_params.currency_symbol);

            } else if (zass_price_slider_params.currency_pos == "right_space") {

                $("span.from", "#zass_price_range").html(min + " " + zass_price_slider_params.currency_symbol);
                $("span.to", "#zass_price_range").html(max + " " + zass_price_slider_params.currency_symbol);

            }

            body.trigger('price_slider_updated', min, max);
        });

        $('div.price_slider', '#zass-price-filter-form').slider({
            range: true,
            min: min_price,
            max: max_price,
            values: [current_min_price, current_max_price],
            create: function (event, ui) {

                $("#min_price").val(current_min_price);
                $("#max_price").val(current_max_price);

                body.trigger('price_slider_create', [current_min_price, current_max_price]);
            },
            slide: function (event, ui) {

                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);

                body.trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
            },
            change: function (event, ui) {

                body.trigger('price_slider_change', [ui.values[0], ui.values[1]]);

            },
            stop: function (event, ui) {
            	$.zass_show_loader();

            	setTimeout(function () {
            		$('#zass-price-filter-form').trigger("submit");
            	}, 300);

            }
        });
    }
    /**************************
     * END "zass-price-slider"
     **************************/
})
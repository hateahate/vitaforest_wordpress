(function ($) {
    'use strict';

    $(document).ready(function (a) {

        if($("div").hasClass("product")){
            if($( "span" ).hasClass( "onsale" )){
                if ($('span.onsale').css('position') == 'absolute'){
                    if($( ".product div i" ).hasClass( "class-sale-price" )){
                        $(".product div i").css("left","74px");
                    }
                }
            }
        }

        $('#select-all').click(function (event) {
            if (this.checked) {
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });


        $('.webtoffee_wishlist_remove').click(function (e) {

            e.preventDefault();

            var product_id = $(this).data("product_id");
            var act = 'remove';
            var quantity = 1;
            $.ajax({
                url: webtoffee_wishlist_ajax_add.add_to_wishlist,
                type: 'POST',
                data: {
                    action: 'add_to_wishlist',
                    product_id: product_id,
                    act: act,
                    quantity: quantity,
                    wt_nonce: webtoffee_wishlist_ajax_add.wt_nonce,
                },
                success: function (response) {
                    location.reload(); //todo remove pageload and use ajax
                    //$(".wt-wishlist-button").addClass('webtoffee_wishlist');
                    //$(".wt-wishlist-button").removeClass('webtoffee_wishlist_remove');

                }
            });
        });


        $('.webtoffee_wishlist').click(function (e) {

            e.preventDefault();

            var product_id = $(this).data("product_id");
            var variation_id = $("input[name=variation_id]").val();
            //var act = $(this).data("act");
            var act = 'add';
            var quantity = $("input[name=quantity]").val();
            if(! quantity){
                quantity = 1;
            }

            $.ajax({
                url: webtoffee_wishlist_ajax_add.add_to_wishlist,
                type: 'POST',
                data: {
                    action: 'add_to_wishlist',
                    product_id: product_id,
                    variation_id: variation_id,
                    act: act,
                    quantity: quantity,
                    wt_nonce: webtoffee_wishlist_ajax_add.wt_nonce,
                },
                success: function (response) {
                    location.reload(); //todo remove pageload and use ajax
                    // $(".wt-wishlist-button").addClass('webtoffee_wishlist_remove');
                    // $(".wt-wishlist-button").removeClass('webtoffee_wishlist');
                },
            });
        });


        $('.remove_wishlist_single').click(function (e) {

            e.preventDefault();

            var product_id = $(this).data("product_id");
            var act = 'remove';
            var quantity = 1;
            $.ajax({
                url: webtoffee_wishlist_ajax_add.add_to_wishlist,
                type: 'POST',
                data: {
                    action: 'add_to_wishlist',
                    product_id: product_id,
                    act: act,
                    quantity: quantity,
                    wt_nonce: webtoffee_wishlist_ajax_add.wt_nonce,
                },
                success: function (response) {
                    location.reload(); //todo remove pageload and use ajax
                    //$(".wt-wishlist-button").addClass('webtoffee_wishlist');
                    //$(".wt-wishlist-button").removeClass('webtoffee_wishlist_remove');

                }
            });
        });


        $('#bulk-add-to-cart').click(function (e) {
            
            e.preventDefault();
            //var remove_wishlist = $("input[name=remove_wishlist]").val();
            var checked = [];
            $(".remove_wishlist_single").each(function () {
                if($(this).data("product_type")){
                    checked.push(parseInt($(this).data("variation_id")));
                }else{
                    checked.push(parseInt($(this).data("product_id")));
                }
            });
            $.ajax({
                url: webtoffee_wishlist_ajax_myaccount_bulk_add_to_cart.myaccount_bulk_add_to_cart,
                type: 'POST',
                data: {
                    action: 'myaccount_bulk_add_to_cart_action',
                    product_id: checked,
                    wt_nonce: webtoffee_wishlist_ajax_myaccount_bulk_add_to_cart.wt_nonce,

                },
                success: function (response) {
                    if($('.single-add-to-cart').data("redirect_to_cart")){
                        location.href = (response.redirect); 
                    }else{
                        var settings_div = $('<div class="eh_msg_div" style="background:#1de026; border:solid 1px #2bcc1c;">Products added to your cart</div>');				
                        save_settings(settings_div);
                    }
                }
            });
        });
        
        $('.single-add-to-cart').click(function (e) {
            e.preventDefault();
            
            var product_id = $(this).data("product_id");
            $.ajax({
                url: webtoffee_wishlist_ajax_single_add_to_cart.single_add_to_cart,
                type: 'POST',
                data: {
                    action: 'single_add_to_cart_action',
                    product_id: product_id,
                    wt_nonce: webtoffee_wishlist_ajax_single_add_to_cart.wt_nonce,

                },
                success: function (response) {
                    if($('.single-add-to-cart').data("redirect_to_cart")){
                        location.href = (response.redirect); 
                    }else{
                        var settings_div = $('<div class="eh_msg_div" style="background:#1de026; border:solid 1px #2bcc1c;">Product added to your cart</div>');				
                        save_settings(settings_div);
                    }
                }
            });
           
        });
        
    });

    var save_settings = function(settings_div)
        {
            $('body').append(settings_div);
            settings_div.stop(true,true).animate({'opacity':1,'top':'50px'},1000);
            setTimeout(function(){
                settings_div.animate({'opacity':0,'top':'100px'},1000,function(){
                    settings_div.remove();
                });
            },3000);
        }

})(jQuery);
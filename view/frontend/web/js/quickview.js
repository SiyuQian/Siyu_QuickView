define([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function ($, modal) {
    "use strict";
    return {
        displayContent: function(productUrl) {
            if (!productUrl.length) {
                return false;
            }
            $.ajax(
                {
                    type: 'GET',
                    url: productUrl,
                    success: function(data) { 
                        $('#js-quickview-popup').modal({
                            title: 'QuickView',
                            autoOpen: true,
                            responsive: true,
                            buttons: [{
                                text: 'close',
                                class: '.siyu-quickview',
                                click: function() {
                                    this.closeModal();
                                } //handler on button click
                            }]
                        });
                    } 
                }
            );
        }
    };

});
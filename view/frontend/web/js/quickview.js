define([
    'jquery',
    'tingle'
], function ($, tingle) {
    "use strict";

    return {
        displayContent: function(productUrl) {
            if (!productUrl.length) {
                return false;
            }
            var content = '';
            var modal = new tingle.modal({
                footer: true,
                stickyFooter: false,
                closeMethods: ['overlay', 'button', 'escape'],
                closeLabel: "Close",
                cssClass: ['quickview-popup'],
                onOpen: function() {
                    // console.log('modal open');
                },
                onClose: function() {
                    // console.log('modal closed');
                },
                beforeClose: function() {
                    // here's goes some logic
                    // e.g. save content before closing the modal
                    return true; // close the modal
                    return false; // nothing happens
                }
            });

            $.ajax(
                {
                    type: 'GET',
                    url: productUrl,
                    success: function(data) { 
                         // set content
                        modal.setContent(data);
                        // open modal
                        modal.open();
                    } 
                }
            );
        }
    };

});
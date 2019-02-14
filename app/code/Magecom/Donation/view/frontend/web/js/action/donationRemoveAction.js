define(
    [
        'jquery',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/storage',
        'Magento_Checkout/js/action/get-totals',
        'Magento_Checkout/js/model/totals'
    ],
    function ($, quote, urlBuilder, storage, getTotals, totals) {
        'use strict';

        return function (deferred, quoteId) {
            var serviceUrl;

            deferred = deferred || $.Deferred();

            serviceUrl = urlBuilder.createUrl('/delete-donation/:cartId', {
                cartId: quoteId
            });

            return storage.delete(
                serviceUrl, false
            ).done(
                function (response) {
                    if (response) {
                        totals.isLoading(true);
                        getTotals(deferred);
                        $.when(deferred).done(function () {
                            totals.isLoading(false);
                        });
                    }
                }
            ).fail(
                function (response) {}
            );
        };
    }
);

define(
    [
        'jquery',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/storage',
        'Magento_Checkout/js/action/get-totals',
        'Magento_Checkout/js/model/totals',
    ],
    function ($, quote, urlBuilder, storage, getTotals, totals) {
        'use strict';

        return function (deferred, donation, quoteId) {
            var serviceUrl;

            deferred = deferred || $.Deferred();

            serviceUrl = urlBuilder.createUrl('/set-donation/:donationCost/:cartId', {
                donationCost: donation,
                cartId: quoteId
            });

            return storage.put(
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

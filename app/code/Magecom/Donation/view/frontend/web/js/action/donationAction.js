define(
    [
        'jquery',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/storage',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/payment/method-converter',
        'Magento_Checkout/js/model/payment-service'
    ],
    function ($, quote, urlBuilder, storage, errorProcessor, customer, methodConverter, paymentService) {
        'use strict';

        return function (deferred, messageContainer) {
            var serviceUrl;

            deferred = deferred || $.Deferred();
            /**
             * Checkout for guest and registered customer.
             */
            serviceUrl = urlBuilder.createUrl('donation/:donation/set-donation-information', {
                donation: 'test'
            });

            return storage.get(
                serviceUrl, false
            ).done(
                function (response) {
                    quote.setTotals(response.totals);
                    paymentService.setPaymentMethods(methodConverter(response.payment_methods));
                    deferred.resolve();
                }
            ).fail(
                function (response) {
                    errorProcessor.process(response, messageContainer);
                    deferred.reject();
                }
            );
        };
    }
);

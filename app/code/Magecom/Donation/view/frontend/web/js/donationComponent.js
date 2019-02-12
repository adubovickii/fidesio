define(
    [
        'ko',
        'uiComponent',
        'jquery',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/action/get-payment-information',
    ],
    function(ko, Component, $, quote, getPaymentInformationAction) {
        'use strict';
        var checkoutConfig = window.checkoutConfig,
            donationConfig = checkoutConfig ? checkoutConfig.checkoutDonation : {};

        return Component.extend({
            /**
             * @return {exports.initObservable}
             */
            initObservable: function () {
                this._super()
                    .observe({
                        useDonationFlag: false,
                    });

                return this;
            },

            getEnabled : function () {
                return donationConfig.donationEnable;
            },

            isUseDonation : function () {
                return this.useDonationFlag();
            },

            getShortDescription : function () {
                return donationConfig.donationShortDescription;
            },

            getLongDescription : function () {
                return donationConfig.donationLongDescription;
            },

            getImage : function () {
                return donationConfig.donationImage;
            },

            getRates : function () {
                return _.values(donationConfig.donationRates);
            },

            setDonate :function (element, event) {
                if ($(event.target).length) {
                    let donation = $(event.target).prop('selected', true).val();
                    if (donation) {
                        let totals = quote.getTotals()();
                        totals.donation = donation;

                        quote.setTotals(totals);
                    }
                }
            }
        });
    }
);
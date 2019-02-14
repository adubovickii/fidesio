define(
    [
        'ko',
        'uiComponent',
        'jquery',
        'Magento_Checkout/js/model/quote',
        'Magecom_Donation/js/action/donationAction',
        'Magecom_Donation/js/action/donationRemoveAction',
        'Magento_Catalog/js/price-utils',
    ],
    function(ko, Component, $, quote, donationAction, donationRemoveAction, priceUtils) {
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

            /**
             * Get flag for check enable module or not.
             */
            getEnabled : function () {
                return donationConfig.donationEnable;
            },

            /**
             * Get short description form admin area.
             */
            getShortDescription : function () {
                return donationConfig.donationShortDescription;
            },

            /**
             * Get long description form admin area.
             */
            getLongDescription : function () {
                return donationConfig.donationLongDescription;
            },

            /**
             * Get image from admin area.
             */
            getImage : function () {
                return donationConfig.donationImage;
            },

            /**
             * Get rates from admin area.
             */
            getRates : function () {
                if (
                    typeof donationConfig.donationRates === 'object'
                    && !$.isEmptyObject(donationConfig.donationRates)
                ) {
                    return _.values(donationConfig.donationRates).filter(function (obj) {
                        return obj.rate_format_price = priceUtils.formatPrice(obj.rate_price, quote.getPriceFormat());
                    });
                }

                return false;
            },

            /**
             * Return checkbox value and check for delete donation.
             */
            isUseDonation : function () {
                if (!this.useDonationFlag()) {
                    this.deleteDonation();
                }

                return this.useDonationFlag();
            },

            /**
             * Set donate if customer chose rates.
             *
             * @param element
             * @param event
             */
            setDonate :function (element, event) {
                let quoteId = quote.getQuoteId();
                if ($(event.target).length && quoteId) {
                    let donation = $(event.target).prop('selected', true).val();
                    donationAction($.Deferred(), donation, quoteId);
                }
            },

            /**
             * Delete donation.
             */
            deleteDonation : function () {
                let quoteId = quote.getQuoteId();
                if (quoteId) {
                    donationRemoveAction($.Deferred(), quoteId);
                }
            }
        });
    }
);
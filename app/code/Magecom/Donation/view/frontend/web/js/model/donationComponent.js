/**
 * Magecom
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magecom.net so we can send you a copy immediately.
 *
 * @category Magecom
 * @package Magecom_Donation
 * @copyright Copyright (c) 2019 Magecom, Inc. (http://www.magecom.net)
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
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
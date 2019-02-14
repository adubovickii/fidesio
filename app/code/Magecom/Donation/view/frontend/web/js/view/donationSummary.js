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
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/totals'
    ],
    function (Component, quote, totals) {
        "use strict";
        return Component.extend({
            totals: quote.getTotals(),

            /**
             * Check for display donation on the sidebar.
             */
            isDisplayed: function() {
                return this.isFullMode() && this.getPureValue() != 0;
            },

            /**
             * Get value for totals segment.
             */
            getPureValue: function() {
                let amount = 0;
                if (this.totals()) {
                    let donation = totals.getSegment('donation').value;
                    if (donation) {
                        amount = donation;
                    }
                }
                return amount;
            },

            /**
             * Get formatted value for donation.
             */
            getValue: function() {
                return this.getFormattedPrice(this.getPureValue());
            }
        });
    }
);

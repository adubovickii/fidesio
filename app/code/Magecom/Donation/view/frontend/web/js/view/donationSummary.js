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

define(
    [
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote'
    ],
    function (Component, quote) {
        "use strict";
        return Component.extend({
            totals: quote.getTotals(),

            isDisplayed: function() {
                return this.isFullMode() && this.getPureValue() != 0;
            },

            getPureValue: function() {
                var price = 0;
                if (this.totals() && this.totals().donation) {
                    price = parseFloat(this.totals().donation);
                }
                return price;
            },

            getValue: function() {
                return this.getFormattedPrice(this.getPureValue());
            }
        });
    }
);

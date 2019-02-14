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

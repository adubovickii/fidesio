<?php
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

namespace Magecom\Donation\Plugin;

use Magecom\Donation\Model\DonationProvider;
use Magento\Framework\DataObject;
use Magento\Sales\Block\Order\Totals;

/**
 * Class Donation
 *
 * @category Magecom
 * @package Magecom_Donation
 * @author Magecom
 */
class Donation
{
    /**
     * @var DonationProvider
     */
    private $donationProvider;

    /**
     * Donation constructor.
     *
     * @param DonationProvider $donationProvider
     */
    public function __construct(
        DonationProvider $donationProvider
    )
    {
        $this->donationProvider = $donationProvider;
    }

    /**
     * Add new total for renderer to order_view and invoice_view.
     *
     * @param Totals $subject
     *
     * @param $result
     * @return mixed
     */
    public function beforeGetTotals(
        Totals $subject,
        $area = null
    )
    {
        if ($this->donationProvider->getEnableDonationModule() && !$subject->getTotal('donation')) {
            $order = $subject->getOrder();
            if ($order->getId() && $order->getDonation()) {
                $donationTotal = new DataObject([
                    'code' => 'donation',
                    'value' => $order->getDonation(),
                    'label' => __('Donation'),
                ]);

                $subject->addTotal($donationTotal);
            }
        }

        return [$area];
    }
}
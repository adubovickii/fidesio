<?php

namespace Magecom\Donation\Plugin;

use Magecom\Donation\Model\DonationProvider;
use Magento\Sales\Block\Order\Totals;

/**
 * Class Donation
 *
 * @package Magecom\Donation\Plugin
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
     * @param \Magento\Sales\Block\Order\Totals $subject
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
                $donationTotal = new \Magento\Framework\DataObject([
                    'code' => 'donation',
                    'strong' => true,
                    'value' => $order->getDonation(),
                    'label' => __('Donation'),
                    'area' => 'footer'
                ]);

                $subject->addTotal($donationTotal);
            }
        }

        return [$area];
    }
}
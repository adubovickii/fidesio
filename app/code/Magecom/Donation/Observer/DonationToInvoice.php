<?php

namespace Magecom\Donation\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class DonationToInvoice
 *
 * @package Magecom\Donation\Observer
 */
class DonationToInvoice implements ObserverInterface
{
    /**
     * Set donation to invoice.
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            $invoice = $observer->getEvent()->getInvoice();
            $order = $observer->getEvent()->getOrder();

            if ($invoice->getOrderId() && $order->getId()) {
                if ($order->getDonation() && !$invoice->getDonation()) {
                    $invoice->setDonation($order->getDonation());
                }
            }
        } catch (\Exception $exception){}
    }
}
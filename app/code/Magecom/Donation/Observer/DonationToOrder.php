<?php

namespace Magecom\Donation\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class DonationToOrder
 *
 * @package Magecom\Donation\Observer
 */
class DonationToOrder implements ObserverInterface
{
    /**
     * Set donation to order.
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            $quote = $observer->getEvent()->getQuote();
            $order = $observer->getEvent()->getOrder();

            if ($quote->getId() && $order->getIncrementId()) {
                if (!$order->getDonation() && $quote->getDonation()) {
                    $order->setDonation($quote->getDonation());
                }
            }
        } catch (\Exception $exception) {}
    }
}
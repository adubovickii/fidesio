<?php

namespace Magecom\Donation\Model\Quote\Address\Total;

use \Magento\Quote\Model\Quote;
use \Magento\Quote\Api\Data\ShippingAssignmentInterface;
use \Magento\Quote\Model\Quote\Address\Total;

/**
 * Class Donation
 *
 * @package Magecom\Donation\Model\Quote\Address\Total
 */
class Donation extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * Collect grand total address amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     *
     * @return $this
     */
    public function collect(
        Quote $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total
    ){
        if ($donation = $quote->getDonation()) {
            $total->addTotalAmount('donation', $donation);
        }

        return $this;
    }

    /**
     * Add grand total information to address
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     *
     * @return $this
     */
    public function fetch(Quote $quote, Total $total)
    {
        return [
            'code' => $this->getCode(),
            'title' => __('Donation'),
            'value' => $quote->getDonation(),
        ];
    }
}

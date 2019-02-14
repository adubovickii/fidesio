<?php

namespace Magecom\Donation\Api;

/**
 * Interface SaveDonationInformationInterface
 *
 * @package Magecom\Donation\Api
 */
interface DonationManagerInterface
{
    /**
     * Set donation to quote.
     *
     * @param string $donationCost
     * @param string $cartId
     *
     * @return mixed
     */
    public function set($donationCost, $cartId);

    /**
     * Remove donation from quote.
     *
     * @param string $cartId
     *
     * @return mixed
     */
    public function remove($cartId);
}
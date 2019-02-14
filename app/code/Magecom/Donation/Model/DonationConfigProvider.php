<?php

namespace Magecom\Donation\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magecom\Donation\Model\DonationProvider;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DonationConfigProvider
 *
 * @package Magecom\Donation\Model
 */
class DonationConfigProvider implements ConfigProviderInterface
{
    /**
     * @var DonationProvider
     */
    protected $donationProvider;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * DonationConfigProvider constructor.
     *
     * @param DonationProvider $donationProvider
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        DonationProvider $donationProvider,
        StoreManagerInterface $storeManager
    ) {
        $this->donationProvider = $donationProvider;
        $this->storeManager = $storeManager;
    }

    /**
     * Get donation config.
     *
     * @return array
     */
    public function getConfig()
    {
        $donationConfig['checkoutDonation'] = ['donationEnable' => false];
        if (is_array($this->getDonationConfig()) && count($this->getDonationConfig())) {
            $donationConfig['checkoutDonation'] = $this->getDonationConfig();
        }

        return $donationConfig;
    }

    /**
     * Returns donations config
     *
     * @return array
     */
    protected function getDonationConfig()
    {
        $donationConfiguration = [];

        if ($this->donationProvider->getEnableDonationModule()) {
            $donationConfiguration = [
                'donationEnable' => $this->donationProvider->getEnableDonationModule(),
                'donationImage' => $this->donationProvider->getDonationImage(),
                'donationShortDescription' => $this->donationProvider->getDonationShortDescription(),
                'donationLongDescription' => $this->donationProvider->getDonationLongDescription(),
                'donationRates' => unserialize($this->donationProvider->getDonationRates()),
            ];
        }

        return $donationConfiguration;
    }
}

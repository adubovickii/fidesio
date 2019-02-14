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

namespace Magecom\Donation\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magecom\Donation\Model\DonationProvider;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DonationConfigProvider
 *
 * @category Magecom
 * @package Magecom_Donation
 * @author Magecom
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
                'donationShortDescription' => $this->donationProvider->getDonationShortDescription(),
                'donationRates' => unserialize($this->donationProvider->getDonationRates()),
            ];
        }

        return $donationConfiguration;
    }
}

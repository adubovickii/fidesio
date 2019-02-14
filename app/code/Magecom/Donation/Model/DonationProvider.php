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

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;


/**
 * Class DonationProvider
 *
 * @category Magecom
 * @package Magecom_Donation
 * @author Magecom
 */
class DonationProvider
{
    /**
     * Path to config enable donation module.
     */
    const PATH_ENABLED_DONATION = 'magecom_donation/general/enable_magecom_donation';

    /**
     * Path to config short text for donation module.
     */
    const PATH_SHORT_DESCRIPTION_DONATION = 'magecom_donation/general/magecom_short_text_donation';

    /**
     * Path to config rates for donation module.
     */
    const PATH_RATES_DONATION = 'magecom_donation/general/magecom_rates_donation';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * DonationProvider constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * Get enable value for donation module.
     *
     * @return mixed
     */
    public function getEnableDonationModule()
    {
        return $this->scopeConfig->getValue(
            self::PATH_ENABLED_DONATION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get donation short description.
     *
     * @return mixed
     */
    public function getDonationShortDescription()
    {
        return $this->scopeConfig->getValue(
            self::PATH_SHORT_DESCRIPTION_DONATION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get donation rates.
     *
     * @return mixed
     */
    public function getDonationRates()
    {
        return $this->scopeConfig->getValue(
            self::PATH_RATES_DONATION,
            ScopeInterface::SCOPE_STORE
        );
    }
}

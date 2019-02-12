<?php

namespace Magecom\Donation\Model;

use Magento\Store\Model\ScopeInterface;

/**
 * Class DonationProvider
 *
 * @package Magecom\Donation\Model
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
     * Path to config long text for donation module.
     */
    const PATH_LONG_DESCRIPTION_DONATION = 'magecom_donation/general/magecom_long_text_donation';

    /**
     * Path to config image for donation module.
     */
    const PATH_IMAGE_DONATION = 'magecom_donation/general/magecom_image_donation';

    /**
     * Path to config rates for donation module.
     */
    const PATH_RATES_DONATION = 'magecom_donation/general/magecom_rates_donation';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * DonationProvider constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get enable value for donation module.
     *
     * @return mixed
     */
    public function getEnableDonationModule()
    {
        return $this->scopeConfig->getValue(self::PATH_ENABLED_DONATION, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get donation short description.
     *
     * @return mixed
     */
    public function getDonationShortDescription()
    {
        return $this->scopeConfig->getValue(self::PATH_SHORT_DESCRIPTION_DONATION, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get donation long description.
     *
     * @return mixed
     */
    public function getDonationLongDescription()
    {
        return $this->scopeConfig->getValue(self::PATH_LONG_DESCRIPTION_DONATION, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get donation image.
     *
     * @return mixed
     */
    public function getDonationImage()
    {
        return $this->scopeConfig->getValue(self::PATH_IMAGE_DONATION, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get donation rates.
     *
     * @return mixed
     */
    public function getDonationRates()
    {
        return $this->scopeConfig->getValue(self::PATH_RATES_DONATION, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check all configuration for donation module.
     *
     * @return bool
     */
    public function checkAllConfiguration()
    {
        if (
            $this->getEnableDonationModule()
            && $this->getDonationShortDescription()
            && $this->getDonationLongDescription()
            && $this->getDonationImage()
            && $this->getDonationRates()
        ) {
            return true;
        }

        return false;
    }
}

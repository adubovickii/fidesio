<?php

namespace Magecom\Donation\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

/**
 * Class AgreementsConfigProvider
 *
 * @package Magecom\Donation\Model
 */
class DonationConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfiguration;

    /**
     * @var \Magecom\Donation\Model\DonationProvider
     */
    protected $donationProvider;


    protected $storeManager;

    /**
     * AgreementsConfigProvider constructor.
     *
     * @param DonationProvider $donationProvider
     */
    public function __construct(
        \Magecom\Donation\Model\DonationProvider $donationProvider,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->donationProvider = $donationProvider;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $agreements = [];
        $agreements['checkoutDonation'] = $this->getDonationConfig();
        return $agreements;
    }

    /**
     * Returns donations config
     *
     * @return array
     */
    protected function getDonationConfig()
    {
        $donationConfiguration = [];

        if ($this->donationProvider->checkAllConfiguration()) {
            $donationConfiguration = [
                'donationEnable' => $this->donationProvider->getEnableDonationModule(),
                'donationImage' => $this->getUrlForImage($this->donationProvider->getDonationImage()),
                'donationShortDescription' => $this->donationProvider->getDonationShortDescription(),
                'donationLongDescription' => $this->donationProvider->getDonationLongDescription(),
                'donationRates' => unserialize($this->donationProvider->getDonationRates()),
            ];
        }

        return $donationConfiguration;
    }

    public function getUrlForImage($imagePath)
    {

        if (isset($imagePath) && is_string($imagePath)) {
            $mediaUrl = $this ->storeManager-> getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            );

           return sprintf('%s%s',$mediaUrl, $imagePath);
        }

        return false;
    }
}

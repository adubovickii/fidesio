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

namespace Magecom\Donation\Block\Adminhtml\Form\Field;

use Magento\Config\Model\Config\Backend\Serialized;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class RatesSerialized
 *
 * @category Magecom
 * @package Magecom_Donation
 * @author Magecom
 */
class RatesSerialized extends Serialized
{
    /**
     * Validate data before save.
     *
     * @return Serialized|void
     * @throws NoSuchEntityException
     */
    public function beforeSave()
    {
        if (!empty($this->getValue()) && is_array($this->getValue())) {
            $values = $this->getValue();
            $this->convertRatePriceToFloat($values);
            if (array_key_exists('__empty', $values)) {
                unset($values['__empty']);
            }
            $this->setValue(serialize($values));
        }
    }

    /**
     * Convert price to float.
     *
     * @param array $values
     */
    private function convertRatePriceToFloat(array &$values)
    {
        foreach ($values as $key => $value) {
            if (is_array($value) && array_key_exists('rate_price', $value)) {
                $ratePrice = $value['rate_price'];
                $values[$key]['rate_price'] = (float)$ratePrice;
            }
        }
    }
}

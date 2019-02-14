<?php

namespace Magecom\Donation\Block\Adminhtml\Form\Field;

use Magento\Config\Model\Config\Backend\Serialized;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class RatesSerialized
 *
 * @package Magecom\Donation\Block\Adminhtml\Form\Field
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

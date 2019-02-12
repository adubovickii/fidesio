<?php

namespace Magecom\Donation\Block\Adminhtml\Form\Field;

use Magento\Config\Model\Config\Backend\Serialized;

/**
 * Class RatesSerialized
 *
 * @package Magecom\Donation\Block\Adminhtml\Form\Field
 */
class RatesSerialized extends Serialized
{
    /**
     * @return $this
     */
    public function beforeSave()
    {
        if (!empty($this->getValue()) && is_array($this->getValue())) {
            $value = $this->getValue();
            if (array_key_exists('__empty', $value)) {
                unset($value['__empty']);
            }
            $this->setValue(serialize($value));
        }
    }
}

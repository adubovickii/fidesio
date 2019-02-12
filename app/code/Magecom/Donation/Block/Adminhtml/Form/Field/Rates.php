<?php

namespace Magecom\Donation\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Setup\Exception;


/**
 * Class Rates
 */
class Rates extends AbstractFieldArray
{
    /**
     * Prepare to render.
     *
     * @throws \Exception
     */
    protected function _prepareToRender()
    {
        $this->addColumn(
            'rate_price',
            [
                'label' => __('Rate'),
                'class' => 'required-entry validate-number',
            ]
        );

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Rate');
    }
}
<?php

namespace Magecom\Donation\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 *
 * @package Magecom\Donation\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        /**
         * Prepare database for install
         */
        $installer->startSetup();

        /**
         * Update table 'sales_order'
         */
        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'donation',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                'length' => '12,4',
                'nullable' => true,
                'comment' => 'Donation'
            ]
        );

        /**
         * Update table 'sales_invoice'
         */
        $setup->getConnection()->addColumn(
            $setup->getTable('sales_invoice'),
            'donation',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                'length' => '12,4',
                'nullable' => true,
                'comment' => 'Donation'
            ]
        );

        /**
         * Update table 'quote'
         */
        $setup->getConnection()->addColumn(
            $setup->getTable('quote'),
            'donation',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                'length' => '12,4',
                'nullable' => true,
                'comment' => 'Donation'
            ]
        );

        /**
         * Prepare database after install
         */
        $installer->endSetup();

    }
}

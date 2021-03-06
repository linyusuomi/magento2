<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Bundle\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $connection = $setup->getConnection();
        if (version_compare($context->getVersion(), '2.0.1', '<')) {
            $fields = [
                ['table' => 'catalog_product_index_price_bundle_opt_idx', 'column' => 'alt_group_price'],
                ['table' => 'catalog_product_index_price_bundle_opt_tmp', 'column' => 'alt_group_price'],
                ['table' => 'catalog_product_index_price_bundle_idx', 'column' => 'base_group_price'],
                ['table' => 'catalog_product_index_price_bundle_tmp', 'column' => 'base_group_price'],
                ['table' => 'catalog_product_index_price_bundle_idx', 'column' => 'group_price'],
                ['table' => 'catalog_product_index_price_bundle_opt_idx', 'column' => 'group_price'],
                ['table' => 'catalog_product_index_price_bundle_opt_tmp', 'column' => 'group_price'],
                ['table' => 'catalog_product_index_price_bundle_sel_idx', 'column' => 'group_price'],
                ['table' => 'catalog_product_index_price_bundle_sel_tmp', 'column' => 'group_price'],
                ['table' => 'catalog_product_index_price_bundle_tmp', 'column' => 'group_price'],
                ['table' => 'catalog_product_index_price_bundle_idx', 'column' => 'group_price_percent'],
                ['table' => 'catalog_product_index_price_bundle_tmp', 'column' => 'group_price_percent'],
            ];

            foreach ($fields as $filedInfo) {
                $connection->dropColumn($setup->getTable($filedInfo['table']), $filedInfo['column']);
            }
        }

        if (version_compare($context->getVersion(), '2.0.3', '<')) {
            $tables = [
                'catalog_product_index_price_bundle_idx',
                'catalog_product_index_price_bundle_opt_idx',
                'catalog_product_index_price_bundle_opt_tmp',
                'catalog_product_index_price_bundle_sel_idx',
                'catalog_product_index_price_bundle_sel_tmp',
                'catalog_product_index_price_bundle_tmp',
            ];
            foreach ($tables as $table) {
                $setup->getConnection()->modifyColumn(
                    $setup->getTable($table),
                    'customer_group_id',
                    ['type' => 'integer', 'nullable' => false]
                );
            }
        }

        $setup->endSetup();
    }
}

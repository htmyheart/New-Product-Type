<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Funext\ProductType\Setup;

use Funext\ProductType\Model\Product\Type\Simple as FunProduct;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var \Magento\Eav\Model\Entity\Type
     */
    protected $_entityTypeModel;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        \Magento\Eav\Model\Entity\Type $entityType
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->_entityTypeModel = $entityType;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $attributes = [
            'msrp',
            'msrp_display_actual_price_type',
            'price',
            'special_price',
            'minimal_price',
            'special_from_date',
            'special_to_date',
            'tier_price',
            'weight',
            'color',
            'thumbnail'
        ];
        foreach ($attributes as $attributeCode) {
            $applyTo = explode(
                ',',
                $eavSetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $attributeCode, 'apply_to')
            );
            if (!in_array(FunProduct::TYPE_CODE, $applyTo)) {
                $applyTo[] = FunProduct::TYPE_CODE;
                $eavSetup->updateAttribute(
                    \Magento\Catalog\Model\Product::ENTITY,
                    $attributeCode,
                    'apply_to',
                    implode(',', $applyTo)
                );
            }
        }



        /*
         * Remove old attributes
         * */
        $fieldList = [
            'field_1',
            'field_2',
            'field_3',
            'field_4',
        ];

        foreach ($fieldList as $field) {
            $eavSetup->removeAttribute(
                $this->_entityTypeModel->loadByCode('catalog_product')->getData('entity_type_id'),
                $field
            );
        }

        /**
         * Add attributes to the eav/attribute
         */
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'field_1',
            [
                'group' => 'New Product Fields',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Field 1',
                'input' => 'select',
                'class' => '',
                'source' => 'Funext\ProductType\Model\Product\Attribute\Source\Field1',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'funproduct'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'field_2',
            [
                'group' => 'New Product Fields',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Field 2',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'funproduct'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'field_3',
            [
                'group' => 'New Product Fields',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Field 3',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'funproduct'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'field_4',
            [
                'group' => 'New Product Fields',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Field 4',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'funproduct'
            ]
        );

    }
}

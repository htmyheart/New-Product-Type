<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Funext\ProductType\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Framework\Stdlib\ArrayManager;

/**
 * Customize Weight field
 */
class BundleWeight extends AbstractModifier
{
    const CODE_WEIGHT_TYPE = 'field_1';

    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    /**
     * @param ArrayManager $arrayManager
     */
    public function __construct(ArrayManager $arrayManager)
    {
        $this->arrayManager = $arrayManager;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {

        $meta = $this->arrayManager->merge(
            $this->arrayManager->findPath(static::CODE_WEIGHT_TYPE, $meta, null, 'children') . static::META_CONFIG_PATH,
            $meta,
            [
                'valueMap' => [
                    'false' => '1',
                    'true' => '0'
                ],
                'validation' => [
                    'required-entry' => false
                ]
            ]
        );

        $meta = $this->arrayManager->merge(
            $this->arrayManager->findPath(
                ProductAttributeInterface::CODE_HAS_WEIGHT,
                $meta,
                null,
                'children'
            ) . static::META_CONFIG_PATH,
            $meta,
            [
                'disabled' => true,
                'visible' => false
            ]
        );

        $meta = $this->arrayManager->merge(
            $this->arrayManager->findPath(
                ProductAttributeInterface::CODE_WEIGHT,
                $meta,
                null,
                'children'
            ) . static::META_CONFIG_PATH,
            $meta,
            [
                'imports' => [
                    'disabled' => 'ns = ${ $.ns }, index = ' . static::CODE_WEIGHT_TYPE . ':checked',
                ]
            ]
        );
        
        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }

}

<?php
namespace Funext\ProductType\Ui\Component\Form;


use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Ui\Component\Form\FieldFactory;
use Magento\Ui\Component\Form\Fieldset as BaseFieldset;

class Fieldset extends BaseFieldset
{
    /**
     * @var FieldFactory
     */
    private $fieldFactory;

    public function __construct(
        ContextInterface $context,
        array $components = [],
        array $data = [],
        FieldFactory $fieldFactory)
    {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
    }

    /**
     * Produce and return block's html output
     *
     * @return string
     */
    public function toHtml()
    {
        return '123123123123123';
    }

//    /**
//     * @param string $name
//     * @return UiComponentInterface
//     */
//    public function getComponent($name)
//    {
//
//        $this->xlog($name);
//        return parent::getComponent($name);
//    }

    /**
     * Generate content to log file debug.log By Hattetek.Com
     *
     * @param  $message string|array
     * @return void
     */
    function xlog($message = 'null')
    {
        $log = print_r($message, true);
        \Magento\Framework\App\ObjectManager::getInstance()
            ->get('Psr\Log\LoggerInterface')
            ->debug($log);
    }

    /**
     * Get components
     *
     * @return UiComponentInterface[]
     */
    public function getChildComponents()
    {
        $fields = [
            [
                'label' => __('Field Label From Code'),
                'value' => __('Field Value From Code'),
                'formElement' => 'input',
                'name' => 'field_0'
            ],
            [
                'label' => __('Another Field Label From Code'),
                'value' => __('Another Field Value From Code'),
                'formElement' => 'input',
                'name' => 'field_1'
            ],
            [
                'label' => __('Yet Another Field Label From Code'),
                'value' => __('Yet Another Field Value From Code'),
                'formElement' => 'input',
                'dataScope' => 'data.product.field_100',
                'name' => 'field_100',
                'imports' => [
                    'toggleDisable' => '${ $.parentName}.field_1:value'
                ],
                'valuesForEnable' => [
                    '1' => '1'
                ]
            ]
        ];

        foreach ($fields as $k => $fieldConfig) {

            $fieldInstance = $this->fieldFactory->create();
            $name = 'data.product.' . $fieldConfig['name'];

            $fieldInstance->setData(
                [
                    'config' => $fieldConfig,
                    'dataScope' => $name
                ]
            );

            $fieldInstance->prepare();
            $this->addComponent($name, $fieldInstance);
        }

        return parent::getChildComponents();
    }

}

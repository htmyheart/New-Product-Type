<?php
namespace Funext\ProductType\Block\Adminhtml\Product\Edit\Tabs;

class Plugin
{
    /*
     * Tabs list to ignore
     *
     * @var array
     * */
    protected $ignoredTabs = [];

    /*
     * Tabs list to update
     *
     * @var array
     * */
    protected $updatedTabs = [];

    /*
     * @param array $ignoredTabs
     * @param array $updatedTabs
     * */
    public function __construct($ignoredTabs = [], $updatedTabs = [])
    {
        $this->ignoredTabs = $ignoredTabs;
        $this->updatedTabs = $updatedTabs;
    }

    public function aroundAddTab(
        \Magento\Catalog\Block\Adminhtml\Product\Edit\Tabs $subject,
        \Closure $process,
        $tabId,
        $tab
    ) {
        if ($subject->getProduct()->getTypeId() == \Funext\ProductType\Model\Product\Type\Simple::TYPE_CODE){
            if(in_array($tabId, $this->ignoredTabs)) {
                return $subject;
            }

            if(isset($this->updatedTabs[$tabId]) && is_array($tab)){
                $tab = array_merge($tab, $this->updatedTabs[$tabId]);
            }
        }

        return $process($tabId, $tab);
    }

}
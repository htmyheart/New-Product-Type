<?php

namespace Funext\Session\Helper;

class Data  extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_checkoutSession;
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession
    ){
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($context);
    }
    public function getCheckoutData()
    {
        return $this->_checkoutSession->getData();
    }
}
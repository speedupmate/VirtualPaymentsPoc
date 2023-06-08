<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Speedupmate\VirtualPaymentsPoc\Model\Payment;

class VirtualOptions extends \Magento\Payment\Model\Method\AbstractMethod
{
    public const CODE = "virtualoptions";
    protected $_code = self::CODE;
    protected $_isOffline = true;

    public function isAvailable(
        \Magento\Quote\Api\Data\CartInterface $quote = null
    ) {
        return parent::isAvailable($quote);
    }

    public function setCode($code) {
        $this->_code = $code;
    }

    public function getCode()
    {

        $code = parent::getCode();

        if($this->getVirtualCode()){
            $code = $this->getVirtualCode();
        }

        return $code;
    }

    public function isActive($storeId = null) {
        $active = parent::isActive($storeId);

        if($this->getVirtualCode()){
            $active = true;
        }

        return $active;
    }

    public function getTitle() {
        return 'title for: ' . $this->getCode();
    }
}


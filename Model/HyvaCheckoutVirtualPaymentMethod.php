<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Speedupmate\VirtualPaymentsPoc\Model;

class HyvaCheckoutVirtualPaymentMethod implements \Hyva\Checkout\Model\VirtualPaymentMethodInterface
{
    /**
     * @return array
     */
    public function getVirtualPaymentMethods(): array
    {
        return ['virt1'=>['title'=>'title for virt1'],'virt2'=>[],'virt3'=>[]];
    }

    /**
     * @param $methodInstance
     * @param string $qualifier
     */
    public function setPaymentData($methodInstance, string $qualifier): void
    {
        //@TODO not sure if we can set this data without it seeking the same data from config values
    }
}

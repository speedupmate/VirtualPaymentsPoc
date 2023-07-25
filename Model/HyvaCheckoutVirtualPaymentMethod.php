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
        return [
                    'virt1' => ['title'=>'title for virt1'],
                    'virt2' => ['title'=>'title for virt3'],
                    'virt3' => ['title'=>'title for virt3']
                ];
    }

    /**
     * @param string $key
     * @param string $paymentMethod
     * @param string $virtualMethod
     * @return array
     */
    public function getVirtualPaymentData(string $key, string $paymentMethod, string $virtualMethod): array
    {
        $virtualMethods = $this->getVirtualPaymentMethods();

        if (isset($virtualMethods[$virtualMethod][$key])) {
            return [$virtualMethods[$virtualMethod][$key]];
        }
        return [];
    }
}

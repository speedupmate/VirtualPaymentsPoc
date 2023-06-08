<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Speedupmate\VirtualPaymentsPoc\Plugin\Magento\Payment\Helper;

class Data
{
    public const METHODS = ['virt1','virt2','virt3'];

    /**
     *
     * @var $result
     */
    protected $result = false;
    protected $methodFactory;
    protected $scopeConfig;
    protected $config = false;

    /**
     *
     * @param \Magento\Payment\Model\Method\Factory $paymentMethodFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Payment\Model\Method\Factory $paymentMethodFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
    ) {
        $this->methodFactory = $paymentMethodFactory;
        $this->scopeConfig = $scopeConfig;
    }

    public function afterGetPaymentMethods(
        \Magento\Payment\Helper\Data $subject,
        $result
    ) {

        if(!empty($result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE])) {
            foreach($this->getVirtMethods() as $method) {
                $result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE . '-'.$method] = $result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE];
                if(isset($result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE . '-'.$method]['title'])) {
                    $result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE . '-'.$method]['title'] = $result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE]['title'] .'-'.$method;
                }
            }
        }

        return $result;
    }

    public function afterGetPaymentMethodList(
        \Magento\Payment\Helper\Data $subject,
        $result,
        $sorted = true,
        $asLabelValue = false,
        $withGroups = false,
        $store = null
    ) {
        if(!empty($result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE])) {
            foreach($this->getVirtMethods() as $method) {
                $result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE . '-'.$method] = $result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE];

                if(isset($result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE . '-'.$method]['title'])) {
                    $result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE . '-'.$method]['title'] = $result[\Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE]['title'] .'-'.$method;
                }
            }
        }

        return $result;
    }

    public function aroundGetMethodInstance(
        \Magento\Payment\Helper\Data $subject,
        \Closure $proceed,
        $code
    ) {

        //if the code is within our virtual codes
        //map the code to our general class and set the virtualCode instead
        if (strstr($code, \Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE.'-')) {
            $realCode = \Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE;
            $class = $this->scopeConfig->getValue(
                $this->getMethodModelConfigName($realCode, $subject),
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $result = $this->methodFactory->create($class, ['code' => $code]);
            $result->setVirtualCode($code);

        } else {
            //go for defaults
            $result = $proceed($code);
        }

        return $result;
    }

    /**
     * Get config name of method model
     *
     * @param string $code
     * @param \Magento\Payment\Helper\Data $scope
     * @return string
     */
    protected function getMethodModelConfigName($code, $scope)
    {
        //we would need to map to original code here too
        //we just needed this to make our life easier
        return sprintf('%s/%s/model', $scope::XML_PATH_PAYMENT_METHODS, $code);
    }

    protected function getVirtMethods() {
        return self::METHODS;
    }
}


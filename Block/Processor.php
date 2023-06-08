<?php
/**
 * {{COPYRIGHT_NOTICE}}
 */

declare(strict_types=1);

namespace Speedupmate\VirtualPaymentsPoc\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Speedupmate\VirtualPaymentsPoc\Plugin\Magento\Payment\Helper\Data;

/**
 * {@inheritdoc}
 */
class Processor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;


    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Helper
     */
    protected $helper;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param Helper $helper
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        Data $helper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
    }

    /**
     * @inheritdoc
     */
    public function process($jsLayout)
    {

        $methodCode = \Speedupmate\VirtualPaymentsPoc\Model\Payment\VirtualOptions::CODE;

        $layoutPath = $jsLayout['components']['checkout']
            ['children']['steps']
            ['children']['billing-step']
            ['children']['payment']
            ['children']['renders']
            ['children'] ?? false;

        if ($layoutPath) {
            $paymentMethods = [];

            $layoutPath[$methodCode]['cnf']['methodCode'] = $methodCode;

            foreach ($this->helper::METHODS as $data) {
                $subMethodCode = $methodCode. '-' .$data;
                $paymentMethods[$subMethodCode] = $layoutPath[$methodCode];
                $paymentMethods[$subMethodCode]['cnf']['methodCode'] = $subMethodCode;
            }
            $paymentMethods = array_merge($layoutPath, $paymentMethods);

            $jsLayout['components']['checkout']
                ['children']['steps']
                ['children']['billing-step']
                ['children']['payment']
                ['children']['renders']
                ['children'] = $paymentMethods;
        }
        /*print_r($this->helper::METHODS);
        print_r($jsLayout['components']['checkout']
        ['children']['steps']
        ['children']['billing-step']
        ['children']['payment']
        ['children']['renders']
        ['children']);
        exit();*/
        return $jsLayout;
    }
}
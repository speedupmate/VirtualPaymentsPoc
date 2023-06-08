# Mage2 Module Speedupmate VirtualPaymentsPoc

    ``speedupmate/module-virtualpaymentspoc``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
proof of concept virtual payment methods

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Speedupmate`
 - Enable the module by running `php bin/magento module:enable Speedupmate_VirtualPaymentsPoc`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require speedupmate/module-virtualpaymentspoc`
 - enable the module by running `php bin/magento module:enable Speedupmate_VirtualPaymentsPoc`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - VirtualOptions - payment/virtualoptions/*


## Specifications

 - Payment Method
	- VirtualOptions

 - Plugin
	- afterGetPaymentMethods - Magento\Payment\Helper\Data > Speedupmate\VirtualPaymentsPoc\Plugin\Magento\Payment\Helper\Data

 - Plugin
	- afterGetPaymentMethodList - Magento\Payment\Helper\Data > Speedupmate\VirtualPaymentsPoc\Plugin\Magento\Payment\Helper\Data

 - Plugin
	- aroundGetMethodInstance - Magento\Payment\Helper\Data > Speedupmate\VirtualPaymentsPoc\Plugin\Magento\Payment\Helper\Data


## Attributes




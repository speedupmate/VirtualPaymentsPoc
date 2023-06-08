define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        return Component.extend({
            initialize: function() {
                this._super();
                rendererList.push(
                    {
                        type: this.cnf.methodCode,
                        component: 'Speedupmate_VirtualPaymentsPoc/js/view/payment/method-renderer/virtualoptions-method',
                        config: {
                            "methodCnf" : this.cnf
                        }
                    }
                );
            }
        });
    }
);
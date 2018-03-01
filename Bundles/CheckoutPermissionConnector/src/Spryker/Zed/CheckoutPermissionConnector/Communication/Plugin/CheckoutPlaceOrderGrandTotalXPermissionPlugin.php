<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CheckoutPermissionConnector\Communication\Plugin;

use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreConditionInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Permission\Communication\Plugin\ExecutablePermissionPluginInterface;

/**
 * @example
 *
 * @method \Spryker\Zed\CheckoutPermissionConnector\Communication\CheckoutPermissionCommunicationFactory getFactory()
 */
class CheckoutPlaceOrderGrandTotalXPermissionPlugin extends AbstractPlugin implements CheckoutPreConditionInterface, ExecutablePermissionPluginInterface
{
    const CONFIG_FIELD_AMOUNT = 'CONFIG_FIELD_AMOUNT';

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return bool
     */
    public function checkCondition(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer)
    {
        $can = $this->getFactory()->getPermissionFacade()->can(
            $this->getKey(),
            $quoteTransfer->getCustomer()->getIdCustomer(),
            $quoteTransfer->getTotals()->getGrandTotal()
        );

        if ($can) {
            return true;
        }

        $this->addErrorToCheckoutResponse($checkoutResponseTransfer);
        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return void
     */
    protected function addErrorToCheckoutResponse(CheckoutResponseTransfer $checkoutResponseTransfer)
    {
        $checkoutErrorTransfer = (new CheckoutErrorTransfer())
            ->setMessage('Access denied')
            ->setErrorCode(403);

        $checkoutResponseTransfer
            ->addError($checkoutErrorTransfer);
    }

    /**
     * @param array $configuration
     * @param int|null $amount
     *
     * @return bool
     */
    public function can(array $configuration, $amount = null)
    {
        if ($amount === null) {
            return false;
        }

        if ($amount > $configuration[static::CONFIG_FIELD_AMOUNT]) {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getConfigurationSignature()
    {
        return [
            static::CONFIG_FIELD_AMOUNT => ExecutablePermissionPluginInterface::CONFIG_FIELD_TYPE_INT,
        ];
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return 'permission.allow.checkout.placeOrder.grandTotalX';
    }
}
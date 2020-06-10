<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantOmsGui\Communication\Plugin\Sales;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderItemsTableExpanderPluginInterface;

/**
 * @method \Spryker\Zed\MerchantOmsGui\Communication\MerchantOmsGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\MerchantOmsGui\MerchantOmsGuiConfig getConfig()
 */
class MerchantOmsStateOrderItemsTableExpanderPlugin extends AbstractPlugin implements OrderItemsTableExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getColumnName(): string
    {
        return 'Merchant State';
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return string
     */
    public function getColumnCellContent(ItemTransfer $itemTransfer): string
    {
        $stateMachineItemTransfer = $this->getFactory()
            ->getMerchantOmsFacade()
            ->findCurrentState($itemTransfer->getIdSalesOrderItem());

        return $stateMachineItemTransfer ? $stateMachineItemTransfer->getStateName() : '';
    }
}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ShoppingListProductOptionConnector\Communication\Plugin\ProductOption;

use Generated\Shared\Transfer\ProductOptionGroupTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductOptionExtension\Dependency\Plugin\ProductOptionValuesPreRemovePluginInterface;

/**
 * @method \Spryker\Zed\ShoppingListProductOptionConnector\Business\ShoppingListProductOptionConnectorFacadeInterface getFacade()
 * @method \Spryker\Zed\ShoppingListProductOptionConnector\ShoppingListProductOptionConnectorConfig getConfig()
 */
class ShoppingListItemsProductOptionValuesPreRemovePlugin extends AbstractPlugin implements ProductOptionValuesPreRemovePluginInterface
{
    /**
     * {@inheritdoc}
     * - Removes deleted product option values from shopping list items.
     * - Deleted product option values are marked in ProductOptionGroupTransfer::productOptionValuesToBeRemoved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductOptionGroupTransfer $productOptionGroupTransfer
     *
     * @return void
     */
    public function preRemove(ProductOptionGroupTransfer $productOptionGroupTransfer): void
    {
        $this->getFacade()
            ->removeProductOptionValuesFromShoppingListItems($productOptionGroupTransfer);
    }
}

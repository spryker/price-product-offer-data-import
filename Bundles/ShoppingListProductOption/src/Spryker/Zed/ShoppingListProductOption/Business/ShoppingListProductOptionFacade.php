<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ShoppingListProductOption\Business;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProductOptionCollectionTransfer;
use Generated\Shared\Transfer\ShoppingListItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\ShoppingListProductOption\Business\ShoppingListProductOptionBusinessFactory getFactory()
 * @method \Spryker\Zed\ShoppingListProductOption\Persistence\ShoppingListProductOptionRepositoryInterface getRepository()
 * @method \Spryker\Zed\ShoppingListProductOption\Persistence\ShoppingListProductOptionEntityManagerInterface getEntityManager()
 */
class ShoppingListProductOptionFacade extends AbstractFacade implements ShoppingListProductOptionFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ShoppingListItemTransfer $shoppingListItemTransfer
     *
     * @return void
     */
    public function saveShoppingListItemProductOption(ShoppingListItemTransfer $shoppingListItemTransfer): void
    {
        $this->getFactory()
            ->createShoppingListProductOptionWriter()
            ->saveShoppingListItemProductOption($shoppingListItemTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idShoppingListItem
     *
     * @return \Generated\Shared\Transfer\ProductOptionCollectionTransfer
     */
    public function getShoppingListItemProductOptionsByIdShoppingListItem(int $idShoppingListItem): ProductOptionCollectionTransfer
    {
        return $this->getFactory()
            ->createShoppingListItemProductOptionReader()
            ->getShoppingListItemProductOptionsByIdShoppingListItem($idShoppingListItem);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ShoppingListItemTransfer $shoppingListItemTransfer
     *
     * @return \Generated\Shared\Transfer\ShoppingListItemTransfer
     */
    public function expandItem(ShoppingListItemTransfer $shoppingListItemTransfer): ShoppingListItemTransfer
    {
        return $this->getFactory()
            ->createShoppingListItemExpander()
            ->expandItem($shoppingListItemTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Spryker\Zed\ShoppingListProductOption\Business\ItemTransfer $itemTransfer
     * @param \Generated\Shared\Transfer\ShoppingListItemTransfer $shoppingListItemTransfer
     *
     * @return \Generated\Shared\Transfer\ShoppingListItemTransfer
     */
    public function mapCartItemProductOptionsToShoppingListItemProductOptions(ItemTransfer $itemTransfer, ShoppingListItemTransfer $shoppingListItemTransfer): ShoppingListItemTransfer
    {
        return $this->getFactory()
            ->createCartItemToShoppingListItemMapper()
            ->mapCartItemProductOptionsToShoppingListItemProductOptions($itemTransfer, $shoppingListItemTransfer);
    }
}

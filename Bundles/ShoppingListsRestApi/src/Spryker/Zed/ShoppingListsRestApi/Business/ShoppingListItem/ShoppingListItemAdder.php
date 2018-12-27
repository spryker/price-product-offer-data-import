<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ShoppingListsRestApi\Business\ShoppingListItem;

use Generated\Shared\Transfer\RestShoppingListItemRequestTransfer;
use Generated\Shared\Transfer\RestShoppingListRequestTransfer;
use Generated\Shared\Transfer\ShoppingListItemResponseTransfer;
use Spryker\Shared\ShoppingListsRestApi\ShoppingListsRestApiConfig as SharedShoppingListsRestApiConfig;
use Spryker\Zed\ShoppingListsRestApi\Business\ShoppingList\ShoppingListReaderInterface;
use Spryker\Zed\ShoppingListsRestApi\Dependency\Facade\ShoppingListsRestApiToShoppingListFacadeInterface;

class ShoppingListItemAdder implements ShoppingListItemAdderInterface
{
    /**
     * @var \Spryker\Zed\ShoppingListsRestApi\Dependency\Facade\ShoppingListsRestApiToShoppingListFacadeInterface
     */
    protected $shoppingListFacade;

    /**
     * @var \Spryker\Zed\ShoppingListsRestApi\Business\ShoppingListItem\ShoppingListItemMapperInterface
     */
    protected $shoppingListItemMapper;

    /**
     * @var \Spryker\Zed\ShoppingListsRestApi\Business\ShoppingList\ShoppingListReaderInterface
     */
    protected $shoppingListReader;

    /**
     * @param \Spryker\Zed\ShoppingListsRestApi\Dependency\Facade\ShoppingListsRestApiToShoppingListFacadeInterface $shoppingListFacade
     * @param \Spryker\Zed\ShoppingListsRestApi\Business\ShoppingListItem\ShoppingListItemMapperInterface $shoppingListItemMapper
     * @param \Spryker\Zed\ShoppingListsRestApi\Business\ShoppingList\ShoppingListReaderInterface $shoppingListReader
     */
    public function __construct(
        ShoppingListsRestApiToShoppingListFacadeInterface $shoppingListFacade,
        ShoppingListItemMapperInterface $shoppingListItemMapper,
        ShoppingListReaderInterface $shoppingListReader
    ) {
        $this->shoppingListFacade = $shoppingListFacade;
        $this->shoppingListItemMapper = $shoppingListItemMapper;
        $this->shoppingListReader = $shoppingListReader;
    }

    /**
     * @param \Generated\Shared\Transfer\RestShoppingListItemRequestTransfer $restShoppingListItemRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ShoppingListItemResponseTransfer
     */
    public function addItem(
        RestShoppingListItemRequestTransfer $restShoppingListItemRequestTransfer
    ): ShoppingListItemResponseTransfer {

        $restShoppingListItemRequestTransfer
            ->requireShoppingListItem()
            ->requireShoppingListUuid()
            ->requireCompanyUserUuid();
        $restShoppingListItemRequestTransfer->getShoppingListItem()
            ->requireCustomerReference()
            ->requireSku()
            ->requireQuantity();

        $shoppingListResponseTransferByUuid = $this->shoppingListReader->findShoppingListByUuid(
            $this->shoppingListItemMapper->mapRestShoppingListItemRequestTransferToRestShoppingListRequestTransfer(
                $restShoppingListItemRequestTransfer,
                new RestShoppingListRequestTransfer()
            )
        );

        if ($shoppingListResponseTransferByUuid->getIsSuccess() === false) {
            return $this->shoppingListItemMapper->mapShoppingListResponseErrorsToShoppingListItemResponseErrors(
                $shoppingListResponseTransferByUuid,
                new ShoppingListItemResponseTransfer()
            );
        }

        $restShoppingListItemRequestTransfer->getShoppingListItem()
            ->setIdCompanyUser($shoppingListResponseTransferByUuid->getShoppingList()->getIdCompanyUser())
            ->setFkShoppingList($shoppingListResponseTransferByUuid->getShoppingList()->getIdShoppingList());

        $shoppingListItemTransfer = $this->shoppingListFacade->addItem($restShoppingListItemRequestTransfer->getShoppingListItem());

        if (!$shoppingListItemTransfer->getIdShoppingListItem()) {
            return (new ShoppingListItemResponseTransfer())
                ->setIsSuccess(false)
                ->addError(SharedShoppingListsRestApiConfig::RESPONSE_CODE_SHOPPING_LIST_CANNOT_ADD_ITEM);
        }

        return (new ShoppingListItemResponseTransfer())
            ->setIsSuccess(true)
            ->setShoppingListItem($shoppingListItemTransfer);
    }
}

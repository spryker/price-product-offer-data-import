<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ShoppingListsRestApi\Controller;

use Generated\Shared\Transfer\RestShoppingListItemAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \Spryker\Glue\ShoppingListsRestApi\ShoppingListsRestApiFactory getFactory()
 */
class ShoppingListItemsResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "post": {
     *          "summary": [
     *              "Adds shopping list item."
     *          ],
     *          "parameters": [
     *              {
     *                  "name": "Accept-Language",
     *                  "in": "header"
     *              },
     *              {
     *                  "name": "X-Company-User-Id",
     *                  "in": "header",
     *                  "required": true,
     *                  "description": "Company user id"
     *              }
     *          ],
     *          "responses": {
     *              "400": "Shopping list id not specified.",
     *              "403": "Unauthorized request.",
     *              "404": "Shopping list not found.",
     *              "422": "Can't add an item to shopping list"
     *          },
     *          "responseAttributesClassName": "\\Generated\\Shared\\Transfer\\RestShoppingListItemAttributesTransfer"
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestShoppingListItemAttributesTransfer $restShoppingListItemAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestShoppingListItemAttributesTransfer $restShoppingListItemAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createShoppingListItemAdder()
            ->addShoppingListItem($restRequest, $restShoppingListItemAttributesTransfer);
    }

    /**
     * @Glue({
     *     "patch": {
     *          "summary": [
     *              "Updates shopping list item."
     *          ],
     *          "parameters": [{
     *              "name": "Accept-Language",
     *              "in": "header"
     *          },
     *          {
     *              "name": "X-Company-User-Id",
     *              "in": "header",
     *              "required": true,
     *              "description": "Company user id"
     *          }],
     *          "responses": {
     *              "400": "Shopping list id or list item id not specified.",
     *              "403": "Unauthorized request.",
     *              "404": "Shopping list or list item not found.",
     *              "422": "Cannot update the shopping list item"
     *          },
     *          "responseAttributesClassName": "\\Generated\\Shared\\Transfer\\RestShoppingListItemAttributesTransfer"
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestShoppingListItemAttributesTransfer $restShoppingListItemAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patchAction(
        RestRequestInterface $restRequest,
        RestShoppingListItemAttributesTransfer $restShoppingListItemAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createShoppingListItemUpdater()
            ->updateShoppingListItem($restRequest, $restShoppingListItemAttributesTransfer);
    }

    /**
     * @Glue({
     *     "delete": {
     *          "summary": [
     *              "Deletes item from a shopping list."
     *          ],
     *          "parameters": [{
     *              "name": "Accept-Language",
     *              "in": "header"
     *          },
     *          {
     *              "name": "X-Company-User-Id",
     *              "in": "header",
     *              "required": true,
     *              "description": "Company user id"
     *          }],
     *          "responses": {
     *              "400": "Bad Response.",
     *              "403": "Unauthorized request.",
     *              "404": "Not Found",
     *              "422": "Cannot delete the shopping list item"
     *          },
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function deleteAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()
            ->createShoppingListItemDeleter()
            ->deleteShoppingListItem($restRequest);
    }
}

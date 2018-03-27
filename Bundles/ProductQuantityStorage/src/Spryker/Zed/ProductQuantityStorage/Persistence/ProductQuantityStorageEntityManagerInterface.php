<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductQuantityStorage\Persistence;

use Generated\Shared\Transfer\SpyProductQuantityStorageEntityTransfer;

interface ProductQuantityStorageEntityManagerInterface
{
    /**
     * @api
     *
     * @param int $idProductQuantityStorage
     *
     * @return void
     */
    public function deleteProductQuantityStorage($idProductQuantityStorage);

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\SpyProductQuantityStorageEntityTransfer $productQuantityStorageEntity
     *
     * @return void
     */
    public function saveProductQuantityStorageEntity(SpyProductQuantityStorageEntityTransfer $productQuantityStorageEntity);
}

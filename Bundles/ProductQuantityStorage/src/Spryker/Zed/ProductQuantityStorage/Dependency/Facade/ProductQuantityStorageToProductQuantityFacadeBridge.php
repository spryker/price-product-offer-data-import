<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductQuantityStorage\Dependency\Facade;

class ProductQuantityStorageToProductQuantityFacadeBridge implements ProductQuantityStorageToProductQuantityFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductQuantity\Business\ProductQuantityFacadeInterface
     */
    protected $productQuantityFacade;

    /**
     * @param \Spryker\Zed\ProductQuantity\Business\ProductQuantityFacadeInterface $productQuantityFacade
     */
    public function __construct($productQuantityFacade)
    {
        $this->productQuantityFacade = $productQuantityFacade;
    }

    /**
     * @param int[] $productIds
     *
     * @return \Generated\Shared\Transfer\SpyProductQuantityEntityTransfer[]
     */
    public function getProductQuantityEntitiesByProductIds(array $productIds)
    {
        return $this->productQuantityFacade->getProductQuantityEntitiesByProductIds($productIds);
    }
}

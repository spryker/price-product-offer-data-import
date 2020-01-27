<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductMeasurementUnitsRestApi\Dependency\Client;

interface ProductMeasurementUnitsRestApiToProductMeasurementUnitStorageClientInterface
{
    /**
     * @param int[] $productConcreteIds
     *
     * @return \Generated\Shared\Transfer\ProductMeasurementUnitTransfer[]
     */
    public function getProductMeasurementBaseUnitsByProductConcreteIds(array $productConcreteIds): array;

    /**
     * @param int[] $productConcreteIds
     *
     * @return \Generated\Shared\Transfer\ProductMeasurementSalesUnitTransfer[][]
     */
    public function getProductMeasurementSalesUnitsByProductConcreteIds(array $productConcreteIds): array;
}

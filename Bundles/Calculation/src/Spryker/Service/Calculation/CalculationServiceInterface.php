<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace Spryker\Service\Calculation;

use ArrayObject;

interface CalculationServiceInterface
{
    /**
     * Specification:
     * - Iterates all items grouping them by shipment.
     *
     * @api
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $itemTransfers
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\ShipmentGroupTransfer[]
     */
    public function groupItemsByShipment(ArrayObject $itemTransfers): ArrayObject;
}

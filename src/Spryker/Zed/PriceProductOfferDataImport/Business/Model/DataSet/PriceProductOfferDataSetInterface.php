<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\PriceProductOfferDataImport\Business\Model\DataSet;

interface PriceProductOfferDataSetInterface
{
    public const PRODUCT_OFFER_REFERENCE = 'product_offer_reference';
    public const PRICE_TYPE = 'price_type';
    public const STORE = 'store';
    public const CURRENCY = 'currency';
    public const VALUE_NET = 'value_net';
    public const VALUE_GROSS = 'value_gross';

    public const FK_PRODUCT_OFFER = 'fk_product_offer';
    public const FK_PRICE_TYPE = 'fk_price_type';
    public const FK_STORE = 'fk_store';
    public const FK_CURRENCY = 'fk_currency';
}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\PriceProductOfferDataImport;

use Spryker\Zed\DataImport\DataImportDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\PriceProductOfferDataImport\Dependency\Facade\PriceProductOfferDataImportToPriceProductFacadeBridge;

/**
 * @method \Spryker\Zed\PriceProductOfferDataImport\PriceProductOfferDataImportConfig getConfig()
 */
class PriceProductOfferDataImportDependencyProvider extends DataImportDependencyProvider
{
    public const FACADE_PRICE_PRODUCT = 'FACADE_PRODUCT_OFFER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addPriceProductFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceProductFacade(Container $container): Container
    {
        $container->set(static::FACADE_PRICE_PRODUCT, function (Container $container) {
            return new PriceProductOfferDataImportToPriceProductFacadeBridge($container->getLocator()->priceProduct()->facade());
        });

        return $container;
    }
}

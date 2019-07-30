<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\Kernel\Dependency\Injector;

use Countable;

interface DependencyInjectorCollectionInterface extends Countable
{
    /**
     * @param \Spryker\Glue\Kernel\Dependency\Injector\DependencyInjectorInterface $dependencyInjector
     *
     * @return $this
     */
    public function addDependencyInjector(DependencyInjectorInterface $dependencyInjector);

    /**
     * @return \Spryker\Glue\Kernel\Dependency\Injector\DependencyInjectorInterface[]
     */
    public function getDependencyInjector(): array;
}

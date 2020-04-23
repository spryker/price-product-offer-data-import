<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Kernel\ClassResolver\QueryContainer;

use Spryker\Zed\Kernel\ClassResolver\AbstractClassResolver;

class QueryContainerResolver extends AbstractClassResolver
{
    protected const RESOLVABLE_TYPE = 'ZedQueryContainer';

    /**
     * @param object|string $callerClass
     *
     * @throws \Spryker\Zed\Kernel\ClassResolver\QueryContainer\QueryContainerNotFoundException
     *
     * @return \Spryker\Zed\Kernel\Persistence\AbstractQueryContainer
     */
    public function resolve($callerClass)
    {
        /** @var \Spryker\Zed\Kernel\Persistence\AbstractQueryContainer $resolved */
        $resolved = $this->doResolve($callerClass);

        if ($resolved !== null) {
            return $resolved;
        }

        throw new QueryContainerNotFoundException($this->getClassInfo());
    }

    /**
     * @param string $namespace
     * @param string|null $codeBucket
     *
     * @return string
     */
    protected function buildClassName($namespace, $codeBucket = null)
    {
        $searchAndReplace = [
            self::KEY_NAMESPACE => $namespace,
            self::KEY_BUNDLE => $this->getClassInfo()->getBundle(),
            static::KEY_CODE_BUCKET => $codeBucket,
        ];

        return str_replace(
            array_keys($searchAndReplace),
            array_values($searchAndReplace),
            $this->getClassPattern()
        );
    }
}

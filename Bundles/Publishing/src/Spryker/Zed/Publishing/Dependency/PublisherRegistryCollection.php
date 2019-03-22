<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Publisher\Dependency;

use ArrayIterator;
use Spryker\Zed\PublishingExtension\Dependency\PublisherRegistryCollectionInterface;
use Spryker\Zed\PublishingExtension\Dependency\PublisherRegistryInterface;

class PublisherRegistryCollection implements PublisherRegistryCollectionInterface
{

    /**
     * @var PublisherRegistryInterface[]
     */
    protected $registryCollection = [];

    /**
     * @param \Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface $publisherRegistry
     *
     * @return void
     */
    public function add(PublisherRegistryInterface $publisherRegistry)
    {
        $this->registryCollection[] = $publisherRegistry;
    }

    /**
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->registryCollection[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset
     *
     * @return array|PublisherRegistryInterface
     */
    public function offsetGet($offset)
    {
        return $this->registryCollection[$offset];
    }

    /**
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset
     * @param mixed|\Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->registryCollection[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->registryCollection[$offset]);
    }

    /**
     * Retrieve an external iterator
     *
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     *
     * @return \Traversable|\Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface[]
     */
    public function getIterator()
    {
        return new ArrayIterator($this->registryCollection);
    }
}

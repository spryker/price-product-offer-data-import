<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\FileSystem\Model\Storage;

use Generated\Shared\Transfer\FileSystemStorageConfigTransfer;
use Spryker\Service\FileSystem\Model\Exception\FileSystemStorageBuilderNotFoundException;

class FileSystemStorageProvider implements FileSystemStorageProviderInterface
{

    /**
     * @var array
     */
    protected $configurationData;

    /**
     * @param array $configurationData
     */
    public function __construct(array $configurationData)
    {
        $this->configurationData = $configurationData;
    }

    /**
     * @return \Spryker\Service\FileSystem\Model\Storage\BuilderInterface[]
     */
    public function createCollection()
    {
        $storageCollection = [];
        foreach ($this->configurationData as $storageName => $storageConfigData) {
            $storageConfig = $this->createStorageConfig($storageName, $storageConfigData);

            $builder = $this->createBuilder($storageConfig);
            $storageCollection[$storageName] = $builder->build();
        }

        return $storageCollection;
    }

    /**
     * @param string $storageName
     * @param array $storageConfigData
     *
     * @return \Generated\Shared\Transfer\FileSystemStorageConfigTransfer
     */
    protected function createStorageConfig($storageName, array $storageConfigData)
    {
        $configTransfer = new FileSystemStorageConfigTransfer();
        $configTransfer->setName($storageName);

        $type = $storageConfigData[FileSystemStorageConfigTransfer::TYPE];
        $configTransfer->setType($type);
        unset($storageConfigData[FileSystemStorageConfigTransfer::TYPE]);

        $configTransfer->setData($storageConfigData);

        return $configTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FileSystemStorageConfigTransfer $storageConfig
     *
     * @throws \Spryker\Service\FileSystem\Model\Exception\FileSystemStorageBuilderNotFoundException
     *
     * @return \Spryker\Service\FileSystem\Model\Storage\BuilderInterface
     */
    protected function createBuilder(FileSystemStorageConfigTransfer $storageConfig)
    {
        $storageConfig->requireName();

        $builderClass = $storageConfig->getType();
        if (!$builderClass) {
            throw new FileSystemStorageBuilderNotFoundException(
                sprintf('FileSystemStorageBuilder "%s" was not found', $storageConfig->getName())
            );
        }

        $builder = new $builderClass($storageConfig);

        return $builder;
    }

}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductsCategoriesResourceRelationship\Processor\Reader;

use Spryker\Glue\ProductsCategoriesResourceRelationship\Dependency\Client\ProductsCategoriesResourceRelationshipToProductCategoryStorageClientInterface;
use Spryker\Glue\ProductsCategoriesResourceRelationship\Dependency\Client\ProductsCategoriesResourceRelationshipToProductStorageClientInterface;

class AbstractProductsCategoriesReader implements AbstractProductsCategoriesReaderInterface
{
    protected const PRODUCT_ABSTRACT_MAPPING_TYPE = 'sku';
    protected const KEY_ID_PRODUCT_ABSTRACT = 'id_product_abstract';
    protected const KEY_SKU = 'sku';

    /**
     * @var \Spryker\Glue\ProductsCategoriesResourceRelationship\Dependency\Client\ProductsCategoriesResourceRelationshipToProductStorageClientInterface
     */
    protected $productStorageClient;

    /**
     * @var \Spryker\Glue\ProductsCategoriesResourceRelationship\Dependency\Client\ProductsCategoriesResourceRelationshipToProductCategoryStorageClientInterface
     */
    protected $productCategoryStorageClient;

    /**
     * @param \Spryker\Glue\ProductsCategoriesResourceRelationship\Dependency\Client\ProductsCategoriesResourceRelationshipToProductStorageClientInterface $productStorageClient
     * @param \Spryker\Glue\ProductsCategoriesResourceRelationship\Dependency\Client\ProductsCategoriesResourceRelationshipToProductCategoryStorageClientInterface $productCategoryStorageClient
     */
    public function __construct(
        ProductsCategoriesResourceRelationshipToProductStorageClientInterface $productStorageClient,
        ProductsCategoriesResourceRelationshipToProductCategoryStorageClientInterface $productCategoryStorageClient
    ) {
        $this->productStorageClient = $productStorageClient;
        $this->productCategoryStorageClient = $productCategoryStorageClient;
    }

    /**
     * @param string $sku
     * @param string $locale
     *
     * @return int[]|null
     */
    public function findProductCategoryNodeIds(string $sku, string $locale): ?array
    {
        $abstractProductData = $this->productStorageClient
            ->findProductAbstractStorageDataByMapping(
                static::PRODUCT_ABSTRACT_MAPPING_TYPE,
                $sku,
                $locale
            );
        if (!$abstractProductData) {
            return null;
        }

        return $this->getProductCategoryNodeIds($abstractProductData, $locale);
    }

    /**
     * @param array $skus
     * @param string $locale
     *
     * @return array|null
     */
    public function findProductCategoryNodeIdsBySkus(array $skus, string $locale): ?array
    {
        $abstractProductData = $this->productStorageClient
            ->findBulkProductAbstractStorageDataByMapping(
                static::PRODUCT_ABSTRACT_MAPPING_TYPE,
                $skus,
                $locale
            );
        if (!$abstractProductData) {
            return null;
        }

        return $this->getBulkProductCategoryNodeIds($abstractProductData, $locale);
    }

    /**
     * @param array $abstractProductData
     * @param string $locale
     *
     * @return array
     */
    protected function getProductCategoryNodeIds(array $abstractProductData, string $locale): array
    {
        $productCategoryNodeIds = [];
        $idProductAbstract = $abstractProductData[static::KEY_ID_PRODUCT_ABSTRACT];
        $productCategories = $this->productCategoryStorageClient
            ->findProductAbstractCategory($idProductAbstract, $locale);

        if ($productCategories) {
            foreach ($productCategories->getCategories() as $productCategory) {
                $productCategoryNodeIds[] = $productCategory->getCategoryNodeId();
            }
        }

        return $productCategoryNodeIds;
    }

    /**
     * @param array $abstractProductData
     * @param string $locale
     *
     * @return array
     */
    protected function getBulkProductCategoryNodeIds(array $abstractProductData, string $locale): array
    {
        $productCategoryNodeIds = [];
        $keys = [];
        foreach ($abstractProductData as $item) {
            $keys[$item[static::KEY_SKU]] = (int)$item[static::KEY_ID_PRODUCT_ABSTRACT];
            $productCategoryNodeIds[$item[static::KEY_SKU]] = [];
        }

        $productCategories = $this->productCategoryStorageClient
            ->findBulkProductAbstractCategory($keys, $locale);

        /** @var \Generated\Shared\Transfer\ProductAbstractCategoryStorageTransfer $productCategory */
        foreach ($productCategories as $sku => $productCategory) {
            foreach ($productCategory->getCategories() as $category) {
                $productCategoryNodeIds[$sku][] = $category->getCategoryNodeId();
            }
        }

        return $productCategoryNodeIds;
    }
}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundlePageSearch\Communication\Plugin\Search;

use Generated\Shared\Transfer\ConfigurableBundleTemplatePageSearchTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Shared\ConfigurableBundlePageSearch\ConfigurableBundlePageSearchConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;
use Spryker\Zed\Search\Dependency\Plugin\NamedPageMapInterface;

/**
 * @method \Spryker\Zed\ConfigurableBundlePageSearch\ConfigurableBundlePageSearchConfig getConfig()
 * @method \Spryker\Zed\ConfigurableBundlePageSearch\Business\ConfigurableBundlePageSearchFacadeInterface getFacade()
 * @method \Spryker\Zed\ConfigurableBundlePageSearch\Communication\ConfigurableBundlePageSearchCommunicationFactory getFactory()
 */
class ConfigurableBundleTemplatePageMapPlugin extends AbstractPlugin implements NamedPageMapInterface
{
    /**
     * @api
     *
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function buildPageMap(PageMapBuilderInterface $pageMapBuilder, array $data, LocaleTransfer $locale): PageMapTransfer
    {
        $pageMapTransfer = (new PageMapTransfer())
            ->setLocale($data[ConfigurableBundleTemplatePageSearchTransfer::LOCALE])
            ->setType(ConfigurableBundlePageSearchConfig::CONFIGURABLE_BUNDLE_TEMPLATE_RESOURCE_NAME);

        $pageMapBuilder
            ->addSearchResultData($pageMapTransfer, ConfigurableBundleTemplateTransfer::ID_CONFIGURABLE_BUNDLE_TEMPLATE, $data[ConfigurableBundleTemplatePageSearchTransfer::FK_CONFIGURABLE_BUNDLE_TEMPLATE])
            ->addSearchResultData($pageMapTransfer, ConfigurableBundleTemplatePageSearchTransfer::NAME, $data[ConfigurableBundleTemplatePageSearchTransfer::NAME])
            ->addSearchResultData($pageMapTransfer, ConfigurableBundleTemplatePageSearchTransfer::UUID, $data[ConfigurableBundleTemplatePageSearchTransfer::UUID])
            ->addSearchResultData($pageMapTransfer, ConfigurableBundleTemplatePageSearchTransfer::TRANSLATIONS, $data[ConfigurableBundleTemplatePageSearchTransfer::TRANSLATIONS])
            ->addFullText($pageMapTransfer, $data[ConfigurableBundleTemplatePageSearchTransfer::NAME]);

        return $pageMapTransfer;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return ConfigurableBundlePageSearchConfig::CONFIGURABLE_BUNDLE_TEMPLATE_RESOURCE_NAME;
    }
}

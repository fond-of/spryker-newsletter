<?php

namespace FondOfSpryker\Service\Newsletter\Model\Url;

use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use FondOfSpryker\Zed\Newsletter\NewsletterConfig;
use Generated\Shared\Transfer\NewsletterTransfer;
use Spryker\Shared\Kernel\Communication\Application;

interface NewsletterUrlBuilderInterface
{
    /**
     * @param  array $params
     * @return string
     */
    public function buildOptInUrl(array $params): string;

    /**
     * @param  array $params
     * @return string
     */
    public function buildOptOutUrl(array $params): string;

    /**
     * @return string
     */
    public function getNameParam(): string;

    /**
     * @return string
     */
    public function getTokenParam(): string;
}

<?php

namespace FondOfSpryker\Service\Newsletter\Model\Url;

use FondOfSpryker\Service\Newsletter\NewsletterConfig;
use FondOfSpryker\Shared\Newsletter\NewsletterConstants;

class NewsletterUrlBuilder implements NewsletterUrlBuilderInterface
{
    /**
     * @var \FondOfSpryker\Service\Newsletter\Model\Url\NewsletterConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Service\Newsletter\NewsletterConfig $config
     */
    public function __construct(NewsletterConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function buildOptInUrl(array $params): string
    {
        return $this->buildUrl($params, $this->config->getOptInPathPattern());
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function buildOptOutUrl(array $params): string
    {
        return $this->buildUrl($params, $this->config->getOptoutPathPattern());
    }

    /**
     * @param array $params
     * @param bool $external
     *
     * @return string
     */
    public function buildRedirectUrl(array $params, bool $external): string
    {
        $queryString = null;
        if (array_key_exists(NewsletterConstants::QUERY_STRING, $params)) {
            $queryString = $params[NewsletterConstants::QUERY_STRING];
            unset($params[NewsletterConstants::QUERY_STRING]);
        }

        if ($external === false) {
            return $this->buildInternalUrl($params, $this->config->getNewsletterRedirectPattern(), $queryString);
        }

        return $this->buildUrl($params, $this->config->getNewsletterRedirectPattern(), $queryString);
    }

    /**
     * @param array $params
     * @param string $pattern
     * @param string|null $queryString
     *
     * @return string
     */
    protected function buildUrl(array $params, string $pattern, ?string $queryString = null): string
    {
        return $this->appendQueryString($this->config->getHostYves() . '/' . vsprintf($pattern, $params), $queryString);
    }

    /**
     * @param array $params
     * @param string $pattern
     * @param string|null $queryString
     *
     * @return string
     */
    protected function buildInternalUrl(array $params, string $pattern, ?string $queryString = null): string
    {
        return $this->appendQueryString(sprintf('/%s', vsprintf($pattern, $params)), $queryString);
    }

    /**
     * @param string $path
     * @param string|null $queryString
     *
     * @return string
     */
    protected function appendQueryString(string $path, ?string $queryString = null): string
    {
        if (empty($queryString) === true) {
            return $path;
        }

        return sprintf('%s?%s', $path, $queryString);
    }

    /**
     * @return string
     */
    public function getNameParam(): string
    {
        return NewsletterConstants::NEWSTLETTER;
    }

    /**
     * @return string
     */
    public function getTokenParam(): string
    {
        return NewsletterConstants::TOKEN;
    }
}

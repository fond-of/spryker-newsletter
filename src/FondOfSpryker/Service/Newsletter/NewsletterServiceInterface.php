<?php

namespace FondOfSpryker\Service\Newsletter;

interface NewsletterServiceInterface
{
    /**
     * @param  array $params
     * @return string
     */
    public function getOptInUrl(array $params): string;

    /**
     * @param  array $params
     * @return string
     */
    public function getOptOutUrl(array $params): string;

    /**
     * @param  string $string
     * @return string
     */
    public function getHash(
        string $string
    ): string;

    /**
     * @return string
     */
    public function getNewsletterParamName(): string;

    /**
     * @return string
     */
    public function getNewsletterTokenParamName(): string;
}

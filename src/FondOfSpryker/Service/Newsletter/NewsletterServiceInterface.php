<?php

namespace FondOfSpryker\Service\Newsletter;

interface NewsletterServiceInterface
{
    /**
     * @param  array  $params
     * @return string
     */
    public function getOptInUrl(array $params): string;

    /**
     * @param  array  $params
     * @return string
     */
    public function getOptOutUrl(array $params): string;
}

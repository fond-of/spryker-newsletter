<?php

namespace FondOfSpryker\Yves\Newsletter\Dependency\Plugin;

use Generated\Shared\Transfer\NewsletterResponseTransfer;
use Symfony\Component\HttpFoundation\Request;

interface NewsletterSubscribePluginInterface
{
    /**
     * @param string  $email
     * @param Request $request
     *
     * @return NewsletterResponseTransfer
     */
    public function subscribe(string $email, Request $request): NewsletterResponseTransfer;

    /**
     * @param string $externalId
     *
     * @return NewsletterResponseTransfer
     */
    public function confirmSubscription(string $externalId): NewsletterResponseTransfer;
}

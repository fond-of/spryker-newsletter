<?php

namespace FondOfSpryker\Yves\Newsletter\Dependency\Plugin;

use Generated\Shared\Transfer\NewsletterResponseTransfer;
use Symfony\Component\HttpFoundation\Request;

interface NewsletterSubscribePluginInterface
{
    /**
     * @param string $email
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\NewsletterResponseTransfer
     */
    public function subscribe(string $email, Request $request): NewsletterResponseTransfer;

    /**
     * @param string $externalId
     *
     * @return \Generated\Shared\Transfer\NewsletterResponseTransfer
     */
    public function confirmSubscription(string $externalId): NewsletterResponseTransfer;

    /**
     * @param string $externalId
     *
     * @return \Generated\Shared\Transfer\NewsletterResponseTransfer
     */
    public function unsubscribe(string $externalId): NewsletterResponseTransfer;
}

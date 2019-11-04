<?php

namespace FondOfSpryker\Yves\Newsletter\Dependency\Plugin;

use Generated\Shared\Transfer\NewsletterResponseTransfer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface NewsletterSubscribePluginInterface
{
    /**
     * @param string  $email
     * @param Request $request
     *
     * @return NewsletterResponseTransfer
     */
    public function subscribe(string $email, Request $request): NewsletterResponseTransfer;
}

<?php

namespace FondOfSpryker\Service\Newsletter;

use Symfony\Component\Form\FormInterface;

interface NewsletterServiceInterface
{
    /**
     * @param array $params
     *
     * @return string
     */
    public function getOptInUrl(array $params): string;

    /**
     * @param array $params
     *
     * @return string
     */
    public function getOptOutUrl(array $params): string;

    /**
     * @param array $params
     * @param bool $isExternal
     *
     * @return string
     */
    public function getRedirectUrl(array $params, bool $isExternal = false): string;

    /**
     * @param string $string
     *
     * @return string
     */
    public function getHash(string $string): string;

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return bool
     */
    public function validateForm(FormInterface $form): bool;

    /**
     * @return string
     */
    public function getNewsletterParamName(): string;

    /**
     * @return string
     */
    public function getNewsletterTokenParamName(): string;
}

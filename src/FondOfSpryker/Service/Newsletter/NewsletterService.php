<?php

namespace FondOfSpryker\Service\Newsletter;

use Spryker\Service\Kernel\AbstractService;
use Symfony\Component\Form\FormInterface;

/**
 * @method \FondOfSpryker\Service\Newsletter\NewsletterServiceFactory getFactory()
 */
class NewsletterService extends AbstractService implements NewsletterServiceInterface
{
    /**
     * @param array $params
     *
     * @return string
     */
    public function getOptInUrl(array $params): string
    {
        return $this->getFactory()->createNewsletterUrlBuilder()->buildOptInUrl($params);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function getOptOutUrl(array $params): string
    {
        return $this->getFactory()->createNewsletterUrlBuilder()->buildOptOutUrl($params);
    }

    /**
     * @param array $params
     * @param bool $isExternal
     *
     * @return string
     */
    public function getRedirectUrl(array $params, bool $isExternal = true): string
    {
        return $this->getFactory()->createNewsletterUrlBuilder()->buildRedirectUrl($params, $isExternal);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function getHash(string $string): string
    {
        return $this->getFactory()->createHashGenerator()->generate($string);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return bool
     */
    public function validateForm(FormInterface $form): bool
    {
        return $this->getFactory()->createFormValidatorCollection()->execValidation($form);
    }

    /**
     * @return string
     */
    public function getNewsletterParamName(): string
    {
        return $this->getFactory()->createNewsletterUrlBuilder()->getNameParam();
    }

    /**
     * @return string
     */
    public function getNewsletterTokenParamName(): string
    {
        return $this->getFactory()->createNewsletterUrlBuilder()->getTokenParam();
    }
}

<?php

namespace FondOfSpryker\Yves\Newsletter;

use FondOfSpryker\Service\Newsletter\NewsletterServiceInterface;
use FondOfSpryker\Yves\Newsletter\Dependency\Plugin\NewsletterSubscribePluginInterface;
use FondOfSpryker\Yves\Newsletter\Form\NewsletterSubscriptionForm;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\AbstractFactory;
use Symfony\Component\Form\FormInterface;

class NewsletterFactory extends AbstractFactory
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getNewsletterSubscriptionForm(): FormInterface
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY)->create($this->createNewsletterSubscriptionForm());
    }

    /**
     * @return string
     */
    protected function createNewsletterSubscriptionForm(): string
    {
        return NewsletterSubscriptionForm::class;
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    protected function getStore(): Store
    {
        return Store::getInstance();
    }

    /**
     * @return string
     */
    public function getStorename(): string
    {
        $storeName = explode('_', $this->getStore()->getStoreName());

        return ucfirst(strtolower($storeName[0]));
    }

    /**
     * @return string
     */
    public function getCurrentLocale(): string
    {
        return $this->getStore()->getCurrentLocale();
    }

    /**
     * @return string
     */
    public function getCurrentLanguage(): string
    {
        return $this->getStore()->getCurrentLanguage();
    }

    /**
     * @return \FondOfSpryker\Yves\Newsletter\Dependency\Plugin\NewsletterSubscribePluginInterface|null
     */
    public function getNewsletterSubscriberPlugin(): ?NewsletterSubscribePluginInterface
    {
        return $this->getProvidedDependency(NewsletterDependencyProvider::NEWSLETTER_SUBSCRIBER_PLUGIN);
    }

    /**
     * @return \FondOfSpryker\Service\Newsletter\NewsletterServiceInterface
     */
    public function getNewsletterService(): NewsletterServiceInterface
    {
        return $this->getProvidedDependency(NewsletterDependencyProvider::SERVICE_NEWSLETTER);
    }
}

<?php
namespace FondOfSpryker\Yves\Newsletter;

use FondOfSpryker\Yves\CrossEngage\Form\CrossEngageSubscriptionForm;
use FondOfSpryker\Yves\Newsletter\Dependency\Plugin\NewsletterSubscribePluginInterface;
use FondOfSpryker\Yves\Newsletter\Form\NewsletterSubscriptionForm;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\AbstractFactory;
use Symfony\Component\Form\FormInterface;

class NewsletterFactory extends AbstractFactory
{
    /**
     * @throws
     *
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
     * @return Store
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
        $storeName = \explode('_', $this->getStore()->getStoreName());

        return \ucfirst(\strtolower($storeName[0]));
    }

    /**
     * @return NewsletterSubscribePluginInterface
     *
     * @throws
     */
    public function getNewsletterSubscriberPlugin(): ?NewsletterSubscribePluginInterface
    {
        return $this->getProvidedDependency(NewsletterDependencyProvider::NEWSLETTER_SUBSCRIBER_PLUGIN);
    }
}

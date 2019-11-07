<?php

namespace FondOfSpryker\Service\Newsletter;

use Spryker\Service\Kernel\AbstractService;

/**
 * @method \FondOfSpryker\Service\Newsletter\NewsletterServiceFactory getFactory()
 */
class NewsletterService extends AbstractService implements NewsletterServiceInterface
{
    /**
     * @param  array  $params
     * @return string
     */
    public function getOptInUrl(array $params): string
    {
        return $this->getFactory()->createNewsletterUrlBuilder()->buildOptInUrl($params);
    }

    /**
     * @param  array  $params
     * @return string
     */
    public function getOptOutUrl(array $params): string
    {
        return $this->getFactory()->createNewsletterUrlBuilder()->buildOptOutUrl($params);
    }

    /**
     * @param  string  $string
     * @return string
     */
    public function getHash(string $string): string
    {
        return $this->getFactory()->createHashGenerator()->generate($string);
    }
}

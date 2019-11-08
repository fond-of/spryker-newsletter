<?php

namespace FondOfSpryker\Service\Newsletter;

use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Service\Kernel\AbstractBundleConfig;

/**
 * Class NewsletterConfig
 *
 * @package FondOfSpryker\Service\Newsletter
 */
class NewsletterConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getHostYves(): string
    {
        return $this->get(NewsletterConstants::BASE_URL_YVES);
    }

    /**
     * @return string
     */
    public function getOptInPathPattern(): string
    {
        return $this->get(NewsletterConstants::OPT_IN_PATH_PATTERN, '%s/%s/%s/%s');
    }

    /**
     * @return string
     */
    public function getOptoutPathPattern(): string
    {
        return $this->get(NewsletterConstants::OPT_OUT_PATH_PATTERN, '%s/%s/%s/%s');
    }

    /**
     * @return string
     */
    public function getHashAlgo(): string
    {
        return $this->get(NewsletterConstants::NEWSLETTER_HASH_ALGO, 'sha1');
    }

    /**
     * @return string
     */
    public function getModifyIn(): bool
    {
        return $this->get(NewsletterConstants::NEWSLETTER_MODIFY_IN, true);
    }

    /**
     * @return string
     */
    public function getModifyOut(): bool
    {
        return $this->get(NewsletterConstants::NEWSLETTER_MODIFY_OUT, false);
    }

    /**
     * @return string
     */
    public function getModifierIn(): string
    {
        return $this->get(NewsletterConstants::NEWSLETTER_MODIFIER_IN, 'lower');
    }

    /**
     * @return string
     */
    public function getModifierOut(): string
    {
        return $this->get(NewsletterConstants::NEWSLETTER_MODIFIER_OUT, 'lower');
    }
}

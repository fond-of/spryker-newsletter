<?php

namespace FondOfSpryker\Service\Newsletter\Model\Url;

use FondOfSpryker\Service\Newsletter\Model\Url\NewsletterUrlBuilder;
use Codeception\Test\Unit;

/**
 * Auto-generated group annotations
 * @group FondOfSpryker
 * @group Service
 * @group Newsletter
 * @group Model
 * @group Url
 * @group NewsletterUrlBuilderTest
 * Add your own group annotations below this line
 */
class NewsletterUrlBuilderTest extends Unit
{

    public function testBuildOptOutUrl()
    {
        $service = new NewsletterUrlBuilder();
        $test = $service->buildOptInUrl();

        dump($test);
    }

    public function testBuildOptInUrl()
    {

    }
}

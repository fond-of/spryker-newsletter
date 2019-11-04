<?php

namespace FondOfSpryker\Yves\Newsletter\Controller;

use Doctrine\Common\Annotations\AnnotationRegistry;
use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use FondOfSpryker\Yves\CrossEngage\Plugin\Provider\NewsletterControllerProvider;
use Generated\Shared\Transfer\CrossEngageTransfer;
use Spryker\Shared\Url\UrlBuilder;
use Spryker\Yves\Kernel\Controller\AbstractController;
use SprykerShop\Yves\HomePage\Plugin\Provider\HomePageControllerProvider;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfSpryker\Yves\Newsletter\NewsletterFactory getFactory()
 * @method \FondOfSpryker\Client\Newsletter\NewsletterClientInterface getClient()
 */
class NewsletterController extends AbstractController
{
    /**
     * @param  Request $request
     * @return array
     *
     * @throws
     */
    public function formAction(Request $request): array
    {
        $parentRequest = $this->getApplication()['request_stack']->getParentRequest();

        if ($parentRequest !== null) {
            $request = $parentRequest;
        }

        $newsletterSubscriptionForm = $this->getFactory()
            ->getNewsletterSubscriptionForm();

        return [
            'newsletterSubscriptionForm' => $newsletterSubscriptionForm->createView(),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws
     */
    public function submitAction(Request $request): RedirectResponse
    {
        $newsletterSubscriptionForm = $this->getFactory()->getNewsletterSubscriptionForm()->handleRequest($request);

        if ($newsletterSubscriptionForm->isSubmitted() && $newsletterSubscriptionForm->isValid()) {
            $response = $this->getFactory()->getNewsletterSubscriberPlugin()->subscribe(
                $newsletterSubscriptionForm->get('email')->getData(),
                $request
            );

            return $this->redirectResponseInternal($response->getRedirectTo());
        }

        return $this->redirectResponseInternal(HomePageControllerProvider::ROUTE_HOME);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function confirmSubscriptionAction(Request $request): RedirectResponse
    {
        if (!$request->get('token')) {
            return $this->redirectResponseInternal(HomePageControllerProvider::ROUTE_HOME);
        }

        $response = $this->getFactory()->getNewsletterSubscriberPlugin()->confirmSubscription(
            $request->get('token')
        );

        return $this->redirectResponseInternal($response->getRedirectTo());
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function unsubscribeAction(Request $request): RedirectResponse
    {
        $this->getClient()->unsubscribe(
            (new CrossEngageTransfer())->setExternalId($request->get('token'))
        );

        return $this->redirectResponseInternal(HomePageControllerProvider::ROUTE_HOME);
    }
}

<?php

namespace FondOfSpryker\Yves\Newsletter\Controller;

use Generated\Shared\Transfer\NewsletterResponseTransfer;
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
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
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
     */
    public function submitAction(Request $request): RedirectResponse
    {
        $newsletterSubscriptionForm = $this->getFactory()->getNewsletterSubscriptionForm()->handleRequest($request);

        if ($newsletterSubscriptionForm->isSubmitted() && $newsletterSubscriptionForm->isValid() && $this->getFactory()->getNewsletterService()->validateForm($newsletterSubscriptionForm)) {
            $response = $this->getFactory()->getNewsletterSubscriberPlugin()->subscribe(
                $newsletterSubscriptionForm->get('email')->getData(),
                $request
            );

            return $this->createNewsletterRedirect($response);
        }

        return $this->redirectResponseInternal(HomePageControllerProvider::ROUTE_HOME);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function confirmSubscriptionAction(Request $request): RedirectResponse
    {
        if (!$request->get('token')) {
            return $this->redirectResponseInternal(HomePageControllerProvider::ROUTE_HOME);
        }

        $response = $this->getFactory()->getNewsletterSubscriberPlugin()->confirmSubscription(
            $request->get('token')
        );

        return $this->createNewsletterRedirect($response);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function unsubscribeAction(Request $request): RedirectResponse
    {
        if (!$request->get('token')) {
            return $this->redirectResponseInternal(HomePageControllerProvider::ROUTE_HOME);
        }

        $response = $this->getFactory()->getNewsletterSubscriberPlugin()->unsubscribe(
            $request->get('token')
        );

        return $this->createNewsletterRedirect($response);
    }

    /**
     * @param \Generated\Shared\Transfer\NewsletterResponseTransfer $response
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createNewsletterRedirect(NewsletterResponseTransfer $response): RedirectResponse
    {
        $redirect = $this->getFactory()->getConfig()->getRedirectPathByKeyAndLocale(
            $response->getRedirectTo(),
            $this->getFactory()->getCurrentLocale()
        );
        $newsletterService = $this->getFactory()->getNewsletterService();
        $params = [
            'language' => $this->getFactory()->getNewsletterService()->getLanguagePrefix(),
            $newsletterService->getNewsletterParamName() => $newsletterService->getNewsletterParamName(),
            $redirect => $redirect,
        ];

        return $this->redirectResponseExternal($newsletterService->getRedirectUrl($params));
    }
}

<?php

namespace FondOfSpryker\Shared\Newsletter;

interface NewsletterConstants
{
    public const NEWSTLETTER = 'newsletter';
    public const TOKEN = 'token';
    public const QUERY_STRING = 'query-string';
    public const BASE_URL_YVES = 'BASE_URL_YVES';
    public const OPT_IN_PATH_PATTERN = 'OPT_IN_PATH_PATTERN';
    public const OPT_OUT_PATH_PATTERN = 'OPT_OUT_PATH_PATTERN';
    public const NEWSLETTER_REDIRECT_PATTERN = 'NEWSLETTER_REDIRECT_PATTERN';

    public const ROUTE_NEWSLETTER_FOOTER = 'ROUTE_NEWSLETTER_FOOTER';
    public const ROUTE_NEWSLETTER_SUBMIT_FORM = 'ROUTE_NEWSLETTER_SUBMIT_FORM';
    public const ROUTE_NEWSLETTER_CONFIRM_SUBSCRIPTION = 'ROUTE_NEWSLETTER_CONFIRM_SUBSCRIPTION';
    public const ROUTE_NEWSLETTER_UNSUBSCRIBE = 'ROUTE_NEWSLETTER_UNSUBSCRIBE';

    public const NEWSLETTER_LOCALIZED_CONFIGS = 'NEWSLETTER_LOCALIZED_CONFIGS';

    public const NEWSLETTER_CONFIRMATION_PATH = 'NEWSLETTER_CONFIRMATION_PATH';
    public const NEWSLETTER_ALREADY_SUBSCRIBED_PATH = 'NEWSLETTER_ALREADY_SUBSCRIBED_PATH';

    // ROUTE_NEWSLETTER_SUBSCRIBE
    public const ROUTE_REDIRECT_NEWSLETTER_SUBSCRIBE = 'ROUTE_REDIRECT_NEWSLETTER_SUBSCRIBE';
    public const ROUTE_REDIRECT_NEWSLETTER_SUBSCRIPTION_CONFIRMED = 'ROUTE_REDIRECT_NEWSLETTER_SUBSCRIPTION_CONFIRMED';
    public const ROUTE_REDIRECT_NEWSLETTER_ALREADY_SUBSCRIBED = 'ROUTE_REDIRECT_NEWSLETTER_ALREADY_SUBSCRIBED';
    public const ROUTE_REDIRECT_NEWSLETTER_UNSUBSCRIBED = 'ROUTE_REDIRECT_NEWSLETTER_UNSUBSCRIBED';
    public const ROUTE_REDIRECT_NEWSLETTER_FAILURE = 'ROUTE_REDIRECT_NEWSLETTER_FAILURE';

    // HashAlgo Constants
    public const NEWSLETTER_HASH_ALGO = 'NEWSLETTER_HASH_ALGO';
    public const NEWSLETTER_MODIFY_IN = 'NEWSLETTER_MODIFY_IN';
    public const NEWSLETTER_MODIFY_OUT = 'NEWSLETTER_MODIFY_OUT';
    public const NEWSLETTER_MODIFIER_IN = 'NEWSLETTER_MODIFIER_IN';
    public const NEWSLETTER_MODIFIER_OUT = 'NEWSLETTER_MODIFIER_OUT';

    // SprykerUpgradeToDo Check if needed
    public const EDITORIAL_NEWSLETTER = 'EDITORIAL_NEWSLETTER';
}

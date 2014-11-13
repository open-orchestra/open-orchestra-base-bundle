<?php

namespace PHPOrchestra\BaseBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener to make the locale persistent
 */
class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    /**
     * Constructor
     * 
     * @param string $defaultLocale
     */
    public function __construct($defaultLocale = 'fr')
    {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * Request listener
     * 
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}
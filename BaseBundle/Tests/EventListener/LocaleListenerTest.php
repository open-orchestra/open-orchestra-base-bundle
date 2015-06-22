<?php

namespace OpenOrchestra\BaseBundle\Tests\EventListener;

use Phake;
use OpenOrchestra\BaseBundle\EventListener\LocaleListener;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class LocaleListenerTest
 */
class LocaleListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LocaleListener
     */
    protected $listener;

    protected $event;
    protected $request;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->request = Phake::mock('Symfony\Component\HttpFoundation\Request');

        $this->event = Phake::mock('Symfony\Component\HttpKernel\Event\GetResponseEvent');
        Phake::when($this->event)->getRequest()->thenReturn($this->request);

        $this->listener = new LocaleListener();
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
    }

    /**
     * Test subscribed event
     */
    public function testSubscribedEvent()
    {
        $this->assertSame(array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 17))
        ), $this->listener->getSubscribedEvents());
    }

    /**
     * Test for first request
     */
    public function testWithNoPreviousSession()
    {
        Phake::when($this->request)->hasPreviousSession()->thenReturn(false);

        $this->listener->onKernelRequest($this->event);

        Phake::verify($this->request, Phake::never())->getSession();
        Phake::verify($this->request, Phake::never())->setLocale();
    }

    /**
     * @param string      $sessionLocale
     * @param string|null $attributesLocale
     *
     * @dataProvider provideSessionAndAttributeLocale
     */
    public function testWithPreviousSession($sessionLocale, $attributesLocale = null)
    {
        $attributes = Phake::mock('Symfony\Component\HttpFoundation\ParameterBag');
        Phake::when($attributes)->get(Phake::anyParameters())->thenReturn($attributesLocale);

        $session = Phake::mock('Symfony\Component\HttpFoundation\Session\SessionInterface');
        Phake::when($session)->get(Phake::anyParameters())->thenReturn($sessionLocale);

        Phake::when($this->request)->hasPreviousSession()->thenReturn(true);
        Phake::when($this->request)->getSession()->thenReturn($session);
        $this->request->attributes = $attributes;

        $this->listener->onKernelRequest($this->event);

        if (is_null($attributesLocale)) {
            Phake::verify($this->request)->setLocale($sessionLocale);
            Phake::verify($session)->get('_locale', 'en');
            Phake::verify($session, Phake::never())->set(Phake::anyParameters());
        } else {
            Phake::verify($session)->set('_locale', $attributesLocale);
            Phake::verify($this->request, Phake::never())->setLocale(Phake::anyParameters());
            Phake::verify($session, Phake::never())->get(Phake::anyParameters());
        }
    }

    /**
     * @return array
     */
    public function provideSessionAndAttributeLocale()
    {
        return array(
            array('en'),
            array('fr'),
            array('en', 'en'),
            array('fr', 'en'),
            array('en', 'fr'),
            array('fr', 'fr'),
        );
    }
}

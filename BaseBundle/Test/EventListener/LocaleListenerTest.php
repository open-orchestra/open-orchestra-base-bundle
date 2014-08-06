<?php

namespace PHPOrchestra\BaseBundle\Test\EventListener;

use Phake;
use PHPOrchestra\BaseBundle\EventListener\LocaleListener;
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
}

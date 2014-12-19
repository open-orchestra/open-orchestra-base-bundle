<?php

namespace PHPOrchestra\BaseBundle\Test\EventSubscriber;

use Phake;
use PHPOrchestra\BaseBundle\EventSubscriber\AddSubmitButtonSubscriber;
use PHPOrchestra\BackofficeBundle\EventSubscriber\BlockTypeSubscriber;
use Symfony\Component\Form\FormEvents;
use PHPOrchestra\ModelInterface\Model\StatusableInterface;

/**
 * Class AddSubmitButtonSubscriberTest
 */
class AddSubmitButtonSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BlockTypeSubscriber
     */
    protected $subscriber;

    protected $data;
    protected $status;
    protected $event;
    protected $form;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->form = Phake::mock('Symfony\Component\Form\FormBuilder');
        Phake::when($this->form)->add(Phake::anyParameters())->thenReturn($this->form);

        $this->event = Phake::mock('Symfony\Component\Form\FormEvent');
        Phake::when($this->event)->getForm()->thenReturn($this->form);

        $this->subscriber = new AddSubmitButtonSubscriber();
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->subscriber);
    }

    /**
     * Test subscribed events
     */
    public function testEventSubscribed()
    {
        $this->assertArrayHasKey(FormEvents::POST_SET_DATA, $this->subscriber->getSubscribedEvents());
    }

    /**
     * Test add a submit button
     * @param StatusableInterface $data
     * @param array               $expectedParameters
     *
     * @dataProvider provideData
     */
    public function testPostSetData(StatusableInterface $data, $expectedParameters)
    {
        Phake::when($this->event)->getData()->thenReturn($data);
        $this->subscriber->postSetData($this->event);

        Phake::verify($this->form)->add('submit', 'submit', $expectedParameters);
    }

    /**
     * @return array
     */
    public function provideData()
    {
        $status0 = Phake::mock('PHPOrchestra\ModelInterface\Model\StatusInterface');
        Phake::when($status0)->isPublished()->thenReturn(true);

        $data0 = Phake::mock('PHPOrchestra\ModelInterface\Model\StatusableInterface');
        Phake::when($data0)->getStatus()->thenReturn($status0);

        $status1 = Phake::mock('PHPOrchestra\ModelInterface\Model\StatusInterface');
        Phake::when($status1)->isPublished()->thenReturn(false);

        $data1 = Phake::mock('PHPOrchestra\ModelInterface\Model\StatusableInterface');
        Phake::when($data1)->getStatus()->thenReturn($status1);

        return array(
            array($data0, array('label' => 'php_orchestra_base.form.submit', 'attr' => array('class' => 'disabled'))),
            array($data1, array('label' => 'php_orchestra_base.form.submit')),
        );
    }
}

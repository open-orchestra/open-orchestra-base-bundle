<?php

namespace PHPOrchestra\BaseBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use PHPOrchestra\ModelInterface\Model\StatusableInterface;

/**
 * Class AddSubmitButtonSubscriber
 */
class AddSubmitButtonSubscriber implements EventSubscriberInterface
{
    /**
     * @param FormEvent $event
     */
    public function postSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();
        if ($data instanceof StatusableInterface && $data->getStatus()->isPublished()) {
            $form->add('submit', 'submit', array(
                'label' => 'php_orchestra_base.form.submit',
                'attr' => array('class' => 'disabled')
            ));
        } else {
            $form->add('submit', 'submit', array(
                'label' => 'php_orchestra_base.form.submit'
            ));
        }

    }

    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::POST_SET_DATA => 'postSetData',
        );
    }
}

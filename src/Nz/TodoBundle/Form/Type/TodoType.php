<?php

namespace Nz\TodoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Nz\TodoBundle\Form\EventListener\ReplaceNotSubmittedValuesByDefaultsListener;

class TodoType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('task')
            ->add('complete', 'checkbox')
        /* ->add('submit', 'submit') */
        ;

        if ('create' === $options['intention']) {
            $builder->remove('complete');
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nz\TodoBundle\Entity\Todo',
            'intention' => 'create',
        ));
    }

    public function getName()
    {
        return 'todo';
    }
}

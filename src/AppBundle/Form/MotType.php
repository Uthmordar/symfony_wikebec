<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MotType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('terme')
            ->add('variations')
            ->add('prononciation')
            ->add('nature')
            ->add('genre')
            ->add('nombre')
            ->add('origine')
            ->add('trad')
            ->add('categorie')
            ->add('exemples', 'collection', array('type' => new ExempleType()))
            ->add('definitions', 'collection', array('type' => new DefinitionType()))
            ->add('Go!', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mot'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_mot';
    }
}

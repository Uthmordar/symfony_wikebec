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
            ->add('nature', "choice", array(
                "label"=>"Nature:",
                "choices" => array(
                    'abréviation' => "Abréviation",
                    'verbe' => "Verbe",
                    'nom commun' => 'Nom Commun',
                    'nom propre' => "Nom propre",
                    'adjectif' => "Adjectif",
                    'autre'    => "Autre"
                ),
                "multiple" => false,
                "expanded" => false
            ))
            ->add('genre', "choice", array(
                "label"=>"Genre:",
                "choices" => array(
                    'masculin' => "Masculin",
                    'féminin' => "Féminin",
                    'invariable' => "Invariable"
                ),
                "multiple" => false,
                "expanded" => false
            ))
            ->add('nombre', "choice", array(
                "label"=>"Nombre:",
                "choices" => array(
                    'singulier' => "Singulier",
                    'pluriel' => "Pluriel"
                ),
                "multiple" => false,
                "expanded" => true
            ))
            ->add('origine')
            ->add('categorie')
            ->add('exemples', 'collection', array('type' => new ExempleType(), 'label'=>null))
            ->add('definitions', 'collection', array('type' => new DefinitionType(), 'label'=>null))
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

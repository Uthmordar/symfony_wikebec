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
        $userEmail = null;
        if( isset($_COOKIE['wikebek_user_email']) ){
            $userEmail = filter_input( INPUT_COOKIE, 'wikebek_user_email' );
        }
        
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
            ->add( 'definitions', 'collection', array(
                'type' => new DefinitionType(), 
                'allow_add'=>true, 
                'by_reference'=>false,
                'cascade_validation' => true, 
                'options' => array(
                    'label' => false
                ), 
                'allow_delete'=>true )
            )
            ->add('exemples', 'collection', array('type' => new ExempleType(), 'allow_add'=>true, 'by_reference'=>false, 'cascade_validation' => true, 'options' => array('label' => false), 'allow_delete'=>true ))
            ->add('email', 'email', [
                'label'=>'Votre adresse mail',
                'data' => $userEmail
            ])
            ->add('Go!', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mot',
            'cascade_validation' => true
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

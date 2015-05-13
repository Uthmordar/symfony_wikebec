<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConfirmType extends AbstractType
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
        
        $builder->add('email', 'email',[
                'label'=>'Votre adresse mail',
                'data' => $userEmail
            ]);
        $builder->add('Confirmer la suppression', 'submit');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_confirm';
    }
}

<?php

namespace Novify\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SignupType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('userFactCivilite')
            ->remove('userFactNom')
            ->remove('userFactPrenom')
            ->remove('userFactSociete')
            ->remove('userFactAdresse')
            ->remove('userFactPays')
            ->remove('userFactCodep')
            ->remove('userFactVille')
            ->remove('userFactTel')
            ->remove('userLivCivilite')
            ->remove('userLivNom')
            ->remove('userLivPrenom')
            ->remove('userLivSociete')
            ->remove('userLivAdresse')
            ->remove('userLivPays')
            ->remove('userLivCodep')
            ->remove('userLivVille')
            ->remove('userLivTel')
        ;
    }

    public function getName()
    {
        return 'novify_modelbundle_signup';
    }

    public function getParent()
    {
        return new UtilisateursType();
    }
}

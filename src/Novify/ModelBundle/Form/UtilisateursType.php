<?php

namespace Novify\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateursType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userMdp', 'password')
            ->add('userMail', 'email')
            ->add('userNom')
            ->add('userPrenom')
            ->add('userCivilite')
            ->add('userFactCivilite')
            ->add('userFactNom')
            ->add('userFactPrenom')
            ->add('userFactSociete')
            ->add('userFactAdresse')
            ->add('userFactPays')
            ->add('userFactCodep')
            ->add('userFactVille')
            ->add('userFactTel')
            ->add('userLivCivilite')
            ->add('userLivNom')
            ->add('userLivPrenom')
            ->add('userLivSociete')
            ->add('userLivAdresse')
            ->add('userLivPays')
            ->add('userLivCodep')
            ->add('userLivVille')
            ->add('userLivTel')
            ->add('Créer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Novify\ModelBundle\Entity\Utilisateurs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'novify_modelbundle_utilisateurs';
    }
}

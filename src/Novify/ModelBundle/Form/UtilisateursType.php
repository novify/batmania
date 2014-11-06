<?php

namespace Novify\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateursType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userMdp', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Les mots de passe doivent correspondre',
            ))
            ->add('userMail', 'email')
            ->add('userNom')
            ->add('userPrenom')
            ->add('userCivilite', 'choice', array(
                'choices' => array('M' => 'Masculin', 'F' => 'Féminin'),
                'expanded' => true
            ))
            ->add('userFactCivilite', 'choice', array(
                'choices' => array('M' => 'Masculin', 'F' => 'Féminin'),
                // 'required' => false,
                'expanded' => true
            ))
            ->add('userFactNom')
            ->add('userFactPrenom')
            ->add('userFactSociete')
            ->add('userFactAdresse')
            ->add('userFactPays', 'country', array(
                'preferred_choices' => array('FR'),
            ))
            ->add('userFactCodep')
            ->add('userFactVille')
            ->add('userFactTel')
            ->add('userLivCivilite', 'choice', array(
                'choices' => array('M' => 'Masculin', 'F' => 'Féminin'),
                'expanded' => true
            ))
            ->add('userLivNom')
            ->add('userLivPrenom')
            ->add('userLivSociete')
            ->add('userLivAdresse')
            ->add('userLivPays', 'country', array(
                'preferred_choices' => array('FR'),
            ))
            ->add('userLivCodep')
            ->add('userLivVille')
            ->add('userLivTel')
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

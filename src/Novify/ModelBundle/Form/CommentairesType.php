<?php

namespace Novify\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentairesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentTexte')
            ->add('commentNote', 'choice', array(
                'choices'   => array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
                'required'  => true,
            ))
            ->add('commentDate')
            ->add('Créer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Novify\ModelBundle\Entity\Commentaires'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'novify_modelbundle_commentaires';
    }
}

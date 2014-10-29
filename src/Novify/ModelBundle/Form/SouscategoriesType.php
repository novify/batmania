<?php

namespace Novify\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SouscategoriesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('souscatNom')
            ->add('categorie', 'entity', array(
                    'class' => 'NovifyModelBundle:Categories',
                    'property' => 'catNom'
                ))
            ->add('Valider', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Novify\ModelBundle\Entity\Souscategories'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'novify_modelbundle_souscategories';
    }
}

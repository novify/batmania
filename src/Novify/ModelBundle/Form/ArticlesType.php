<?php

namespace Novify\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticlesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artNom')
            ->add('artPromo')
            ->add('artPrix')
            ->add('artDescript')
            ->add('artRef')
            ->add('artAuteur')
            ->add('artEditeur')
            ->add('artDateSortie')
            ->add('artIsbn')
            ->add('artPublic')
            ->add('artPages')
            ->add('artStock')
            ->add('artGenre')
            ->add('artPlateforme')
            ->add('artImg')
            ->add('artRealisat')
            ->add('artCasting')
            ->add('artDuree')
            ->add('sousCategorie', 'entity', array(
                    'class' => 'NovifyModelBundle:Souscategories',
                    'property' => 'souscatNom'
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
            'data_class' => 'Novify\ModelBundle\Entity\Articles'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'novify_modelbundle_articles';
    }
}

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
            ->add('artImg', 'file')
            ->add('artDescript')
            ->add('artPrix')
            ->add('artRef')
            ->add('artStock')
            ->add('sousCategorie', 'entity', array(
                    'class' => 'NovifyModelBundle:Souscategories',
                    'property' => 'souscatNom'
                ))
            ->add('artPromo')
            ->add('artAuteur')
            ->add('artEditeur')
            ->add('artDateSortie', 'date', array(
                'years' => range(date('Y') - 100, date('Y'))
                )
            )
            ->add('artPublic')
            ->add('artIsbn')
            ->add('artPages')
            ->add('artGenre')
            ->add('artPlateforme')
            ->add('artRealisat')
            ->add('artCasting')
            ->add('artDuree')
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

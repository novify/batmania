<?php
namespace Novify\ModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Novify\ModelBundle\Entity\Articles;
use Novify\ModelBundle\Entity\Categories;

class LoadArticles implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Pour créer les catégories :
        // $categories = array('livres', 'videos', 'jeux-videos', 'goodies');

        // foreach ($categories as $categorie) {
        //     $cat = new Categories();
        //     $cat->setCatNom($categorie);
        //     $manager->persist($cat);
        // }

        // Pour créer un article et le relier à une catégorie :
        $categorie1 = new Categories();
        $categorie1->setCatNom('goodies');
        $manager->persist($categorie1);

        $article1 = new Articles();
        $article1->setArtNom('Bracelet');
        $article1->setArtPrix('3');
        $article1->setArtDescript('Ceci est un bracelet');
        $article1->setArtRef('23256443');
        $article1->setArtPublic('Tous publics');
        $article1->setArtStock('28');
        $article1->setCategorie($categorie1);

        $manager->persist($article1);
        $manager->flush();
    }
}

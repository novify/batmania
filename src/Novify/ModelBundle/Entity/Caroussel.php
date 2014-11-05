<?php
     
    namespace Novify\ModelBundle\Entity;
     
    use Doctrine\ORM\Mapping as ORM;
     
    /**
     * Caroussel
     *
     * @ORM\Table()
     * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\CarousselRepository")
     */
    class Caroussel
    {
        /**
         * @var integer
         *
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;
     
        /**
         * @var string
         *
         * @ORM\Column(name="car_img_path", type="string", length=255)
         */
        private $carImgPath;
        private $carImg;
     
        /**
         * @var string
         *
         * @ORM\Column(name="car_lien", type="string", length=255, nullable=true)
         */
        private $carLien;
     
     
        /**
         * Get id
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
     
        /**
         * Set carImg
         *
         * @param string $carImg
         * @return Caroussel
         */
        public function setCarImg($carImg)
        {
            $this->carImg = $carImg;
     
            return $this;
        }
     
        /**
         * Get carImg
         *
         * @return string
         */
        public function getCarImg()
        {
            return $this->carImg;
        }
     
        /**
         * Set carLien
         *
         * @param string $carLien
         * @return Caroussel
         */
        public function setCarLien($carLien)
        {
            $this->carLien = $carLien;
     
            return $this;
        }
     
        /**
         * Get carLien
         *
         * @return string
         */
        public function getCarLien()
        {
            return $this->carLien;
        }









        // Upload d'image
        public function getAbsolutePath()
        {
            return null === $this->carImgPath ? null : $this->getUploadRootDir().'/'.$this->carImgPath;
        }

        public function getWebPath()
        {
            return null === $this->carImgPath ? null : $this->getUploadDir().'/'.$this->carImgPath;
        }

        protected function getUploadRootDir()
        {
            // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
            return __DIR__.'/../../../../web/'.$this->getUploadDir();
        }

        protected function getUploadDir()
        {
            // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
            // le document/image dans la vue.
            return 'uploads/images/caroussel';
        }

        public function upload()
        {
            // la propriété « carImg » peut être vide si le champ n'est pas requis
            if (null === $this->carImg) {
                return;
            }

            // la méthode « move » prend comme arguments le répertoire cible et
            // le nom de fichier cible où le fichier doit être déplacé
            $this->carImg->move($this->getUploadRootDir(), $this->carImg->getClientOriginalName());

            // définit la propriété « path » comme étant le nom de fichier où vous
            // avez stocké le fichier
            $this->carImgPath = $this->carImg->getClientOriginalName();

            // « nettoie » la propriété « carImg » comme vous n'en aurez plus besoin
            $this->carImg = null;
        }

        /**
         * Set carImgPath
         *
         * @param string $carImgPath
         * @return Categories
         */
        public function setcarImgPath($carImgPath)
        {
            $this->carImgPath = $carImgPath;

            return $this;
        }

        /**
         * Get carImgPath
         *
         * @return string 
         */
        public function getcarImgPath()
        {
            return $this->carImgPath;
        }




    }


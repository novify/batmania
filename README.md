Projet batmania
=============

Voici le code source de notre projet e-commerce !
Pour le récupérer :
- Télécharger le .zip en cliquant sur "Download ZIP" en bas à droite de la page et placez-le sur votre serveur local
- **ou** si vous avez installé git sur votre ordinateur, écrivez dans votre terminal
```bash
git clone git@github.com:novify/batmania.git
```
- ou passez par votre client git (type SourceTree)

- Téléchargez la base de données à [cette adresse](https://www.dropbox.com/s/vwigk8poavma6ca/batmania.sql?dl=0) et le dossier images [ici](https://www.dropbox.com/s/7mmuj97t9ci4zbp/images.zip?dl=0)
- Importez la base de données sur votre serveur SQL, via phpMyAdmin par exemple (le nom de la base de données est "batmania")
- Décompressez le dossier images/ et placez le sous batmania/web/uploads/

- Ensuite, une fois à la racine du dossier du projet (`cd batmania/`), exécutez les commandes suivantes pour mettre les dépendances à jour :

```bash
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

- C'est fini ! Rendez vous sur `http://localhost(:8888 sur MAMP)/batmania/web/app_dev.php`
- Pour accéder au compte admin les identifiants sont :
email : admin@batmania.com, mot de passe : admin
- N'hésitez pas à marquer un bug sur GitHub au moindre problème...

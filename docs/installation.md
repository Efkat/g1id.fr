#Installation
[Retour à l'accueil](index.md)

##Pré-requis
`-Une base de données MySQL en local`  
`-composer`  
`-npm`

##Récupérer les sources du projet
`git clone https://github.com/Efkat/g1id.fr.git`
Se rendre dans la branche souhaitée, par exemple :  
`git checkout development`

##Installation des dépendances
_Il ne faut pas oublier de se rendre dans le dossier cloné._

Installation des dépendances de **composer**
`composer install`
  
Installation des dépendances de **npm**
`npm install`

##Envionnement
Il faut créer une copie du fichier **.env** dans la racine et l'appeler **.env.local**. A l'intérieur configurer et décommenter cette ligne :
`#DATABASE_URL="mysql://db_login:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"`

##Lancer le serveur en local
Pour se faire, il faut nécessairement avoir le binaire de Symfony, [ici](https://symfony.com/download). Une fois dans le dossier du projet :   
`symfony serve`

##Gestion des assets Front-End
Compilez une seule fois les fichiers en environnement de développement :
`npm run dev`  

Activez la compilation automatique :
`npm run watch`

Compilez les fichiers pour la production :
`npm run build`
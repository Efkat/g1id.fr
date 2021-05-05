# Installation
[Retour à l'accueil](index.md)

## Pré-requis
`-Une base de données MySQL en local`  
`-composer`  
`-npm`

## Récupérer les sources du projet
`git clone https://github.com/Efkat/g1id.fr.git`
Se rendre dans la branche souhaitée, par exemple :  
`git checkout development`

## Installation des dépendances
_Il ne faut pas oublier de se rendre dans le dossier cloné._

Installation des dépendances de **composer**
`composer install`
  
Installation des dépendances de **npm**
`npm install`

Compilation des assets
```
  npm run build -> Compilation pour la production
  npm run watch -> Compilation en temps réel (à chaque sauvegarde d'un fichier d'assets)
  npm run dev-server -> Compilation en temps réel + Autorefresh de la page
```

## Envionnement
Il faut créer une copie du fichier **.env** dans la racine et le nommer **.env.local**. A l'intérieur configurer et décommenter cette ligne :
`#DATABASE_URL="mysql://db_login:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"`

Après avoir configuré la ligne du dessus, il faut soit créer une base de données _(db_name)_ manuellement ou bien la commande `php bin/console doctrine:database:create` créera la base pour vous.

Afin de la structure de la base de données correspondent aux contraintes du projet, il est nécessaire d'éxécuter les migrations avec `php bin/console doctrine:migrations:migrate`

## Lancer le serveur en local
Pour se faire, il faut nécessairement avoir le binaire de Symfony, [ici](https://symfony.com/download). Une fois dans le dossier du projet :   
`symfony serve`

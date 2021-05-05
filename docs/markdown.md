# Markdown
[Retour à l'accueil](index.md)

## Introduction 
La saisie des cours, projets,... se réalise au format Markdown. Le texte étant traduit en HTML par le moteur de template au moment de l'affichage de la vue.

## Syntaxe Markdown
### Général
#### Titres
```md
# Titre de niveau 1
## Titre de niveau 2
### Titre de niveau 3
#### Titre de niveau 4
##### Titre de niveau 5
###### Titre de niveau 6
```
#### Textes gras, italique, barré
```
*Ceci est un texte italique*,  **Ceci est un texte gras** et ~~Ceci est un texte barré~~
**Il est possible de les *combiner* comme ceci** ou *encore comme **ceci***
```

#### Liens  
Ceci est un lien email : <exemple@wprock.fr>
  
  Code MD | Résultat
 --- | --- 
`[Ceci est un lien](https://wprock.fr/blog/)` | [Ceci est un lien](https://wprock.fr/blog/) 
`[Ceci est un lien avec un titre](https://wprock.fr/blog/ "Le titre du lien")` | [Ceci est un lien avec un titre](https://wprock.fr/blog/ "Le titre du lien") (passer la souris dessus)
`Ceci est un lien automatique : <https://wprock.fr/blog/>` | Ceci est un lien automatique : <https://wprock.fr/blog/>
`Ceci est un lien email : <exemple@wprock.fr>` | Ceci est un lien email : <exemple@wprock.fr>

#### Listes
```md
Liste simple : 
* Élément 1
* Élément 3
  * Sous-élément 1
  * Sous élément 2
* Élément 2
Liste ordonnée : 
1. Élément 1
2. Élément 2
  1. Sous-élément 1
  2. Sous élément 2
3. Élément 3
Listes simples et ordonnées imbriquées : 
1. Élément 1
  * Sous-élément 1
  * Sous élément 2
2. Élément 2
3. Élément 3
```

#### Checkbox
```
- [x] Élément 1, coché
- [ ] Élément 2, non-coché
  - [x] Sous-élément 2.1, coché
  - [ ] Sous-élément 2.2, non-coché
- [ ] Élément 3, non-coché
```

#### Listes de définitions
```md
Terme 1
: Définition 1.1
Terme 2
: Définition 2.1
: Définition 2.2
```

#### Echapper les caractères spéciaux
```md
\\   : Anti-slash
\`   : Apostrophe curve
\*   : Asterisk
\_   : Low dash / Underscore
\{\} : Braces
\[\] : Hooks
\(\) : Parentheses
\#   : Sharp
\+   : Sign more
\-   : Less sign / hyphen
\!   : Exclamation dot
\.   : Dot
```

#### Citations 
```
> Ceci est une citation
> - Source
```

> Ceci est une citation
> - Source

#### Séparateur horizontal
***
`***`

#### Tableaux
A COMPLETER 

### Insérer une image
`![Texte alternatif](https://wprock.fr/wp-content/uploads/2018/11/wprock-wallpaper-wapuu-wordpress-paris-520x254.jpg "Titre, facultatif")`
### Insérer une vidéo
  A COMPLETER
 

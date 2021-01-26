# TODO

## file system
- hash filename to avoid security CSRF weaknesses

- [x] connection with SQL sb
- [x] creation files
- [x] set specific version
- [x] deletion
- [ ] compression

## lecture
- add themes
- extend/compact view (as Wikipedia mobile)
- ` scroll-behavior: smooth;`

# Features

## install
- create `install.php` and a `config.php`

## simple editor
- use MARKDOWN
- extra files

## summary
- add a summary for navigation


New todo
## tags fonctionnels 
- cliquer sur un tag affiche la liste des parents de ce tag classés par ordre (dé)croissant

## page d'accueil
- barre de recherche
    - une recherche affiche des tags classés par ordre de poids décroissants (même action que tag("recherche"))
- liste des tags 0 en front page

## login d'élève et de prof
- contrôle d'accès aux pages quizz (accessibles aux élèves et aux profs)
- contrôle d'accès aux pages write (accessibles aux profs)
- la lecture de pages de cours est accessible à tout visiteur

## QCM de validation de progression de cours
- validation de tag pour un user via QCM
- la validation ne s'opère que si tous les enfants sont validés
- une table sql relie le hashcode 

|h_code | question | rep1 | rep2 | rep3 | rep4 | correct_rep |
|-------|----------|------|------|------|------|-------------|
|aef0231|how to read| 'r' | 'w'  |  'o' | 'l'  |  rep1         |

## (optionnel) Dashboard de progression pour tout user, onglets
- pour les élèves, progression dans chaque tag en % affiché par ordre croissant de poids
- pour les professeurs, progression + liste de tags écrits et leur chemin
Voir dessin dans docs
# mentorat
Mentorat internes/externes - CNEM

# Mentorat Internes/Externes
> Copyright CNEM - Corporation Nantaise des Etudiants en Médecine

Projet développé pour la mise en place d'un système de mentorat entre les internes et externes Nantais.


**Première idée: inscription par un google Form.**

mais peut rapidement devenir compliqué à gérer même si il n'y a pas bcp de monde d’inscrits.

Donc mise en place d’un système de matching automatique. Actuellement développé, projet disponible sur https://www.la-cnem.org/Mentorat/

## Inscription des internes:
- Nom
- Prénom
- Adresse Email
- Numéro de téléphone
- Spécialité
- Numéro Etudiant
- Nombre de filleul(s) max (entre 1 et 5)
- Critères de choix après pour les externes:
  - Disponible sur Nantes (au moins partiellement en fonction des semestres)
  - Type de contact souhaité (rencontre ou texto sms skype…)
  - Fréquence des contacts (hebdomadaire, bi mensuel, mensuel, bi semestriel)
- Numéro Etudiant
- Description (facultative)


Puis une fois tous les internes inscrits, fermeture des inscriptions internes, ouverture des inscriptions externes.

## Inscription externes:
### Présentation:
- Nom
- Prénom
- Adresse Email
- Numéro de téléphone
- Numéro Etudiant            
### Je cherche un interne:
- Spécialité: uniquement dispo au choix celles où il y a des internes inscrit ET disponibles (nombre de filleul max pas atteint)  (ne marche pas actuellement)
- Type de contact souhaité
- Fréquence des contacts
- Disponible sur Nantes (au moins partiellement en fonction des semestres)
### Priorité des critères: (hiérarchisation des 3 critères)
- Priorité 1
- Priorité 2
- Priorité 3

Surlignage en rouge et refus d’envoi du formulaire si 2 priorités sont les mêmes.

Pour les internes comme pour les externes on se base sur le numéro étudiant pour éviter les doublons lors de l'inscription. Vérification du format correct du numéro étudiant par une régex en javascript.

Puis attribution automatique de l’externe à un externe selon comment il a rempli son formulaire.

## Explication de l’algorithme:
1. Envoie des données par le formulaire au serveur
2. Vérification des données: les données envoyées correspondent aux choix proposés. Sinon -> ECHEC
3. Si aucun interne de la spé choisi par l’externe dispo -> ECHEC
*Comment cette situation peut -elle être possible puisque l’externe n’a le choix que parmis les spé normalement encore disponibles?*
Car un autre externe à pu s’inscrire juste avant pdt le remplissage du formulaire prenant ainsi la dernière place dispo
4. Si présence d’un interne présentant les 3 critères requis (Type de contact souhaité, Fréquence des contacts, Disponible sur Nantes) -> ATTRIBUTION
5. Sinon si présence d’un interne présentant les 2 premiers critères requis  -> ATTRIBUTION
6. Sinon si présence d’un interne présentant le premier et le troisième critère requis-> ATTRIBUTION
7. Sinon si présence d’un interne présentant les deuxième et le troisième critère requis  -> ATTRIBUTION
8. Sinon si présence d’un interne présentant le troisième critère requis  -> ATTRIBUTION
9. (On a balayé l’ensemble des possibilité) Sinon attribution au hasard d’un interne.

### Situation spéciale des attributions au hasard:
L’attribution au hasard de l’interne ne se fera qu'à la fin, quand les inscriptions externes seront cloturées ou quand il n’y aura plus de place dispo.

**Pourquoi ?** Afin d’éviter que l’externe (imaginons qu’il prenne la dernière place dispo) prenne un interne qui aurait pu convenir à un autre externe qui s’est inscrit après.

**Comment ?** On tient le compte total des places dispo par spé (celui ci diminue au fur à mesure que les externes s’inscrivent).
Quand celui-ci est égal au nombre d’externes à attribuer au hasard, on attribue les externes au hasard et on ferme la spé.


## Page récapitulative:
#### Informations générales
- nombre d'internes et d’externes inscrits.
- nombre d'internes encore dispo
- détail des inscriptions
- Affichage par défaut de tous les internes inscrit et de leur internes
- Possibilité de n'afficher que les internes d’une certaine spé
- quand on choisi ça affichage d’un paragraphe récapitulant les info de la spé (nombres d'internes inscrit, nombre d’internes dispo)
- Possibilité de n'afficher que les internes dispo

#### Graphisme
- responsive design du formulaire: la majorité des utilisateurs seront sur portable
- basé sur un template bootstrap: https://startbootstrap.com/themes/freelancer/

## Installation
### Base de données
3 tables: internes, externes, spécialités
contenu dans mentorat.sql

js personnalisé dans dossier src/js :
- formulaire: page externe
- liste inscrit : liste des internes

## A faire:

Explication de l’algorithme aux étudiants sur la page d’inscription.

Au niveau de l’attribution,
envoi auto de l’email à l’externe
Pour l’interne:
soit envoie d’un mail pour chaque filleul qui s’inscrit mais spam
soit une fois le nombre max de filleul atteint et/ou une fois les inscriptions internes clôturées envoi auto d’un seul mail à l’interne avec les infos sur ses filleuls
Tenir compte des limites d'envoie serveur

Page de lecture:
liste déroulante spé internes: mettre les spés non disponibles en rouges
désactiver la sélection des spé en rouge sur la page lecture
développer la page de lecture des inscrits (tenir compte des externes inscrit au hasard)


Optimisation de l’algorithme pour économiser le serveur.
Actuellement récupération des infos de la bdd dans un tableau puis parcours du tableau pour chaque condition tant que l’interne n’est pas trouvé. très consommateur de ressources.
Plus économe niveau serveur de faire une requête SQL à chaque fois, plutôt que de faire une seul?
Vérifier les doublons sur plus de chose que le num étudiant

Mise en place d’une page de gestion : ajout, suppression, modification des tables interne et externe sans avoir à passer par phpmyadmin (penser à la table spé à mettre à jour en même tps).

Mises à jour régulières sans recharger la page (ajax) de la liste déroulante des spés pour éviter au max la situation présentée plus haut.

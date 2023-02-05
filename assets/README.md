# Idée architecture

## Structure de dossier

### assets

Contient les fichiers de styles, images et police de fonte qui vont être utilisés dans l'application. 
Le fichier principal pour les styles est `main.css`, les autres fichiers css vont être tous être importé depuis ce fichier

Vu que `main.css` va être chargé depuis `main.js` étant l'entrée principale de l'application, tous les autres styles importés vont être disponible partout dans l'application.

### components (composant globaux)

Regroupe les composants réutilisables et qui ne sont pas reliées au domaine de l'application
ex : composant de formulaire, outils de présentation, modal dialog etc ...

Ces composants peuvent importer leur propre feuille de style depuis le même dossier (styled component)

### modules

Les modules représentent une granularité plus fine du domaine et donc régissent des règles métiers qui leur sont propres

### modules/<module-name>/actions

Ce sont les actions des reducers de redux, leurs fonctions consist seulement à mutter les états du store disponibles en globale 

### modules/<module-name>/components

C'est ici que les composants spécifiques du domaine (et donc du module courant) sont configurés. Il faut noter qu'aucune logique métier ne doit 
fuiter ici, seulement les logiques de présentation comme les animations résultant de l'interaction de l'utilisateur.

Tout comme les composants réutilisables, il est possible d'ajouter des feuilles de styles qui leur sont propres

Les composants de modules ne peuvent être réutilisés par les composants globaux sinon ils vont perdre leur nature de réutilisation

### modules/<module-name>/components 

Ici, il est question de souscrire à des event de dom et par la suite effectuer des actions. Il faut noter que ces actions ne doivent pas modifier l'état global de l'application,
car dans ce cas, il est serait très difficile de savoir l'origine du changement

À utiliser donc avec modération

### ### modules/<module-name>/useCases

Ce sont en principe des customs hook arrachés aux composants du module, cella permet de les réutiliser dans un autre composant de module. Ce sont d'ailleurs ces hooks
qui définissent les métiers de l'application (business logic)
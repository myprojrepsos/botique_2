# Boutique
Basic website for Shop Online (Backoffice, payment system, mail system)

## Projet personnel E-commerce

Créer avec Symfony 5 et Bootstrap 4

## Tableau de content


## Installation

- [PHP7](https://windows.php.net/download#php-7.2)
- [Composer](https://getcomposer.org/download/)
- [Symfony 5](https://symfony.com/download)
- [MySQL](https://www.mysql.com/downloads/)
- Clone le projet: ```git clone https://github.com/XiaoEbisu/Boutique.git ```
- Installer les dépendences: ```composer install```
- Configurer la base de données dans le fichier ```.env```
- Mettre à jour le base de données: ```symfony console make:migration``` puis ```symfony console doctrine:migrations:migrate```
- Démarrer le serveur: ```symfony serve```
- Rendez-vous sur ```localhost:8000```


## Fonctionnalités

- Inscription/Connexion/Déconnexion
- Mot de pass oublié
- Gestion du compte (Changer mot de passe, carnet d'addresses, suivi des commandes)
- Page d'accueil
- Produits en liste/détail
- Filtre des produits
- Panier
- Récapitulatif de la commande
- Paiement (API Stripe)
- Notification par mail (API Mailjet)
- Contacter-nous
- Gestion des pages errors

## Images de demo

|![Page d'accueil.](https://raw.githubusercontent.com/XiaoEbisu/Boutique/main/public/readmeimg/home-page.png)|
|:--:|
|*Page d'accueil*|

|![Produits.](https://raw.githubusercontent.com/XiaoEbisu/Boutique/main/public/readmeimg/produits.png)|
|:--:|
|*Page des produits avec filtre système*|

|![Panier.](https://raw.githubusercontent.com/XiaoEbisu/Boutique/main/public/readmeimg/Panier.png)|
|:--:|
|*Passer une commande*|

|![Paiement.](https://raw.githubusercontent.com/XiaoEbisu/Boutique/main/public/readmeimg/paiement.png)|
|:--:|
|*Paiement avec API Stripe*|

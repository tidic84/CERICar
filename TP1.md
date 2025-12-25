# TP 1
## 2.Prise en main et compréhension de la structure MVC
### Description des sous dossiers:

- assets/ Le dossier assets sert a gérer les fichiers statiques comme le css et le js

- config/ Le dossier config est le dossier contenant toutes les configurations qui seront importés comme par exemple la configuration de la db.

- controllers/ Le dossier controllers contient tous les controlleurs qui servent a faire la synchronisation entre les vues et les modeles. Ils doivent traiter les requêtes et de générer les réponses

- models/ Le dossier models contient tous les fichiers modèl représentent les données à traiter, les règles et la logique. 

- views/ Le dossier views contient les vues qui sont les interfaces avec les quelles l'utilisateur intéragit.
    Ce dossier comporte 2 sous dossiers qui sont layout et site
    - views/layouts/ Le sous dossier layouts contient les parties communes.
    - views/site/ Le sous dossier site contient les différentes pages.

- widgets/ Le dossier widget contient les composants réutilisables et configurable.

### Map du login demo

#### Affichage de la page login (GET)
L'utilisateur clique sur "Login" dans le menu -> URL: site.com/web/index.php?r=site%2Flogin
    |-> web/index.php (point d'entrée)
        |-> Framework Yii2 analyse l'URL (routing)
            |-> appelle controllers/SiteController.php
                |-> méthode actionLogin()
                    |-> crée une instance de models/LoginForm.php
                    |-> appelle views/site/login.php (avec le modèle)
                        |-> s'affiche dans views/layouts/main.php (layout)
                            |-> retourne le HTML au navigateur

#### Soumission du formulaire (POST)
User clique sur le bouton login
    |-> POST vers site.com/web/index.php?r=site%2Flogin (avec username et password)
        |-> controllers/SiteController.php
            |-> méthode actionLogin()
                |-> charge les données POST dans models/LoginForm.php
                    |-> appelle $model->login()
                        |-> valide les données (rules())
                        |-> appelle validatePassword()
                            |-> cherche l'utilisateur avec models/User.php
                            |-> si OK:
                                |-> crée la session
                                |-> redirige vers la page d'accueil
                            |-> si erreur: retourne au formulaire avec message d'erreur

#### Fichiers framework Yii2 utilisés
- vendor/yiisoft/yii2/Yii.php
- vendor/yiisoft/yii2/web/Application.php
- vendor/yiisoft/yii2/web/Controller.php
- vendor/yiisoft/yii2/base/Model.php
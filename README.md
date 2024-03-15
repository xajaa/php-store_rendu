# PHP - CNAM 2024

## Base de données - Configuration

Créer un fichier `db.ini` dans le dossier `config`, inscrire ensuite vos propres données de configuration :

```ini
HOST=127.0.0.1
PORT=3306
DB_NAME=db_name
CHARSET=utf8mb4
USER=user
PASSWORD=pass
```


```
Partie authentification utilisateur: 

Les classes et fonctions fournies sont essentielles pour gérer l'inscription et la connexion des utilisateurs. La classe User contient des méthodes pour ces opérations. La page register.php présente un formulaire d'inscription où les utilisateurs peuvent entrer leurs informations. Lors de la soumission du formulaire, les données sont validées et utilisées pour créer un nouvel utilisateur. En cas de succès, l'utilisateur est redirigé vers la page de connexion. De manière similaire, la page login.php affiche un formulaire de connexion et utilise la classe User pour vérifier les informations fournies. Si les informations sont correctes, l'utilisateur est connecté à l'application.
la fonction checkLogin/php permet elle de vérifier si l'utilisateur est connecté ou non et donc lui demande de se connecter s'il ne l'est pas. 

Partie UploadImage: 

J'ai créé une classe ImageUpload pour pouvoir appeler ma classe qi me permet de créer des objets qui seront lié à mes catégories et qui lieront mes images avec certains formats accepté pour ne pas avoir autre chose que des images.
Une classe ProductService qui elle me permet du coup de lié mon image à ma catégorie selectionnée.
Cependant je n'arrive pas à enregistrer mon image pour pouvoir a réafficher, je n'ai pas compris comment je pouvais l'ajouter dans ma base de donné pour pouvoir la réutiliser sous format http.
Même en regardant avec ChatGPT, j'ai trouvé quelques solutions qui au final m'ont plus perdu qu'aidé.
```
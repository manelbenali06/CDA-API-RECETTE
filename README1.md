### TOKEN 
-> requette post/auth pour recuperer  le token en utilisant les identifiants 
-> toujour faire tourner le serveur de mon projet -> obtenir les logins user/admin
# qu'on reccupere qu'on lance le server symfony serve et qu'on vadans la page login:
john_user	kitten	ROLE_USER (utilisateur normal)	
jane_admin	kitten	ROLE_ADMIN (administrateur)
# DANS API PLATFORM POUR AUTHORIZE ON ECRIT BIEN : bearer(espace)(cléTken)
# ET DANS POSTMAN:
# ALLEZ DANS AUTHORIZATION ->choisir bearer token -> mettre la clé de admin ou de user tout # dépend de la requette et des acces 
### ADMIN:les token durent une heure ils faut les regenerer pour essayer les requettes
eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2ODE5MTQ1MjUsImV4cCI6MTY4MTkxODEyNSwicm9sZXMiOlsiUk9MRV9BRE1JTiJdLCJ1c2VybmFtZSI6ImphbmVfYWRtaW4ifQ.QeSWtXtVCCZMAs9tvDgmim4wpH-DYm9UE7ts7K-xsoZajZ1AS5BHNOylE28eWQsLElZRK9K3Ug7RMaGPk6Mg_kDkFIKsJx13gBrjiEGIdsPh2bq4Btte-BJ82ihGmXe3RYpEd2Yb8a0qh-Es_ytpQsMXnk4qqAro-Nu1r9yQM20E_jJUCXwRMvCpbEOr-od0yISl92FUAgez2lW7OEblh70EAijWNy19FeAUEjcjWApS2T9xzvg9tcD_XVsJmvrtzxD79wtnvEqCZkhEao4wy33C3xgVT2qtc-N7C5h_Ex0sA-8KoMgfMkZuuLYewx5q2Xp2iX1eR8t2HN7rbR4Phg
### USER:
eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2ODE5MTQ1NzksImV4cCI6MTY4MTkxODE3OSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoiam9obl91c2VyIn0.VyjvIzUjOV0X_RueTi9qXSkMoxMX237TLtntpet6QCNl7RGrXSEh73zXjBeCa6dpeyCJO_ql3vYboAdy_OmL1o-YlosOyIJurVYN1oWnfqKLbWCFI-Akj9jpbhQR9uQnFQTmpx9clugwuV91QqrL5zU2xmYttb9zh1bmTawWkqw6GRy-68UqsF-qb1e6-0iiiL2msGiEWEbbHx5_KZRbpEVj8fMoVWlKD-gC-JcGThyS8etuRiGlcdxOjXebRowHva6IMNBB5M9SS4n259MAhHQPAhAT6rLU7U-galxfVu2m6VbufKLRav5mGWpmUzfwHcMZQPTTUl4lDJxpCAcEvQ


 ### Role: php bin/console debug:router (voir toutes les requettes)                  
    Name                                    Method          ROLES 
_api_/users/{id}{._format}_get              GET             ADMIN OR OWNER(utilisateur inscrit)      ME             
_api_/users/{id}{._format}_post             POST            PUBLIC              Register
_api_/users/{id}{._format}_put              PUT             ADMIN OR OWNER      Profil 
_api_/users/{id}{._format}_delete           PUT             ADMIN OR OWNER      Suppression de compte

_api_/tags/{id}{._format}_get               GET             PUBLIC    (Affihage d'un tag)
_api_/tags{._format}_get_collection         GET             PUBLIC    (liste de tag pour filtres)
         

_api_/comments/{id}{._format}_get           GET            PUBLIC     (commentaire détaillé)
_api_/comments{._format}_post               POST           USER       (Ajoutre un commentaire)
_api_/comments/{id}{._format}_put           PUT            ADMIN OR OWNER  (modifier son propre commentaire)
_api_/comments/{id}{._format}_delete        DELETE         ADMIN OR OWNER

_api_/posts/{id}{._format}_get             GET            PUBLIC    Article détaillé
_api_/posts{._format}_get_collection       GET            PUBLIC    Page d'acceuil
_api_/posts{._format}_post                 POST           USER      Proposition d'article
_api_/posts/{id}{._format}_put             PUT            ADMIN OR OWNER (modif d'article)
_api_/posts/{id}{._format}_delete          DELETE         ADMIN OR OWNER (suppression d'articles)

### Explication
_récupérer les informations d'un utilisateur identifié par son identifiant unique (id) dans l'API.
_récupérer une collection de tous les utilisateurs disponibles.
_un Admin a le droit de  créer un nouvel utilisateur 
_un Admin a le droit de modifier  les informations d'un utilisateur spécifique identifié 
_un Admin a le droit de supprimer chaque d'un utilisateur spécifique identifié


_récupérer les détails d'un tag spécifique identifié par son identifiant unique (id).
_ récupérer une collection de tous les tags disponibles.



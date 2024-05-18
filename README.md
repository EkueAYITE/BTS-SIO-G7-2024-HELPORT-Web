- PHP 7.4 ou supérieur
- Composer
- Symfony CLI (facultatif, mais recommandé)

# Mon Projet Symfony

## Installation

Clonez le dépôt, configurez les variables d'environnement, installez les dépendances, installez Symfony Mailer et Lexik JWT Authentication Bundle, et générez la paire de clés JWT :

```bash
git clone https://github.com/votre-utilisateur/votre-repo.git && \

```
### Copier le fichier .env.example en .env et mettre à jour les variables nécessaires :
#Configurer les variables d'environnement :

```bash 
cp .env.example .env
```
### Mettez à jour les variables dans .env selon votre configuration
```bash
run composer install  
```
### Installer Symfony Mailer et Lexik JWT Authentication Bundle :
```bash
composer require symfony/mailer && \
composer require lexik/jwt-authentication-bundle && 
```
### Générer la paire de clés JWT :
```bash 
php bin/console lexik:jwt:generate-keypair 
```
 Cela créera des fichiers config/jwt/private.pem et config/jwt/public.pem. Assurez-vous que ces fichiers sont bien protégés et ajoutez leur chemin dans votre fichier .env :

````bash
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=your-passphrase
````
### Autres configurations (si nécessaire):
```bash 
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```
## Utilisation
```bash 
symfony server:start
```
# Merci d'avoir utilisé notre projet Symfony !




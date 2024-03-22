composer require symfony/mailer
composer require symfonycasts/dynamic-forms
composer require fakerphp/faker
composer require lexik/jwt-authentication-bundle
Ajouter au path openssl 

ajouter au .env si il n'y est pas
                ###> lexik/jwt-authentication-bundle ###
                JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
                JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
                JWT_PASSPHRASE=9f5eca58f3cfc72d6fd2faf1eae9dcda611e241ea58e5884afd4f53298817ac0
                ###< lexik/jwt-authentication-bundle ###

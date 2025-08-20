bin/console make:entity
php bin/console make:entity
composer require symfony/maker-bundle --dev
php bin/console make:entity
php bin/console make:migration
php bin/console doctrine:migrations:migrate
exit

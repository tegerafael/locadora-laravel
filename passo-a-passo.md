# Comando para criar o projeto

laravel new locadora-laravel

# Criando model, migration e controller com resources básicas definidas

php artisan make:model -mcr Marca
php artisan make:model -mcr Modelo  
php artisan make:model -mcr Carro

# Opção para criar model, migration, controller, factory, seeder, requests and policy

php artisan make:model --all Cliente

# Implementar migrations, lembrando sempre dos nomes de tabelas e chaves

# É importante mapear todas apiResources para que ele identifique automaticamente

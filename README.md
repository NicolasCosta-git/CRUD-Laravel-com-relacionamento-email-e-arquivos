# Sobre o projeto
Feito em Laravel 7.29

Características:
* CRUD
* Sistema de e-mails;
* sistema de roles;
* envio de arquivos;
* relação entre tabelas;
* recuperação de senha;
* conexão com api.

O usuário pode:
* registrar e fazer log-in;
* editar detalhes do seu perfil;
* registrar pedidos;

Os pedidos são únicos para cada usuário, apenas ele e a conta administradora consegue ver.

## Execução
Após baixar o arquivo, renomear o .env.example para .env, configurar os campos de database e email. 
Após isso, abra o local da pasta no terminal e rode `composer install` para instalar as dependências, depois, rode `php artisan key:generate`, crie a database e rode `php artisan migrate:fresh --seed`, `php artisan passport:install`, `php artisan passport:client --personal`, `php artisan storage:link` e por fim `php artisan serve` para iniciar o servidor. Para o cliente fazer o pedido, a conta administradora deve adicionar pizzas antes.

A conta admin tem as seguintes credenciais ->
Email: `pizzeria@admin.com`
Senha: `pizzeria`

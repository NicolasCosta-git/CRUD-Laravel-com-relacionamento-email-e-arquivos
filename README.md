# Sobre o projeto
CRUD feito em Laravel 7.29

Características:
* Envio automático de e-mail;
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
Após isso, abra o local da pasta no terminal e rode `composer install` para instalar as dependências, depois, rode `php artisan key:generate`, `php artisan migrate --seed`, `php artisan passport:install`, `php artisan passport:client --personal` e por fim `php artisan serve` para iniciar o servidor.

A conta admin tem as seguintes credenciais:
Email: `pizzeria@admin.com`
Senha: `pizzeria`

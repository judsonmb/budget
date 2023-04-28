# Budget

## Requisitos para instalação

- composer
- php 8

## Passos para instalação

### clone este projeto para sua máquina local
- `https://github.com/judsonmb/budget.git`

### crie um arquivo .env copiando o que tem em .env.example. Em Linux:
- `cp .env.example .env`

### crie um banco de dados local e preencha as informações de banco de dados corretas em seu .env das seguintes variáveis

- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

### ainda no .env, substitua as informações abaixo por uma conta de email. já está configurado para o gmail, mas pode-se utilizar outro serviço.

- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_FROM_ADDRESS`

### rode a instalação das dependências.

- `composer install`

### popule o banco com as tabelas e com os dados de browsers em seeders.

- `php artisan migrate --seed`

### para fazer testes com as rotas, acione o server.

- `php artisan serve`

## Informações importantes: 

### caso não queira utilizar o serviço de envio de email no momento, comente as seguintes linhas.

- `app/Providers/EventServiceProvider.php:30`
- `tests/Feature/BudgetStoreStepTwoTest.php:60 a 63, 103 a 106, 146 a 149`

### utilize o comando abaixo para rodar os testes
- `php artisan test`

### caso dê erro no envio de email do gmail, talvez precise criar uma senha de app na google account, para isto:
- acesse myaccount.google.com;
- clique em segurança;
- clique em verificação em duas etapas;
- no final da página, onde tem senhas de app, clique em senhas de app e crie uma;
- a senha criada é a que deverá ser usada na variável `MAIL_PASSWORD`

### principais rotas: 
- `GET /api/browsers`
- `GET /api/customers`
- `POST /budget/step/one`
- `POST /budget/step/two`
# :computer: Desafio - CRUD USUARIOS  :computer:
## Visão Geral
Este é um projeto de um sistema CRUD (Create, Read, Update, Delete) desenvolvido em Laravel. O sistema permite gerenciar usuários, seus endereços e informações de login, com autenticação de usuário.

## Requisitos
- **PHP >= 8.0**
- **Composer**
- **MySQL**
- **Node.js e NPM (para gestão de dependências front-end e compilação de assets)**
- **Laravel 11.18.1**

## Instalação
1. Clone o repositório:
```
git clone https://github.com/seu-usuario/desafio-crud.git
cd desafio-crud
```
2. Instale as dependências do PHP:
```
composer install
```
3. Instale as dependências do Node.js:
```
npm install
```
4. Crie um arquivo .env baseado no .env.example:
```
cp .env.example .env
```
5. Configure o arquivo .env com as informações do seu banco de dados:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```
6. Gere a chave da aplicação:
```
php artisan key:generate
```
7.Execute as migrações e seeders para criar e popular o banco de dados:
```
php artisan migrate --seed
```
## Execução
1. Inicie o servidor de desenvolvimento:
```
php artisan serve
```
2. Compile os assets:
```
npm run dev
```
## Funcionalidades
### Autenticação
- **Registro de novos usuários.**
- **Login de usuários existentes.**
- **Logout de usuários.**

### Gestão de Usuários
- **Criação de novos usuários.**
- **Listagem de usuários.**
- **Edição de usuários (incluindo endereço e informações de login).**
- **Exclusão de usuários.**

### Gestão de Endereços
- **Adição, edição e exclusão de endereços vinculados aos usuários.**

## Estrutura do Banco de Dados

### Tabelas
- **usuarios**
- **enderecos**
- **logins**
- **login_usuario**(tabela de ligação entre usuarios e logins)

### Esquema
```
Schema::create('usuarios', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->string('email')->unique();
    $table->string('telefone')->nullable();
    $table->string('celular')->nullable();
    $table->string('cpf')->unique();
    $table->timestamps();
    $table->softDeletes();
});

Schema::create('enderecos', function (Blueprint $table) {
    $table->id();
    $table->string('rua');
    $table->string('cidade');
    $table->string('estado');
    $table->string('cep');
    $table->string('numero')->nullable();
    $table->string('bairro')->nullable();
    $table->string('complemento')->nullable();
    $table->unsignedBigInteger('usuario_id');
    $table->timestamps();
    $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
});

Schema::create('logins', function (Blueprint $table) {
    $table->id();
    $table->string('email')->unique();
    $table->string('senha');
    $table->string('nivel')->default('normal');
    $table->timestamps();
});

Schema::create('login_usuario', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('usuario_id');
    $table->unsignedBigInteger('login_id');
    $table->timestamps();
    $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
    $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade');
});
```
### Testes
1. Instale o PHPUnit, se ainda não estiver instalado:
```
composer require --dev phpunit/phpunit
```
2. Execute os testes:
```
php artisan test --filter=RegistroTest
```
## Licença
Este projeto está licenciado sob os termos da licença MIT.

Esse README cobre as funcionalidades principais do projeto e fornece instruções detalhadas para instalação, configuração e contribuição. Ajuste conforme necessário para refletir mais detalhes específicos do seu projeto.
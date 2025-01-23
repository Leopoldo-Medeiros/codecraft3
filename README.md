# Codecraft versão 2

Este projeto é uma aplicação que integra o framework Laravel 11 para o backend e Next.js para o frontend, utilizando Lando como ambiente de desenvolvimento local.

## Tecnologias Utilizadas

- **Laravel 11**: Framework PHP para o backend.
- **Next.js**: Framework React para o frontend.
- **Lando**: Ferramenta para gerenciamento do ambiente de desenvolvimento.
- **MySQL**: Banco de dados utilizado.

## Estrutura do Projeto

### Backend (Laravel 11)

Localizado na pasta raiz do projeto.

- Rotas definidas para autenticação, gerenciamento de usuários, perfis e permissões.
- API protegida utilizando Laravel Sanctum para autenticação via token.

### Frontend (Next.js)

Localizado na pasta `frontend`.

- Componentes reutilizáveis em `src/components`.
- Gerenciamento de autenticação em `src/contexts/AuthContext.js`.
- Integração com APIs do backend em `src/services`.

## Requisitos para Rodar o Projeto

- [Lando](https://lando.dev/): Instalado e configurado.
- [Node.js](https://nodejs.org/): Recomendado Node 20.
- [Composer](https://getcomposer.org/): Para gerenciar as dependências do Laravel.
- [npm](https://www.npmjs.com/): Para gerenciar as dependências do Next.js.

## Configuração do Projeto

### Clone do Repositório

```bash
git clone <url-do-repositorio>
cd <nome-do-repositorio>
```

### Configuração do Lando

Certifique-se de que o arquivo `.lando.yml` está configurado corretamente. Exemplo:

```yaml
name: laravel-next-app
recipe: laravel
config:
  php: '8.3'
  database: mysql:8.0
  node: '20'
services:
  appserver:
    type: php-nginx
  database:
    type: mysql
```

Inicialize o ambiente:

```bash
lando start
```

Acesse o ambiente:

```bash
lando ssh
```

### Configuração do Backend (Laravel 11)

1. Instale as dependências:
   ```bash
   composer install
   ```
2. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, incluindo as credenciais do banco de dados.
3. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```
4. Rode as migrações e seeds:
   ```bash
   php artisan migrate --seed
   ```

O backend estará disponível em: [http://laravel.lndo.site](http://laravel.lndo.site).

### Configuração do Frontend (Next.js)

1. Navegue até a pasta do frontend:
   ```bash
   cd frontend
   ```
2. Instale as dependências:
   ```bash
   npm install
   ```
3. Crie o arquivo `.env.local` e configure as variáveis de ambiente. Exemplo:
   ```env
   NEXT_PUBLIC_API_URL=http://laravel.lndo.site/api
   ```
4. Inicie o servidor de desenvolvimento:
   =======

## Sobre o Projeto

Este projeto combina as tecnologias Laravel 11 para o backend e Next.js para o frontend, proporcionando uma aplicação moderna e escalável. A integração permite o consumo de APIs Laravel no frontend desenvolvido com Next.js.

## Estrutura do Projeto

- **Backend**: Laravel 11
  - Localizado na raiz do projeto.
  - Gerencia a lógica de negócios e fornece APIs RESTful.
- **Frontend**: Next.js
  - Localizado na pasta `frontend/`.
  - Consome as APIs fornecidas pelo Laravel.

## Requisitos

- Docker e Lando instalados.
- Node.js (versão 20 ou superior).
- Composer.

## Configuração do Ambiente

### Backend (Laravel)

1. **Configuração do `.env`**
   Certifique-se de que o arquivo `.env` do Laravel contém as configurações corretas. Aqui está um exemplo:

   ```env
   APP_NAME=codecraft2
   APP_ENV=local
   APP_KEY=base64:J6nwCWbb4Y0o4Pmg9p2rfVWs3GTz2v5FiMVYgKBw00k=
   APP_DEBUG=true
   APP_URL=https://codecraft2.lndo.site

   DB_CONNECTION=mysql
   DB_HOST=database
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=laravel
   ```
2. **Subindo o ambiente Laravel**
   Execute os comandos abaixo na raiz do projeto para iniciar o ambiente Laravel:

   ```bash
   lando start
   lando artisan migrate
   lando artisan serve
   ```

   O backend estará disponível em: `https://codecraft2.lndo.site`.

### Frontend (Next.js)

1. **Configuração do `.env.local`**
   Crie um arquivo `.env.local` dentro da pasta `frontend/` com a seguinte variável:

   ```env
   NEXT_PUBLIC_API_URL=http://laravel.lndo.site/api
   ```
2. **Instalando dependências**
   Navegue até a pasta `frontend/` e instale as dependências:

   ```bash
   cd frontend
   npm install
   ```
3. **Iniciando o servidor de desenvolvimento**
   Ainda na pasta `frontend/`, execute:
```bash
npm run dev
```
O frontend estará disponível em: [http://localhost:3000](http://localhost:3000).

## Funcionalidades Implementadas

### Backend

- **Autenticação**: Login, registro, recuperação de senha.
- **Gerenciamento de Usuários**: Listar, criar, editar e deletar.
- **Perfis e Permissões**: Gerenciamento de perfis e permissões relacionados a usuários.

### Frontend

- **Páginas**:
  - Login e Registro.
  - Listagem de Usuários.
- **Proteção de Rotas**: Apenas usuários autenticados têm acesso a determinadas páginas.
- **Componentes Reutilizáveis**: Navbar, formulários dinâmicos, etc.

## Comandos Úteis

### Lando

- Iniciar o ambiente:
  ```bash
  lando start
  ```
- Parar o ambiente:
  ```bash
  lando stop
  ```
- Acessar o terminal do container:
  ```bash
  lando ssh
  ```

### Backend (Laravel)

- Executar migrações:
  ```bash
  php artisan migrate
  ```
- Rodar testes:
  ```bash
  php artisan test
  ```

### Frontend (Next.js)

- Iniciar o servidor de desenvolvimento:
  ```bash
  npm run dev
  ```
- Construir para produção:
  ```bash
  npm run build
  ```

## Observações

Certifique-se de que os serviços Lando estão rodando antes de iniciar o frontend ou o backend. Qualquer dúvida, consulte a [documentação oficial do Lando](https://docs.lando.dev/).
=========================================================================================================================================================================================

O frontend estará disponível em: `http://localhost:3000`.

## Como Rodar o Projeto

1. Clone este repositório.
2. Certifique-se de que o Lando e Node.js estão instalados.
3. Configure o ambiente do backend e frontend seguindo as instruções acima.
4. Suba os dois servidores (Laravel e Next.js).

## Funcionalidades

### Backend (Laravel)

- APIs para autenticação (login, registro, reset de senha).
- Gerenciamento de usuários, perfis e permissões.

### Frontend (Next.js)

- Telas:
  - Login e Registro.
  - Listagem e gerenciamento de usuários.
- Integração com as APIs Laravel.
- Proteção de rotas baseada em autenticação.

## Estrutura de Pastas do Frontend

```
frontend/
├── pages/
│   ├── index.js (Home)
│   ├── login.js (Tela de Login)
│   ├── register.js (Tela de Registro)
│   ├── users.js (Listagem de Usuários)
├── components/
│   ├── Navbar.js (Barra de Navegação)
│   ├── UserForm.js (Formulário de Usuários)
│   ├── ProfileSelector.js (Seleção de Perfis)
├── services/
│   ├── auth.js (Funções de Autenticação)
│   ├── user.js (CRUD de Usuários)
├── contexts/
│   ├── AuthContext.js (Gerenciamento de Estado de Autenticação)
```

## Licença

Este projeto é distribuído sob a licença MIT.

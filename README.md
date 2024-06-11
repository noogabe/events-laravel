# Projeto de gerenciamento de eventos 
## Pré-requisitos
* [Composer](https://getcomposer.org/download/)
* [Xampp (Apache, PHP e Mysql)](https://www.apachefriends.org/download.html)

## Instalação
1. **Clone o repositório**
 ```bash
 git clone git@github.com:noogabe/events-laravel.git
 ```

2. **Instale as dependências**
```bash
composer install
```

3. **Crie um arquivo chamado .env e copie e cole o contéudo de env.example**

4. **Inicie o Xampp**

5. **No Mysql, em http://localhost:80/phpmyadmin/ crie um banco de dados chamado 'events'**

6. **Execute as migrações**
```bash
php artisan migrate
```

7. **Inicie o servidor**
```bash
php artisan serve
```


## Aprendendo Laravel 7.0.0

### Configurando novo projeto
* Instalar Composer
* Xampp (Apache, PHP e Mysql)

Criar projeto Laravel
`composer create-project laravel/laravel --prefer-dist NomeProjeto`

Ou (usando a versão 7 do Laravel)
`composer create-project laravel/laravel=7 --prefer-dist NomeProjeto`


### Iniciando um servidor com artisan
Para visualizar projeto no navegador

`php artisan serve`


### Routing
O Routing no Laravel permite que você roteie todas as solicitações de sua aplicação para seu controlador apropriado. As rotas principais e primárias do Laravel reconhecem e aceitam um URI (Uniform Resource Identifier) junto com um closure, visto que deve ser uma forma simples e expressiva de roteamento. Todas as rotas do Laravel são definidas em seus arquivos de rotas, que estão localizados no diretório **routes**. Esses arquivos são carregados automaticamente pelo framework. Para iniciar a maioria dos aplicativos, você começará definindo rotas em seu arquivo routes/web.php. As rotas definidas em routes/web.php podem ser acessadas digitando a URL da rota definida em seu navegador. 

Fluxo da aplicação
1. Definir rota
2. Criar Controller
3. Controller busca dados no Model
4. Usar retorno do controller na View


### Middleware
O Middleware é apenas um mecanismo de filtragem de requisição HTTP. Ou seja, ele permite ou barra determinados fluxos de requisição que entram na sua aplicação, baseado em regras definidas. Por exemplo, o Laravel inclui um middleware que verifica se o usuário do seu aplicativo está autenticado. Se o usuário não estiver autenticado, o middleware redirecionará o usuário para a tela de login. No entanto, se o usuário for autenticado, o middleware permitirá que a solicitação continue na aplicação. Existem vários middlewares incluídos no framework Laravel, incluindo middleware para autenticação e proteção CSRF. Todos esses middlewares estão localizados no app/Http/Middlewarediretório.

Para criar um novo middleware
`php artisan make:middleware NomeMiddleware`

* Middlewares podem fazer qualquer tipo de verificação
* Podemos imaginar o middleware como uma série de solicitações HTTP de "camadas" que devem passar antes de atingirem seu aplicativo
* Cada camada pode examinar a solicitação e até rejeitá-la completamente


### Views
Blade é o Template Engine do Laravel, ele oferece a possibilidade de deixar views dinâmicas exibindo tags HTML e também outros dados que podem vir do banco de dados. As Views são renderizadas pelo Blade e são sua responsabilidade.
* Possibilidade de criar condições, laços de repetição, etc
* Comentário: {{-- Comentario não é renderizado nem pra view --}}
* Podemos criar um layout padrão: main.blade.php, onde podemos colocar tudo o que for comum a todas as views
* Nas outras views, basta recuperar o main e inserir seu respectivo conteúdo



### Controllers
Contém quase toda a lógica da aplicação

Criando um Controller

`php artisan make:controller NomeController`



### Model
A configuração do banco de dados é feita no arquivo .env. Esse arquivo não é versionado por segurança. Eloquent é a ORM (Object Relational Map) do Laravel, ela é responsável pela conexão com o banco de dados e representa a abstração de uma Query. 
* select
* insert
* update
* delete

Cada tabela possui um Model que é responsável pela interação entre requisições do bd. A convenção par o Model é o nome da entidade no singular (Event), enquanto a tabela é no pural (events). No Model são feitas poucas alterações nos arquivos, geralmente configurações específicas.


### Migrations
As migrações são como controle de versão para seu banco de dados, permitindo que sua equipe defina e compartilhe a definição do esquema de banco de dados do aplicativo. 
* Versionamento do banco de dados
* Podemos avançar e retroceder para outra versão a qualquer momento (migrate e rollback)
* Criação de tabelas
* Adicionar, remover e modificar colunas de forma facilitada
* Configurar um db de uma nova instalação em apenas um comando (migrar dados)
* `php artisan migrate`
* Criar nova migration
`php artisan make:migration nome_da_migration_table`
* Verificar status das migrations 
`migrate:status`

Para adicionar coluna à tabela existente é necessário fazer nova migration para não perder dados existentes na tabela

`php artisan make:migration add_coluna_to_nometabela_table`

Devemos especificar a nova coluna nos métodos up e down da classe da nova migration

Para alterar coluna já existente, devemos instalar pacote doctrine/dbal para depois criar uma nova migration com as especificações da alteração desejada
`composer require doctrine/dbal`




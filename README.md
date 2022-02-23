# Aprendendo Laravel 7.0.0

## Configurando ambiente
* Instalar Composer
* Xampp (Apache, PHP e Mysql)

Criar projeto Laravel
`composer create-project laravel/laravel --prefer-dist NomeProjeto`

Ou (usando a versão 7 do Laravel)
`composer create-project laravel/laravel=7 --prefer-dist NomeProjeto`

&nbsp;

## Iniciando um servidor com artisan
Para visualizar projeto no navegador

`php artisan serve`

&nbsp;

## Views
Blade é o Template Engine do Laravel, ele oferece a possibilidade de deixar views dinâmicas exibindo tags HTML e também outros dados que podem vir do banco de dados. As Views são renderizadas pelo Blade e são sua responsabilidade.
* Possibilidade de criar condições, laços de repetição, etc
* Comentário: {{-- Comentario não é renderizado nem pra view --}}
* Podemos criar um layout padrão: main.blade.php, onde podemos colocar tudo o que for comum a todas as views
* Nas outras views, basta recuperar o main e inserir seu respectivo conteúdo

&nbsp;

## Controllers
Contém quase toda a lógica da aplicação

Criando um Controller

`php artisan make:controller NomeController`

Fluxo
1. Definir rota
2. Criar controller
3. Controller busca dados no Model
4. Usar retorno do controller na view

&nbsp;

## Model
A configuração do banco de dados é feita no arquivo .env. Esse arquivo não é versionado por segurança. Eloquent é a ORM (Object Relational Map) do Laravel, ela é responsável pela conexão com o banco de dados e representa a abstração de uma Query. 
* select
* insert
* update
* delete

Cada tabela possui um Model que é responsável pela interação entre requisições do bd. A convenção par o Model é o nome da entidade no singular (Event), enquanto a tabela é no pural (events). No Model são feitas poucas alterações nos arquivos, geralmente configurações específicas.

&nbsp;

## Migrations
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




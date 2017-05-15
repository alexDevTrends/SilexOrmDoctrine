Silex with Doctrine ORM - Ideal Trends
==================

Este projeto consiste em um modelo padrão de aplicação usando Silex com Doctrine ORM Bootstrap e um CRUD basico, para ajudar no desenvolvimento de sistema.

Para Saber mais sobre Doctrine veja a documentação do symfony e doctrine docs.

##Pré-Requisitos:
```bash
1. Web Service (Apache, Nginx, IIS, etc)
2. MySQL
3. PHP 5.6 ou superior
```
##Instalação:

###Passo 1:
Baixe os arquivos do repositorio em seu local.
```bash
git clone ssh://git@bitbucket.org/tecnologia-it/silexormdroctrine-idealtrends.git
```
###Passo 2:
Execute o composer para instalar as dependencias:
```bash
php bin/composer.phar install
```
###Passo 3:
Crie o arquivo app.php no diretorio config
com base no arquivo app-default.php
```bash
cp config/app-default.php config/app.php
```
###Passo 4
Crie o arquivo routes.php no diretorio config
com base no arquivo routes-default.php
```bash
cp config/routes-default.php config/routes.php
```
###Passo 5
####Configurações:
#####Conexão com Banco de dados:
Defina os parametros de conexão com o banco de dados em config/app.php:
```bash
$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host' => 'xxxx',
        'dbname' => 'xxxx',
        'user' => 'xxxx',
        'password' => 'xxxx',
    ),
));
```
#####Update Schema:
Crie um banco de dados e, em seguida, gere as tabelas com a ferramenta CLI:
```bash
php bin/console orm:schema-tool:update --force
```
###Passo 6
Sua Aplicação já esta funcional !! apenas rode seu php server na pasta web
```bash
/path/to/your_project$ cd web
/path/to/your_project/web$ php -S localhost:3030

Agora é so acessar no seu navegador
Ambiente Produção - http://localhost:3030/
Ambiente Desenvolvimento - http://localhost:3030/index_dev.php/

```

#####Para verificar lista de comandos do console:
```bash
php bin/console --info
```

```bash
Available commands:
  help                             Displays help for a command
  list                             Lists commands
dbal
  dbal:import                      Import SQL file(s) directly to Database.
  dbal:reserved-words              Checks if the current database contains identifiers that are reserved.
  dbal:run-sql                     Executes arbitrary SQL directly from the command line.
orm
  orm:clear-cache:metadata         Clear all metadata cache of the various cache drivers.
  orm:clear-cache:query            Clear all query cache of the various cache drivers.
  orm:clear-cache:result           Clear result cache of the various cache drivers.
  orm:convert-d1-schema            Converts Doctrine 1.X schema into a Doctrine 2.X schema.
  orm:convert-mapping              Convert mapping information between supported formats.
  orm:ensure-production-settings   Verify that Doctrine is properly configured for a production environment.
  orm:generate-entities            Generate entity classes and method stubs from your mapping information.
  orm:generate-proxies             Generates proxy classes for entity classes.
  orm:generate-repositories        Generate repository classes from your mapping information.
  orm:info                         Show basic information about all mapped entities
  orm:run-dql                      Executes arbitrary DQL directly from the command line.
  orm:schema-tool:create           Processes the schema and either create it directly on EntityManager Storage Connection or generate the SQL output.
  orm:schema-tool:drop             Drop the complete database schema of EntityManager Storage Connection or generate the corresponding SQL output.
  orm:schema-tool:update           Executes (or dumps) the SQL needed to update the database schema to match the current mapping metadata.
  orm:validate-schema              Validate that the mapping files.
```
#####Para Gerar uma Entity a partir de uma tabela no banco:
```bash
php bin/console orm:convert-mapping --from-database Annotation src/Entity --force
```
#####Para aderir um repositório para entidade:
```bash
@ORM\Entity(repositoryClass="Repository\EntityRepository")
```
##IdealTrends CRUD demo routes:
```bash
/path/to/your_project/
/path/to/your_project/create
/path/to/your_project/show/{id}
/path/to/your_project/showTitle/{Title}
/path/to/your_project/update/{id}
/path/to/your_project/delete/{id}
```

##Observação: 
```bash
1- O arquivo de configuração principal é o config/app.php, 
lá você ira registrar todos os seus providers e services da apalicação.
```
# Install the project with Docker

## Requirements

You must have Docker install on his computer. 
For this, you can read the documentation here : 
- For Linux : 
    - Debian : https://docs.docker.com/install/linux/docker-ce/centos/
    - Ubuntu : https://docs.docker.com/install/linux/docker-ce/ubuntu/
- For Mac : https://docs.docker.com/docker-for-mac/install/
- For Windows : https://docs.docker.com/docker-for-windows/install/

## Project installation

### 1. Clone the project :

```
git@github.com:StephanieB/reverse-phone-lookup.git
```

### 2. Execute docker-compose.yml

At the root of the project, launch this command :

```
docker-compose up -d
```

Docker will install an environment with:
- Nginx (the last version)
- PHP 7.2
- MySQL (the last version)
- phpMyAdmin
- Node (the last version)

### 3. Project access

With these URLs you can now access :
- the project : http://localhost:8000/
- the backoffice : http://localhost:8000/login
    - Username : admin
    - Password : admin
- phpMyAdmin: http://localhost:8080
    - Host : mysql
    - Username: root
    - Password: root

### 4. Create database 

Thanks to phpMyAdmin (or from the command line) create this database in MySQL:

```
docker-compose exec php bin/console doctrine:database:create
```

### 5. Create the tables

To create the table in the database you can do this : 
```
docker-compose exec php bin/console doctrine:migrations:migrate
```

### 6. First data

To create the first data in the database you can do this : 
```
docker-compose exec php bin/console doctrine:fixtures:load
```

### 7. Enjoy

Now in the website, you can search for exemple : 06, be, william, ... and you can see the result.
You can also read, create, update, delete the data from the backoffice.

## Solution without installation

You can also see the project directly from this URL : http://test.lecalepinpinpin.fr




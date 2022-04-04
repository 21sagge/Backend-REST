- docker run -d -p 8080:80 --name my-apache-php-app --rm  -v /home/informatica/Backend-REST:/var/www/html zener79/php:7.4-apache

- docker run --name my-mysql-server --rm -v /home/informatica/mysqldata:/var/lib/mysql -p 3306:3306 -v /home/informatica/dump:/dump -e MYSQL_ROOT_PASSWORD=pw -d mysql:latest

- docker exec -it my-mysql-server bash

- mysql -u root -p < /dump/create_employee.sql; exit;

password = pw;
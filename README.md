# SAS ASSESTMENT

#Getting Start
- Tools:
    - php 8.0.27
    - composer 2.5.1
    - SqLite

- Ext php.ini
    - extension=curl
    - extension=fileinfo
    - extension=mbstring
    - extension=openssl
    - extension=pdo_sqlite

- Rename .env.example file to .env or make a copy with .env name
- In the terminal type the following commands:

    - composer install
    - php artisan key:generate
    - php artisan migrate:fresh --seed

- Run the server with the port 8000 ( the 8000 port is important to test with the insomnia environment config):

    - php artisan serve --port 8000

#Test
- Just import the insomnia json file SAS.json into your insomnia
- default user (you can also signup with another credentials):
  - test@test.com  test1234

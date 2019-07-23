# Project 3 - Starter Kit - Symfony 4.2.8

![Wild Code School](https://wildcodeschool.fr/wp-content/uploads/2019/01/logo_pink_176x60.png)

## Getting Started

### Prerequisites

1. Check composer is installed
2. Check yarn & node are installed
3. Check phpinit is installed

### Install

1. Clone this project 
2. Run `composer install`
3. Run `yarn install`

### Working

1. Run `php bin/console server:run` to launch your local php web server
2. Run `yarn run dev --watch` to launch your local server for assets

### Testing

1. Run `./bin/phpcs` to launch PHP code sniffer
2. Run `./bin/phpstan analyse src --level 5` to launch PHPStan

## Deployment

1. Copy the .env file and rename it .env.local, then edit it :
    - Put on this line the DB name, your username et password username : `DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name`
    - Put on those lines your address email and password: `For Gmail as a transport, use: "gmail://username:password@localhost"`
    - Put on those lines your Token lifetime and Token pass phrase here : `TOKEN_LIFETIME=''`, `TOKEN_PASS_PHRASE=""`
    
2. Now you have to create a DB, you only have to run this `php bin/console doctrine:database:create` 

3. Then run this `php bin/console doctrine:schema:update --force` to create tables on your database

4. If you need make some insert, you can run this `php bin/console doctrine:fixtures:load`

5. After all of this, run `yarn encore dev` to load scss and `php/bin console server:run` to launch your server.
## Built With

* [Symfony](https://github.com/symfony/symfony)
* [GrumPHP](https://github.com/phpro/grumphp)
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [PHPStan](https://github.com/phpstan/phpstan)
* [Travis CI](https://github.com/marketplace/travis-ci)

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning


## Authors

Wild Code School trainers team

## License

MIT License

Copyright (c) 2019 aurelien@wildcodeschool.fr

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Acknowledgments


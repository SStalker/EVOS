# Installation

```
$ git clone git@github.com:SStalker/EVOS.git
$ cd EVOS
$ composer install
$ cp .env.example .env
$ php artisan key:generate
```
dann die .env die Variablen `DB_DATABASE`, `DB_USERNAME`, und `DB_PASSWORD` anpassen und anschließend die Migration ausführen:
```
$ php artisan migrate
```
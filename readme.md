# Scissors-Rock-Paper
Made with Laravel and Vuetify

### Installation

```
git clone https://github.com/ivan18m/Scissors-Rock-Paper.git
cd Scissors-Rock-Paper
composer update
```
```
cp .env.example .env
```
Set up database connection in `.env` file

Migrate and Seed the database with 3 default elements:
```
php artisan migrate --seed
```

URL: ```/``` to play the game.

URL: ```/element``` to create/edit/delete an element.


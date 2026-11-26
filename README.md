# Festivals

Een kleine Laravel-applicatie voor het beheren van festivals, de artiesten die er optreden en de locaties waar ze plaatsvinden.

- Een **festival** hoort bij één **locatie** en heeft meerdere **artiesten**.
- Een **artiest** kan op meerdere festivals spelen.
- Op een **locatie** kunnen meerdere festivals plaatsvinden.

De front-end bestaat uit gewone Blade-views met één stylesheet in `public/css/app.css`. Node.js of een build-stap is niet nodig.

## Vereisten

- [Laravel Herd](https://herd.laravel.com). Herd levert PHP 8.3+ en Composer mee en serveert de site voor je.
- [DBngin](https://dbngin.com) met een MySQL-service

## Project opzetten voor development

Het project staat in je Herd-map (standaard `~/Herd/lar2-startpunt-les-9`). Alle commando's hieronder draai je vanuit de hoofdmap van het project.

1. **Installeer de PHP-dependencies**

   ```bash
   composer install
   ```

2. **Maak je environment-bestand en app-key aan**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Zet daarna `APP_URL` in `.env` op `http://lar2-startpunt-les-9.test`.

3. **Maak de database aan en vul deze met testdata**

   Het project gebruikt MySQL via DBngin. Start je MySQL-service in DBngin en draai:

   ```bash
   php artisan migrate --seed
   ```

   De database `lar2_startpunt_les_9` bestaat nog niet, dus Laravel vraagt of je deze wilt aanmaken. Kies `Yes`. Daarna worden de tabellen aangemaakt, een testgebruiker (`test@example.com` / `password`) en 5 festivals. Elk festival krijgt een eigen locatie en 3 artiesten.

   `.env.example` gaat uit van de standaardinstellingen van DBngin: gebruiker `root` zonder wachtwoord op `127.0.0.1:3306`. Wijken jouw instellingen af, pas dan de `DB_`-waarden in je `.env` aan.

4. **Start de app**

   Zorg dat Herd en de MySQL-service in DBngin allebei draaien, en open <http://lar2-startpunt-les-9.test>. De homepagina toont de lijst met festivals.

## Handige commando's

| Commando | Wat het doet |
|---|---|
| `php artisan migrate:fresh --seed` | Verwijdert alle tabellen, draait de migraties opnieuw en vult de database opnieuw. Gebruik dit om je lokale data te resetten. |
| `php artisan db:seed --class=FestivalSeeder` | Voegt 5 extra festivals toe (met locaties en artiesten) zonder iets te verwijderen. |
| `php artisan test` | Draait de Pest-tests. De tests gebruiken een aparte SQLite-database in het geheugen (zie `phpunit.xml`), dus je MySQL-data blijft onaangeroerd. |
| `vendor/bin/pint` | Formatteert de PHP-code volgens de codestijl van het project. Draai dit voordat je commit. |
| `php artisan route:list --except-vendor` | Toont de routes van de app. |

## Projectstructuur

| Pad | Inhoud |
|---|---|
| `app/Models` | De modellen `Festival`, `Artist` en `Location` met hun relaties |
| `app/Http/Controllers` | Eén resource-controller per model (index, create, store, show, edit, update, destroy) |
| `routes/web.php` | Resource-routes voor `/festivals`, `/artists` en `/locations` |
| `resources/views/components/layout.blade.php` | De basislayout die elke pagina gebruikt (`<x-layout>`) |
| `resources/views/{festivals,artists,locations}` | De CRUD-views. Elke map heeft een gedeelde `form.blade.php` die create en edit allebei gebruiken |
| `public/css/app.css` | Alle styling |
| `database/factories`, `database/seeders` | Factories en seeders voor testdata |
| `tests/Feature` | Feature-tests per controller |

## Opmerkingen

- `composer run setup` komt uit de Laravel-starter en draait ook `npm install` en `npm run build`, wat dit project niet nodig heeft. Volg daarom de stappen hierboven.
- Je kunt een locatie niet verwijderen zolang er nog festivals aan gekoppeld zijn. Verplaats of verwijder die festivals eerst.

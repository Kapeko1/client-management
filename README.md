# Technologie
- PHP 8.2
- Laravel 12
- MariaDB 11.7.2

Ponadto korzystam z paczki dodatkowej zależności `spatie/laravel-data`, której zawsze używam przy pracy z DTO.


# Instalacja i Uruchomienie

## 1. Klonowanie repozytorium
```bash
git clone https://github.com/Kapeko1/client-management.git
cd clientManagement
```

## 2. Instalacja paczek composera
```bash
composer install
```

## 3. Instalacja paczek frontendowych
```bash
npm install
```

## 4. Konfiguracja środowiska
Skopiuj plik `.env.example` do `.env`:
```bash
cp .env.example .env
```

Wygeneruj klucz aplikacji:
```bash
php artisan key:generate
```

Skonfiguruj połączenie z bazą danych w pliku `.env`. Ja korzystałem z MariaDB i w moim przypadku część odpowiedzialna za połączenie z DB wyglądała tak:
```env
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clientmanagement
DB_USERNAME=root
DB_PASSWORD=
```

## 5. Migracje i seedery
Uruchom migracje, aby stworzyć tabele w bazie danych:
```bash
php artisan migrate
```

Opcjonalnie polecam wypełnić bazę danych przykładowymi danymi (klientów oraz opiekunów). Żeby dodać samych opiekunów trzeba edytować `database/seeders/DatabaseSeeder.php`:
```bash
php artisan db:seed
```

## 6. Kompilacja zasobów frontendowych
Polecam przekompilować na gorąco z:
```bash
npm run dev
```

## 7. Uruchomienie serwera deweloperskiego
Standardowo polecam wbudowany serwer deweloperski, który należy uruchomić za pomocą:
```bash
php artisan serve
```

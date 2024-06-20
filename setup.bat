@echo off

REM Change to the project directory
cd /d %~dp0

@REM REM Install PHP dependencies
@REM composer install

REM Install frontend dependencies
@REM npm install

REM Set up environment file
copy .env.example .env
php artisan key:generate

REM Set permissions
icacls storage /grant Everyone:(OI)(CI)F
icacls storage\framework /grant Everyone:(OI)(CI)F
icacls storage\logs /grant Everyone:(OI)(CI)F

REM Create storage link
php artisan storage:link

@REM REM Run migrations and seed the database
@REM php artisan migrate --seed

@REM npm run dev

echo Setup completed successfully.

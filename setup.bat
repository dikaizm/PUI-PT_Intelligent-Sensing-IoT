@echo off

REM Change to the project directory
cd /d %~dp0

REM Install PHP dependencies
composer install

REM Install frontend dependencies
npm install
npm run dev

REM Set up environment file
copy .env.example .env
php artisan key:generate

REM Set permissions
icacls storage /grant Everyone:(OI)(CI)F
icacls storage\framework /grant Everyone:(OI)(CI)F
icacls storage\logs /grant Everyone:(OI)(CI)F

REM Create storage link
php artisan storage:link

REM Run migrations and seed the database
php artisan migrate --seed

echo Setup completed successfully.
pause

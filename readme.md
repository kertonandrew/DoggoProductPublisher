# Doggo Product Publisher

## Framework

Built with [Laravel](https://laravel.com/)

### First time setup

- Use VSCode and install all recommended extensions - these recommendations should popup in the bottom left/right of the project when you open it OR you can search `@recommended` on the extension page.
- Create and run MySQL DB locally
- Copy `doggoProductPublisher/.env.example` to `doggoProductPublisher/.env` and update all fields
- From `doggoProductPublisher` run `composer install`, `npm install`, `php artisan key:generate`, , `php artisan migrate`
- From `doggoProductPublisher` run `php artisan serve` to develop

### Console commands

- `php artisan doggo:sync` will get 3 dogs from the dog API, and add them as products to the configured shipify account.
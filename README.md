# Sdui Challenge Test
- Create a file `database/database.sqlite` and set the path in your `.env`
- Set database to `sqlite` in your `.env` file
- Run this command to create fake data:
```php artisan db:seed```
- To delete old news older than 14 days, you may call this command:
```php artisan news:delete-old```
- To assign a new user to an exiting news use this route:
```POST /news/{news}/assign```
- You can call this command to run tests:
```php artisan test```

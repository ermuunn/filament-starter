# Filament Starter Kit v1.0

## What is Filament?
[Filament](https://filamentphp.com/docs) is a powerful and easy-to-use admin panel framework for Laravel. It helps you build admin dashboards, manage data, and create custom tools with minimal effort.

## Why Use Filament?
- [x] **Easy to Use:** Quickly set up CRUD operations and admin pages.
- [x] **Simple Design:** Comes with a modern, responsive interface.
- [x] **Fully Integrated:** Works perfectly with Laravel features like models and policies.
- [x] **Flexible and Customizable:** Create custom tools and actions to fit your needs.
- [x] **Saves Time:** Speeds up development so you can focus on your app’s features.

The Filament Starter Kit v1.0 is built to help you make the most of Filament, saving you even more time with pre-built modules and a ready-to-use structure.

## Features in the Starter Kit
- [x] Pre-built example models for Customer, Product, and Category, with relationships set up.
- [x] Database seeders to generate dummy data using Faker.
- [x] Localized labels in Mongolian for a tailored experience.
- [x] Ready-to-use Filament resource pages for managing your data.
- [x] Pre-built "getAll" APIs for each model, using JSON middleware for clean JSON responses.

Everything is set up and ready to use, so you can start building your application immediately!

## Version Information
- ### **PHP:** 8.2
- ### **Laravel:** 11.3
- ### **Filament:** 3.2


## Instructions
1. Clone the repository to your local machine: `git clone https://github.com/ermuunn/filament-starter.git app-name`
2. Navigate to the project directory: `cd app-name`
3. Install dependencies: `composer install` `npm install && npm run build`
4. Set up your environment file: `cp .env.example .env` `php artisan key:generate`
Update the `.env` file with your database credentials. (_e.g., DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD_).
5. Run database migrations: `php artisan migrate`
6. Seed the database with dummy data: `php artisan db:seed`
This will generate sample data for `Customer`, `Product`, and `Category` models using Faker.
7. Create a new user to access the admin panel: `php artisan make:filament-user`
8. Start the development server: `php artisan serve` and visit `http://localhost:8000/admin/login` to access the Filament admin panel.
   (_Note: For an improved development experience, consider using Laravel Herd._)
9. Log in with the user you created in step 7 to access the admin panel.

Congratulations! 🎉 You are now ready to start building your application with Filament.

## Additional Notes
### API Endpoints:
You can customize these routes and add more API endpoints as needed. The controller methods are already set up in the `App\Http\Controllers\Api` directory.
  - To access the JSON API for each model, use the following routes:
    - `/api/customer`
    - `/api/product`
    - `/api/category`

### Faker-Generated Data:
The database seeders use Faker to generate realistic dummy data for your models. This makes it easy to test the application with pre-filled data without manually adding entries. You can modify the factories and seeders in the `database/factories` and `database/seeders` directories to suit your needs.
  - **Customer Data**: Randomized customer names, emails, and phone numbers.
  - **Product Data**: Sample product names, prices, and stock information.
  - **Category Data**: Randomized category names.

## Resources
- [Filament Documentation](https://filamentphp.com/docs)
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Herd](https://herd.laravel.com/docs/1/getting-started/about-herd)

For any questions or issues, feel free to reach out to [me](https://ermuun.dev). If you find this starter kit helpful, please consider giving it a ⭐️ on GitHub.

Happy coding!






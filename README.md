<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

===================================================================================================================================================================================================================


Multi-Tenant SaaS Backend (Laravel)

A minimal backend in Laravel where a registered user can create, manage, and switch between multiple companies.
All subsequent data and actions are scoped to the currently active company.

🚀 Setup Instructions

1. Clone repo

git clone https://github.com/gaurav95123/multi-tenant-saas.git
cd multi-tenant-saas

2. Install dependencies
composer install
composer require laravel/breeze --dev
php artisan breeze:install api
npm install && npm run dev

4. Environment setup
cp  .env
php artisan key:generate

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=multi_tenant_saas
DB_USERNAME=root
DB_PASSWORD=


4. Run migrations

php artisan migrate

5.Serve the app
php artisan serve

🔐 Authentication Endpoints

POST /api/register → Register new user

POST /api/login → Login & get token

POST /api/logout → Logout (invalidate token)

🏢 Companies Endpoints

1. List Companies


GET /api/companies

Response:
[
  { "id": 1, "name": "TechCorp Pvt Ltd", "address": "123 Street", "industry": "Software" }
]


2. Create Company

POST /api/companies

Body:

{
  "name": "TechCorp Pvt Ltd",
  "address": "123 Street",
  "industry": "Software"
}

Response:
{
  "name": "TechCorp Pvt Ltd",
  "address": "123 Street",
  "industry": "Software"
}


3. Update Company

PUT /api/companies/{id}

Body:
{
  "name": "TechCorp Solutions",
  "address": "456 IT Park",
  "industry": "IT Services"
}

Response:
{ "id": 2, "name": "TechCorp Solutions", "address": "456 IT Park", "industry": "IT Services" }

4. Delete Company

DELETE /api/companies/{id}

Response:

{ "message": "Company deleted successfully" }





🔄 Active Company Endpoints

Set Active Company

POST /api/active-company

Body:

{ "company_id": 2 }

Response:

{
  "message": "Active company set successfully",
  "active_company": { "id": 2, "name": "TechCorp Pvt Ltd" }
}


Get Current Active Company

GET /api/active-company

Response:

{ "id": 2, "name": "TechCorp Pvt Ltd", "address": "123 Street", "industry": "Software" }


Multi-Tenant Logic 
User → Companies: Each user can create multiple companies.

Active company: Tracked via user_active_companies table (or active_company_id in users table).

Data isolation:

A user can only see/manage their own companies.

All future modules (invoices, projects, etc.) will include a company_id field.

Queries are always filtered by the user’s current active company.




















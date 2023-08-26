## How to Use

### Clone the repository

> git clone **https://github.com/Kirolos-Victor/mortgage-loan-calculator**

### Install Via Composer

> composer install

### Generate Application Key

> php artisan key:generate

### Setup your .env file

> Rename .env.example to .env and modify the configuration to match your local machine.

### Run the database migrations (Set the database connection in .env before migrating)

> run **php artisan migrate**
>
> I have created seeders for users if you want to use it, run instead **php artisan migrate --seed**

### Install Node Modules

> run npm install & npm run dev to start using Vite

### Testing

> run **php artisan test** for checking the test cases

### Task

> I created two API Endpoints for Calculate amortization and Calculate extra repayment schedule.
>
> I created two frontend views for Calculate amortization and Calculate extra repayment schedule.
>
> Here is a link for the Postman Collection for the API
> 
> endpoints: https://api.postman.com/collections/28258848-c7c50276-d94d-4a98-8ab0-1baa905a65b0?access_key=PMAT-01H8QNTXBJY9BAE2YC9DMKX84H
>
> To start using the Web Application, Register your account or use the seeder account Email:test@example.com, Password:password, You will be redirected to **/loan-amortization-calculator** page
> 
> Tech stack used: PHP 8.1, Laravel 10.10 with Bootstrap 5




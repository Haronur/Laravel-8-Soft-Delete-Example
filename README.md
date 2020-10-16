<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## --Soft Delete Example--

#### Step 1: Uncomment this below:
In The DatabaseSeeder file 
```
<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
         \App\Models\User::factory(10)->create();
    }
}
```
and
```
php artisan migrate
php artisan db:seed
```
#### Step 2 Adding soft delete_at column on users table 
`php artisan make:migration add_soft_deletes_to_users_table — table=users`

and
`php artisan migrate`
#### Step 3
customize User Model

#### Step 4 finally play with web.php route file as per your customize
```

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/findUser', function (){
    $user=User::all(); // fetch the $users
//    dd($user);
    echo $user . "<br/>";
});

Route::get('/softDelete', function (){
    $user=User::findorfail(1); // fetch the $user
    $user->delete(); //delete the fetched $user
});

Route::get('/onlyTrashedUser', function (){
    $user=User::onlyTrashed()->get(); // fetch soft Deleted $users
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/withTrashedUser', function (){
    $user=User::withTrashed()->get(); // fetch the $user
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/withoutTrashedUser', function (){
    $user=User::withoutTrashed()->get(); // fetch the $user
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/restoreUser', function (){
    $user=User::onlyTrashed()->find(1)->restore(); // restore the soft Deleted $user
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/foreceDelete', function (){
    $user=User::find(1)->forceDelete(); // permanently  Deleted $user Database
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/foreceDeleteOnlyTrashed', function (){
    $user=User::onlyTrashed()->find(2)->forceDelete(); // permanently  Deleted $user From Database
    //    dd($user);
    echo $user . "<br/>";
});

// Optional Practices For Deleting
// 1. Delete a model by calling the delete method on the model instance
Route::get('/softDeleteByInstance', function (){
    $user=User::findorfail(1); // fetch the $user
    $user->delete(); //delete the fetched $user
});

// 2. Delete an existing model by key
//However, if you know the ids, you can call the destroy method on the model instance
// Model::destroy($id);
Route::get('/softDeleteByModel', function (){
    User::destroy(2); //delete the  $user
});

// Hint if your expecting array of ids.
// Your can delete it like Model::destroy([1,2,3]);
Route::get('/softDeleteByarray', function (){
    User::destroy([3,4,5]); //delete the  $users as array
});

// 3. Delete model by query
// Model::where(‘created_at’,<,date(‘Y-m-d’));
// For this tutorial we are going to use the second delete method.

```
### Step 5 Refresh migration:

`php artisan migrate:refresh`
and
`php artisan db:seed`

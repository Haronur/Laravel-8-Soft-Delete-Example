<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

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
    $user=User::onlyTrashed()->get(); // fetch soft Deleted of all $users
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/withTrashedUser', function (){
    $user=User::withTrashed()->get(); // fetch the all $users
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/withoutTrashedUser', function (){
    $user=User::withoutTrashed()->get(); // fetch the all of Untreshed $users
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/restoreUser', function (){
    $user=User::onlyTrashed()->find(1)->restore(); // restore the soft Deleted $user
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/foreceDelete', function (){
    $user=User::find(1)->forceDelete(); // permanently  Deleted $user From the Database
    //    dd($user);
    echo $user . "<br/>";
});

Route::get('/foreceDeleteOnlyTrashed', function (){
    $user=User::onlyTrashed()->find(2)->forceDelete(); // permanently  Deleted $user From the Database
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

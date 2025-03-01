<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function () {
   $credentials = [
       'email' => 'admin@admin.com',
       'password' => 'password'
   ];

   if (!Auth::attempt($credentials)) {
       $user = new User();

       $user->username = 'admin';
       $user->email = $credentials['email'];
       $user->password = Hash::make($credentials['password']);
       $user->role = 'Admin';

       $user->save();

       if (Auth::attempt($credentials)) {
           $user = Auth::user();

           $adminToken = $user->createToken('admin-token');
           $updateToken = $user->createToken('update-token', ['create', 'update', 'delete']);
           $basicToken = $user->createToken('basic-token', ['none']);

           return [
               'admin' => $adminToken->plainTextToken,
               'update' => $updateToken->plainTextToken,
               'basic' => $basicToken->plainTextToken
           ];

       }
   }


});

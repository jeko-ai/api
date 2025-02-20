<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd(DB::table('symbols')->get());
    return view('welcome');
});

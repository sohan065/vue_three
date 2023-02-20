<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('admin.layouts.app');
// });

Route::get('{view}', ApplicationController::class)->where('view', '.*');

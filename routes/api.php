<?php
use App\Http\Controllers\AdController;

Route::get('/ads', [AdController::class, 'apiIndex']);
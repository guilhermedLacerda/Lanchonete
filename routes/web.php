<?php

use App\Livewire\Cliente\Create;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cliente/cadastro', Create::class);
<?php

use App\Livewire\Cliente\Create;
use App\Livewire\Cliente\Index;
use Illuminate\Support\Facades\Route;

Route::get('/cliente/cadastro', Create::class);

Route::get('/cliente/index', Index::class);


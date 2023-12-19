<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Controller as ControllerV1;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function (): void {
    Route::post('operate', [ControllerV1::class, 'operation'])->name('operation');
});

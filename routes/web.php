<?php
use App\Http\Controllers\DrawingController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CombinedDataController;

Route::get('/combined-data', [CombinedDataController::class, 'index']);
Route::get('/combined-data', [CombinedDataController::class, 'index'])->name('combined-data.index');

Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes
require __DIR__.'/route/auth_routes.php';

// Registration Routes
require __DIR__.'/route/registration_routes.php';

//Admin Routes
require __DIR__.'/route/admin_routes.php';

// product Routes
require __DIR__.'/route/product_routes.php';

// structural Routes
require __DIR__.'/route/structural_routes.php';

// form Routes
require __DIR__.'/route/form_routes.php';

// report Routes
require __DIR__.'/route/report_routes.php';

// mefps Routes
require __DIR__.'/route/mefps_routes.php';

// meeting Routes
require __DIR__.'/route/meeting_routes.php';

// mdirectory Routes
require __DIR__.'/route/directory_routes.php';

// inspection Routes
require __DIR__.'/route/inspection_routes.php';

// archi Routes
require __DIR__.'/route/architectural_routes.php';

// asbuilt Routes
require __DIR__.'/route/asbuilt_routes.php';


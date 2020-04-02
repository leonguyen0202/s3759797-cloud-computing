<?php
$namespace = 'App\Modules\Backend\Dashboard\Controllers';
Route::group(
    ['module' => 'Dashboard', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {
        Route::get('dashboard', [
            // 'middleware' => ['permission:access-dashboard'],
            'as' => 'dashboard.index',
            'uses' => 'DashboardController@index',
        ]);
    }
);
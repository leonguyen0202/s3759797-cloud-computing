<?php
$namespace = 'App\Modules\Backend\Export\Controllers';
Route::group(
    ['module' => 'Backend', 'prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {
        Route::get('export', [
            // 'middleware' => ['permission:view-big-query'],
            'as' => 'export.index',
            'uses' => 'ExportController@index',
        ]);

        Route::post('export/employees',[
            // 'middleware' => ['permission:view-big-query'],
            'as' => 'export.employees',
            'uses' => 'ExportController@employee_export',
        ]);
});
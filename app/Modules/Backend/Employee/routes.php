<?php
$namespace = 'App\Modules\Backend\Employee\Controllers';
Route::group(
    ['module' => 'Backend', 'prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {
        Route::get('employee/frequency', [
            // 'middleware' => ['permission:access-dashboard'],
            'as' => 'employee.frequency',
            'uses' => 'EmployeeController@frequency_index',
        ]);

        Route::get('employee', [
            // 'middleware' => ['permission:access-dashboard'],
            'as' => 'employee.index',
            'uses' => 'EmployeeController@index',
        ]);

        Route::post('employee/filter', [
            // 'middleware' => ['permission:create-lecturer'],
            'as' => 'employee.filter',
            'uses' => 'EmployeeController@filter',
        ]);

        Route::post('employee', [
            // 'middleware' => ['permission:create-lecturer'],
            'as' => 'employee.store',
            'uses' => 'EmployeeController@store',
        ]);

        Route::get('employee/edit', [
            // 'middleware' => ['permission:update-lecturer'],
            'as' => 'employee.edit',
            'uses' => 'EmployeeController@edit',
        ]);

        Route::put('employee/update', [
            // 'middleware' => ['permission:update-lecturer'],
            'as' => 'employee.update',
            'uses' => 'EmployeeController@update',
        ]);

        Route::delete('employee/destroy', [
            // 'middleware' => ['permission:delete-lecturer'],
            'as' => 'employee.destroy',
            'uses' => 'EmployeeController@delete',
        ]);

        Route::get('employee/dataTables', [
            // 'middleware' => ['permission:view-lecturer'],
            'as' => 'employee.dataTables',
            'uses' => 'EmployeeController@dataTables',
        ]);

        Route::get('employee/frequency/dataTables', [
            // 'middleware' => ['permission:view-lecturer'],
            'as' => 'employee.frequency.dataTables',
            'uses' => 'EmployeeController@frequency_dataTables',
        ]);

        Route::get('employee/export', [
            // 'middleware' => ['permission:edit-any'],
            'as' => 'employee.export',
            'uses' => 'EmployeeController@export',
        ]);
    }
);
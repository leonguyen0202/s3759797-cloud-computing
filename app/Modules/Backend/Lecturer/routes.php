<?php
$namespace = 'App\Modules\Backend\Lecturer\Controllers';
Route::group(
    ['module' => 'Backend', 'prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {
        Route::get('employee/frequency', [
            // 'middleware' => ['permission:access-dashboard'],
            'as' => 'employee.frequency',
            'uses' => 'LecturerController@frequency_index',
        ]);

        Route::get('employee', [
            // 'middleware' => ['permission:access-dashboard'],
            'as' => 'employee.index',
            'uses' => 'LecturerController@index',
        ]);

        Route::post('employee', [
            // 'middleware' => ['permission:create-lecturer'],
            'as' => 'employee.store',
            'uses' => 'LecturerController@store',
        ]);

        Route::get('employee/edit', [
            // 'middleware' => ['permission:update-lecturer'],
            'as' => 'employee.edit',
            'uses' => 'LecturerController@edit',
        ]);

        Route::put('employee/update', [
            // 'middleware' => ['permission:update-lecturer'],
            'as' => 'employee.update',
            'uses' => 'LecturerController@update',
        ]);

        Route::delete('employee/destroy', [
            // 'middleware' => ['permission:delete-lecturer'],
            'as' => 'employee.destroy',
            'uses' => 'LecturerController@delete',
        ]);

        Route::get('employee/dataTables', [
            // 'middleware' => ['permission:view-lecturer'],
            'as' => 'employee.dataTables',
            'uses' => 'LecturerController@dataTables',
        ]);

        Route::get('employee/frequency/dataTables', [
            // 'middleware' => ['permission:view-lecturer'],
            'as' => 'employee.frequency.dataTables',
            'uses' => 'LecturerController@frequency_dataTables',
        ]);

        Route::get('employee/export', [
            // 'middleware' => ['permission:edit-any'],
            'as' => 'employee.export',
            'uses' => 'LecturerController@export',
        ]);
    }
);
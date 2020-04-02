<?php
$namespace = 'App\Modules\Backend\Lecturer\Controllers';
Route::group(
    ['module' => 'Backend', 'prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {
        Route::get('lecturer', [
            // 'middleware' => ['permission:access-dashboard'],
            'as' => 'lecturer.index',
            'uses' => 'LecturerController@index',
        ]);

        Route::post('lecturer', [
            // 'middleware' => ['permission:create-lecturer'],
            'as' => 'lecturer.store',
            'uses' => 'LecturerController@store',
        ]);

        Route::get('lecturer/edit', [
            // 'middleware' => ['permission:update-lecturer'],
            'as' => 'lecturer.edit',
            'uses' => 'LecturerController@edit',
        ]);

        Route::put('lecturer/update', [
            // 'middleware' => ['permission:update-lecturer'],
            'as' => 'lecturer.update',
            'uses' => 'LecturerController@update',
        ]);

        Route::delete('lecturer/destroy', [
            // 'middleware' => ['permission:delete-lecturer'],
            'as' => 'lecturer.destroy',
            'uses' => 'LecturerController@delete',
        ]);

        Route::get('lecturer/list', [
            // 'middleware' => ['permission:view-lecturer'],
            'as' => 'lecturer.list',
            'uses' => 'LecturerController@list',
        ]);
    }
);
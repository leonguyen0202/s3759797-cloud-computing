<?php
$namespace = 'App\Modules\Backend\BigQuery\Controllers';
Route::group(
    ['module' => 'Backend', 'prefix' => 'dashboard', 'namespace' => $namespace, 'middleware' => ['web']],
    function () {

        Route::get('big-query/dataTables', [
            // 'middleware' => ['permission:edit-any'],
            'as' => 'bigquery.table',
            'uses' => 'BigQueryController@dataTables',
        ]);

        Route::get('big-query', [
            // 'middleware' => ['permission:view-big-query'],
            'as' => 'bigquery.index',
            'uses' => 'BigQueryController@index',
        ]);
});
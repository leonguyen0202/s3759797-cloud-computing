<?php

namespace App\Modules\Backend\BigQuery\Controllers;

use App\Http\Controllers\Controller;
use Google\Cloud\BigQuery\BigQueryClient;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BigQueryController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'permission:edit-any']);
        $this->project_id = config('assignment.project_id');
        $this->big_query_config = config('assignment.big_query');
    }

    public function index()
    {
        return view('BigQuery::index');
    }

    public function dataTables()
    {
        $query = "SELECT name,gender,frequency,year FROM `" . $this->project_id . "." . ($this->big_query_config)['data_set'] . "." . ($this->big_query_config)['table_name'] . "` LIMIT 1000";

        $bigQuery = new BigQueryClient([
            'projectId' => $this->project_id,
            'keyFile' => [
                'type' => ($this->big_query_config)['type'],
                'private_key_id' => ($this->big_query_config)['private_key_id'],
                'private_key' => ($this->big_query_config)['private_key'],
                'client_email' => ($this->big_query_config)['client_email'],
                'client_id' => ($this->big_query_config)['client_id'],
                'auth_uri' => ($this->big_query_config)['auth_uri'],
                'token_uri' => ($this->big_query_config)['token_uri'],
                'auth_provider_x509_cert_url' => ($this->big_query_config)['auth_provider_x509_cert_url'],
                'client_x509_cert_url' => ($this->big_query_config)['client_x509_cert_url'],
            ],
        ]);

        $jobConfig = $bigQuery->query($query);
        
        $job = $bigQuery->startQuery($jobConfig);

        $queryResults = $job->queryResults();

        $result = collect();

        foreach ($queryResults as $row) {
            $result->push(
                ['name' => $row['name'], 'gender' => $row['gender'], 'frequency' => $row['frequency'], 'year' => $row['year']]
            );
        }

        return DataTables::of($result)
            ->addColumn('name', function ($result) {
                return $result['name'];
            })
            ->addColumn('gender', function ($result) {
                switch ($result['gender']) {
                    case 'M':
                        return '<span class="badge badge-success">Male</span>';
                        break;
                    case 'F':
                        return '<span class="badge badge-info">Female</span>';
                        break;

                    default:
                        return '<span class="badge badge-danger">Wrong type!</span>';
                        break;
                }
            })
            ->addColumn('frequency', function ($result) {
                return thousandsFormat($result['frequency']);
            })
            ->addColumn('year', function ($result) {
                return $result['year'];
            })
            ->addColumn('action', function ($result) {
                $random = Str::random(60);
                return '<div class="bigQueryParent">
                            <input class="id" id="' . $random . '" name="big_query" type="hidden" style="display:none;" readonly>
                            <a href="?queue=' . $random . '" class="btn btn-warning bigQueryEdit"><i class="fas fa-edit"></i></a>
                            <a href="?queue=' . $random . '" class="btn btn-danger bigQueryRemove"><i class="fas fa-trash"></i></a>
                        </div>';
            })
            ->rawColumns(['gender', 'action'])
            ->make(true);
    }
}

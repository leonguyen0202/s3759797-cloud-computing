<?php
namespace App\Modules\Backend\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Backend\Lecturer\Models\Lecturer;
use Google\Cloud\BigQuery\BigQueryClient;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'permission:view-lecturer|create-lecturer|update-lecturer|delete-lecturer']);
        $this->project_id = config('assignment.project_id');
        $this->big_query_config = config('assignment.big_query');
    }

    public function index()
    {
        $group = Lecturer::query()
            ->select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->get();
        
        $avg = Lecturer::query()->avg('age');

        return view('Dashboard::index')->with([
            'totalBabyName' => $this->totalBabyName(),
            'leastFrequency' => $this->leastFrequency(),
            'topFrequency' => $this->topFrequency(),
            'lecturerGroup' => $group,
            'averageAge' => $avg,
        ]);
    }

    protected function leastFrequency()
    {
        $query = "SELECT name,gender,frequency,year FROM `" . $this->project_id . "." . ($this->big_query_config)['data_set'] . "." . ($this->big_query_config)['table_name'] . "` ORDER BY frequency asc LIMIT 5";

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
                [
                    'name' => $row['name'],
                    'gender' => $row['gender'],
                    'frequency' => $row['frequency'],
                    'year' => $row['year'],
                ]
            );
        }

        return $result;
    }

    protected function topFrequency()
    {
        $query = "SELECT name,gender,frequency,year FROM `" . $this->project_id . "." . ($this->big_query_config)['data_set'] . "." . ($this->big_query_config)['table_name'] . "` ORDER BY frequency desc LIMIT 5";

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

        return $result;
    }

    protected function totalBabyName()
    {
        /** Uncomment and populate these variables in your code */
        $query = "SELECT count(`name`) as `count` FROM `" . $this->project_id . "." . ($this->big_query_config)['data_set'] . "." . ($this->big_query_config)['table_name'] . "`";

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

        foreach ($queryResults as $row) {
            $this->big_query_count = $row['count'];
        }
        return $this->big_query_count;
    }
}

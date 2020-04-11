<?php
namespace App\Modules\Backend\Employee\Controllers;

use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Modules\Backend\Employee\Models\Employee;
use Carbon\Carbon;
use Faker\Factory;
use Google\Cloud\BigQuery\BigQueryClient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'permission:view-lecturer|create-lecturer|update-lecturer|delete-lecturer']);
        $this->project_id = config('assignment.project_id');
        $this->big_query_config = config('assignment.big_query');
    }

    public function dataTables()
    {
        $employees = Employee::query()->exclude(['created_at'])->get();

        return DataTables::of($employees)
            ->addColumn('first_name', function ($employee) {
                return $employee->first_name;
            })
            ->addColumn('last_name', function ($employee) {
                return $employee->last_name;
            })
            ->addColumn('gender', function ($employee) {
                switch ($employee->gender) {
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
            ->addColumn('age', function ($employee) {
                return $employee->age;
            })
            ->addColumn('action', function ($employee) {
                $random = Str::random(60);
                return '<div class="employeeParent">
                            <input class="id" id="' . $random . '" name="employee" value="' . $employee->id . '" type="hidden" style="display:none;" readonly>
                            <a href="?queue=' . $random . '" class="btn btn-warning employeeEdit"><i class="fas fa-edit"></i></a>
                            <a href="?queue=' . $random . '" class="btn btn-danger  employeeRemove"><i class="fas fa-trash"></i></a>
                        </div>';
            })
            ->editColumn('address', function ($employee) {
                return split_sentence($employee->address, 20, '...');
            })
            ->rawColumns(['gender', 'action'])
            ->make(true);
    }

    public function index()
    {
        return view('Employee::index');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required|min:3|string',
            'last_name' => 'required|min:3|string',
            'address' => 'required|min:3|string',
            'age' => 'required|numeric|between:20,100',
            'gender' => 'required',
            'phone_number' => 'required|string',
        ]);

        // Validate the input and return correct response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        if ($request->input('gender') == 'M' || $request->input('gender') == 'F') {
            Employee::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
            ]);
            return response()->json(['success' => 'Success']);
        } else {
            return response()->json(['message' => 'Please do not try to modify source code!']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');

        $employee = Employee::find($request->input('id'));

        if ($employee == null) {
            return response()->json(['message' => 'No employee found!']);
        }

        return response()->json(['data' => $employee]);
    }

    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required|min:3|string',
            'last_name' => 'required|min:3|string',
            'age' => 'required|numeric|between:20,100',
            'gender' => 'required',
        ]);

        // Validate the input and return correct response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $employee = Employee::find($request->input('id'));

        if ($employee == null) {
            return response()->json(['message' => 'Data not found!']);
        }

        if ($request->input('gender') == 'M' || $request->input('gender') == 'F') {

            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->age = $request->input('age');
            $employee->gender = $request->input('gender');

            $employee->save();

            return response()->json(['success' => 'Success']);
        } else {
            return response()->json(['message' => 'Please do not try to modify source code!']);
        }
    }

    public function export()
    {
        Excel::store(new EmployeeExport(), 'Employees.csv', 'public');

        return new EmployeeExport();
    }

    public function seedingLecturer(Request $request)
    {
        $faker = Factory::create();

        foreach (range(1, $request->input('data')) as $i) {
            Employee::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement(['M', 'F']),
                'age' => $faker->numberBetween($min = 25, $max = 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['success' => 'Success']);
    }

    public function delete(Request $request)
    {
        $employee = Employee::find($request->input('id'));

        if ($employee == null) {
            return response()->json(['message' => 'Data not found!']);
        }

        $employee->delete();

        return response()->json(['success' => 'Success']);
    }

    /**
     * Employee frequency compare to Big Query Baby Name
     */
    public function frequency_index()
    {
        # code...
        return view('Employee::frequency');
    }

    public function frequency_dataTables()
    {
        $employees = Employee::query()->exclude(['created_at'])->get();

        return DataTables::of($employees)
            ->addColumn('first_name', function ($employees) {
                return $employees->first_name;
            })
            ->addColumn('first_name_frequency', function ($employees) {
                $frequency = $this->big_query_result($employees->first_name);

                return '<span class="badge badge-danger">' . $frequency[0]['count'] . '</span>';
            })
            ->addColumn('last_name', function ($employees) {
                return $employees->last_name;
            })
            ->addColumn('last_name_frequency', function ($employees) {
                $frequency = $this->big_query_result($employees->last_name);

                return '<span class="badge badge-danger">' . $frequency[0]['count'] . '</span>';
            })
            ->addColumn('gender', function ($employees) {
                switch ($employees->gender) {
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
            ->addColumn('age', function ($employees) {
                return $employees->age;
            })
            ->editColumn('updated_at', function ($groups) {
                return Carbon::parse($groups->updated_at)->diffForHumans();
            })
            ->rawColumns(['first_name_frequency', 'last_name_frequency', 'gender'])
            ->make(true);
    }

    public function big_query_result($name)
    {
        $query = "SELECT COUNT(*) as count FROM `" . $this->project_id . "." . ($this->big_query_config)['data_set'] . "." . ($this->big_query_config)['table_name'] . "` WHERE name = '" . $name . "'";

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
                    'count' => $row['count'],
                ]
            );
        }

        return $result;
    }
}

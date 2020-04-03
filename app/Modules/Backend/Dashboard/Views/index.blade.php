@extends('layouts.backend.master')

@section('content')
<div class="row">
    <div class="col-md-6 col-xl-6">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Baby Names</div>
                    <div class="widget-subheading">From Google Big Query</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white">
                        <span>{{ thousandsFormat($totalBabyName) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card mb-3 widget-content bg-premium-dark">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Lecturers</div>
                    <div class="widget-subheading">From Google Cloud SQL</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-warning">
                        <span>
                            @if (!$lecturerGroup->isEmpty())
                                @if (count($lecturerGroup) > 1)
                                    {{ number_format($lecturerGroup[0]->total + $lecturerGroup[1]->total) }}
                                @else
                                    {{ number_format($lecturerGroup[0]->total) }}
                                @endif
                                
                            @else
                                0
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Least frequency baby name</h5>
                <table class="mb-0 table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Year</th>
                            <th>Frequency</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leastFrequency as $item)
                        <tr>
                            <th>{{ $item['name'] }}</th>
                            <td>
                                @switch($item['gender'])
                                    @case('F')
                                        <span class="badge badge-info">Female</span>
                                    @break
                                    @case('M')
                                        <span class="badge badge-success">Male</span>
                                    @break
                                    @default
                                        <span class="badge badge-danger">Wrong type</span>
                                    @break
                                @endswitch
                            </td>
                            <td>{{ $item['year'] }}</td>
                            <td>
                                {{ thousandsFormat($item['frequency']) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Top frequency baby name</h5>
                <table class="mb-0 table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Year</th>
                            <th>Frequency</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topFrequency as $item)
                        <tr>
                            <th>{{ $item['name'] }}</th>
                            <td>
                                @switch($item['gender'])
                                    @case('F')
                                        <span class="badge badge-info">Female</span>
                                    @break
                                    @case('M')
                                        <span class="badge badge-success">Male</span>
                                    @break
                                    @default
                                        <span class="badge badge-danger">Wrong type</span>
                                    @break
                                @endswitch
                            </td>
                            <td>{{ $item['year'] }}</td>
                            <td>
                                {{ thousandsFormat($item['frequency']) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach ($lecturerGroup as $lecturer)
        @if ($lecturer->gender == 'F')
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Female Lecturers</div>
                                <div class="widget-subheading">From Google Cloud SQL</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning">{{ thousandsFormat($lecturer->total) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Male Lecturers</div>
                                <div class="widget-subheading">From Google Cloud SQL</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success">{{ thousandsFormat($lecturer->total) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <div class="col-md-12 {{ ( count($lecturerGroup) > 1 ) ? 'col-xl-4' : ( (count($lecturerGroup) == 1) ? 'col-xl-8' : 'col-xl-12' ) }} ">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">Average age of lecturers</div>
                        <div class="widget-subheading">From Google Cloud SQL</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-danger">{{ round($averageAge) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Active Users
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="active btn btn-focus">Last Week</button>
                        <button class="btn btn-focus">All Month</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th class="text-center">City</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center text-muted">#345</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                    src="{{asset('images/avatars/4.jpg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">John Doe</div>
                                            <div class="widget-subheading opacity-7">Web Developer
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Madrid</td>
                            <td class="text-center">
                                <div class="badge badge-warning">Pending</div>
                            </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-1"
                                    class="btn btn-primary btn-sm">Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">#347</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                    src="{{asset('images/avatars/3.jpg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Ruben Tillman</div>
                                            <div class="widget-subheading opacity-7">Etiam sit amet
                                                orci eget</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Berlin</td>
                            <td class="text-center">
                                <div class="badge badge-success">Completed</div>
                            </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-2"
                                    class="btn btn-primary btn-sm">Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">#321</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                    src="{{asset('images/avatars/2.jpg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Elliot Huber</div>
                                            <div class="widget-subheading opacity-7">Lorem ipsum
                                                dolor sic</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">London</td>
                            <td class="text-center">
                                <div class="badge badge-danger">In Progress</div>
                            </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-3"
                                    class="btn btn-primary btn-sm">Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">#55</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                    src="{{asset('images/avatars/1.jpg')}}" alt=""></div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Vinnie Wagstaff</div>
                                            <div class="widget-subheading opacity-7">UI Designer
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Amsterdam</td>
                            <td class="text-center">
                                <div class="badge badge-info">On Hold</div>
                            </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-4"
                                    class="btn btn-primary btn-sm">Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-block text-center card-footer">
                <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
                        class="pe-7s-trash btn-icon-wrapper"> </i></button>
                <button class="btn-wide btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
            <div class="widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-danger">71%</div>
                        </div>
                        <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="71"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 71%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Income Target</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
            <div class="widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-success">54%</div>
                        </div>
                        <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="54"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Expenses Target</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-left card">
            <div class="widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-warning">32%</div>
                        </div>
                        <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="32"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 32%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Spendings Target</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card-shadow-info mb-3 widget-chart widget-chart2 text-left card">
            <div class="widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-info">89%</div>
                        </div>
                        <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="89"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Totals Target</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
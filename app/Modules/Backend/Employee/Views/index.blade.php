@extends('layouts.backend.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#filter">
                    <span>Employee Filter</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#table">
                    <span>Employee List</span>
                </a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane tabs-animation fade show active" id="filter" role="tabpanel">
                <form action="{{route('employee.filter')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="genderSelect" class="">
                                    Gender
                                </label>
                                <select type="select" id="genderSelect" name="gender" class="custom-select">
                                    <option selected disabled>Select gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="ageSelect" class="">
                                    Select range of age
                                </label>
                                <select type="select" id="ageSelect" name="age" class="custom-select">
                                    <option selected disabled>Select range of age</option>
                                    <option value="1_100">All</option>
                                    <option value="1_20">From 1 to 20</option>
                                    <option value="21_40">From 21 to 40</option>
                                    <option value="41_60">From 41 to 60</option>
                                    <option value="61_80">From 61 to 80</option>
                                    <option value="81_100">From 81 to 100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-round">Filter</button>
                        </div>
                    </div>
                </form>
                @if ($results)
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Filter Result</h5>
                                <table class="mb-0 table table-hover">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results as $item)
                                            <td>
                                                {{$item->first_name}}
                                            </td>
                                            <td>
                                                {{$item->last_name}}
                                            </td>
                                            <td>
                                                @switch($item->gender)
                                                    @case("F")
                                                        <span class="badge badge-pills badge-success">Male</span>
                                                        @break
                                                    @case("M")
                                                    <span class="badge badge-pills badge-info">Female</span>
                                                        @break
                                                    @default
                                                        
                                                @endswitch
                                            </td>
                                            <td>
                                                {{$item->age}}
                                            </td>
                                            <td>
                                                {{$item->address}}
                                            </td>
                                            <td>
                                                {{$item->phone_number}}
                                            </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="tab-pane tabs-animation fade" id="table" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <h2 class="card-title">
                                    <i class="metismenu-icon pe-7s-news-paper"></i>&nbsp;Employees List
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    <button type="button" id="employeeTableBtnAdd"
                                        class="btn btn-primary employeeTableBtnAdd" data-toggle="modal"
                                        data-target=".employeeModal">
                                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Add new
                                    </button>
                                    <a href="{{route('employee.export')}}" class="btn btn-success ml-2"><i
                                            class="fas fa-download"></i>&nbsp;Export as CSV</a>
                                </div>
                                <br>
                                <div class="material-datatables">
                                    <table id="employees" class="table table-striped table-no-bordered table-hover"
                                        cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Gender</th>
                                                <th>Age</th>

                                                <th>Address</th>
                                                <th class="disabled-sorting text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Gender</th>
                                                <th>Age</th>

                                                <th>Address</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- end content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModal" aria-hidden="true">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Add new employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-6 ml-auto mr-auto customAlert justify-content-center" style="display:none;">
                </div>
                <input type="hidden" name="action" id="action">
                <input type="hidden" name="id" id="id">
                <div class="row pt-3 mb-3">
                    <div class="col-lg-6 col-sm-6 mb-30 pb-5">
                        @include('Employee::modal.basic_info')
                    </div>
                    <div class="col-lg-6 col-sm-6 mb-30 pb-5">
                        @include('Employee::modal.other_info')
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnModalCancel" class="btn btn-secondary btnModalCancel"
                    data-dismiss="modal">Close</button>
                <button type="button" id="employeeModalButton" class="btn btn-primary employeeModalButton">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
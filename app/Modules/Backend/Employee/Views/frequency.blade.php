@extends('layouts.backend.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <h2 class="card-title">
                    <i class="metismenu-icon pe-7s-news-paper"></i>&nbsp;Employees Frequency
                </h2>
            </div>
            <div class="card-body">
                <div class="material-datatables">
                    <table id="employees-frequency" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Frequency</th>
                                <th>Last Name</th>
                                <th>Frequency</th>
                                <th>Gender</th>
                                <th>Age</th>

                                <th class="disabled-sorting text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Frequency</th>
                                <th>Last Name</th>
                                <th>Frequency</th>
                                <th>Gender</th>
                                <th>Age</th>

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
@endsection
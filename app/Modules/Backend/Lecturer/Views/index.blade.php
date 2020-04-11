@extends('layouts.backend.master')

@section('content')
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
                    <button type="button" id="lecturerTableBtnAdd" class="btn btn-primary lecturerTableBtnAdd"
                        data-toggle="modal" data-target=".lecturerModal">
                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Add new
                    </button>
                    <a href="{{route('employee.export')}}" class="btn btn-success ml-2"><i
                            class="fas fa-download"></i>&nbsp;Export as CSV</a>
                </div>
                <br>
                <div class="material-datatables">
                    <table id="lecturers" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Age</th>

                                <th>Updated At</th>
                                <th class="disabled-sorting text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Age</th>

                                <th>Updated At</th>
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

@section('modal')
<div class="modal fade lecturerModal" tabindex="-1" role="dialog" aria-labelledby="lecturerModal" aria-hidden="true">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lecturerModalLabel">Add new employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-6 ml-auto mr-auto customAlert justify-content-center" style="display:none;"></div>
                <input type="hidden" name="action" id="action">
                <input type="hidden" name="id" id="id">
                <div class="row pt-3 mb-3">
                    <div class="col-lg-6 col-sm-6 mb-30 pb-5">
                        @include('Lecturer::modal.basic_info')
                    </div>
                    <div class="col-lg-6 col-sm-6 mb-30 pb-5">
                        @include('Lecturer::modal.other_info')
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnModalCancel" class="btn btn-secondary btnModalCancel"
                    data-dismiss="modal">Close</button>
                <button type="button" id="lecturerModalButton" class="btn btn-primary lecturerModalButton">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
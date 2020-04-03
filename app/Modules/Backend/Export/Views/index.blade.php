@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fa fa-download icon-gradient bg-malibu-beach"></i>
            </div>
            <div>
                Excel Export & Downloading
                <div class="page-title-subheading">Tabs are used to split content between multiple
                    sections. Wide variety available.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" data-toggle="tooltip" title="Add to favourite" data-placement="bottom"
                class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
            </button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3 card">
            <div class="card-body">
                <ul class="tabs-animated-shadow tabs-animated nav">
                    <li class="nav-item">
                        <a role="tab" class="nav-link active" id="tab-c-0" data-toggle="tab" href="#employee">
                            <span>Employee</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c-1" data-toggle="tab" href="#tab-animated-1">
                            <span>Tab 2</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c-2" data-toggle="tab" href="#tab-animated-2">
                            <span>Tab 3</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="employee" role="tabpanel">
                        <form action="{{route('export.employees')}}" method="post">
                            @csrf
                            <div class="mt-4">
                                @foreach ($lecturerColumns as $item)
                                <div class="position-relative form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="{{$item}}" class="form-check-input">
                                        {{ de_slug($item) }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-round mt-4">Download</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab-animated-1" role="tabpanel">
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                            unknown
                            printer took a galley of type and scrambled it to make a type specimen book. It has survived
                            not
                            only five centuries, but also the leap into electronic typesetting, remaining essentially
                            unchanged. </p>
                    </div>
                    <div class="tab-pane" id="tab-animated-2" role="tabpanel">
                        <p class="mb-0">It was popularised in the 1960s with the release of Letraset sheets containing
                            Lorem
                            Ipsum passages, and more recently with desktop publishing software like Aldus
                            PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
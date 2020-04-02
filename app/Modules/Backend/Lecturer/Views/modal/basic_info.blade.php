<div class="card">
        <div class="card-header card-header-text card-header-info">
            <div class="card-text">
                <h4 class="card-title">Basic Information</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="first_name" id="first_name" placeholder="First name..."
                            class="form-control" value="{{ old('first_name') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <label class="bmd-label-floating">Email address</label> --}}
                        <input type="text" name="last_name" id="last_name" placeholder="Last name..."
                            class="form-control" value="{{ old('last_name') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="card">
    <div class="card-header card-header-text card-header-success">
        <div class="card-text">
            <h4 class="card-title">Other Information</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input user_language" type="radio" name="gender" id="male"
                            value="M">
                        Male
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input user_language" type="radio" name="gender" id="female"
                            value="F">
                        Female
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="number" name="age" id="age" placeholder="Age..." autocomplete="off"
                        class="form-control" value="{{ old('age') }}">
                </div>
            </div>
        </div>
    </div>
</div>
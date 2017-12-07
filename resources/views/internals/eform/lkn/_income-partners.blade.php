<div class="panel-body">
    <div class="row">
        <div class="col-md-9">
            <div class="form-horizontal" role="form">
                <!-- <div class="form-group separated_property_status {!! $errors->has('separated_property_status') ? 'has-error' : '' !!}">
                    <label class="col-md-4 control-label">Status Pisah Harta *:</label>
                    <div class="col-md-8">
                        <select class="form-control" name="separated_property_status" id="separated_property_status">
                            <option selected="" disabled="">-- Pilih --</option>
                            <option value="separatedproperty">Pisah Harta</option>
                            <option value="nonseparatedproperty">Gabung Harta</option>
                        </select>
                        @if ($errors->has('separated_property_status')) <p class="help-block">{{ $errors->first('separated_property_status') }}</p> @endif
                    </div>
                </div> -->

                <div class="form-group source_income {!! $errors->has('source_income') ? 'has-error' : '' !!}">
                    <label class="col-md-4 control-label">Sumber *:</label>
                    <div class="col-md-8">
                        <select class="form-control" name="source_income" id="source_income">
                            <option selected="" disabled="">-- Pilih --</option>
                            <option value="single" {{ $eformData['customer']['financial']['salary_couple'] > 0 ? '' : 'selected' }}>Single Income</option>
                            <option value="joint" {{ $eformData['customer']['financial']['salary_couple'] > 0 ? 'selected' : '' }}>Join Income</option>
                        </select>
                        @if ($errors->has('source_income')) <p class="help-block">{{ $errors->first('source_income') }}</p> @endif
                    </div>
                </div>
                <div class="form-group" id="income_partner" style="{{ $eformData['customer']['financial']['salary_couple'] > 0 ? '' : "display: none;" }}">
                    <label class="col-md-4 control-label">Penghasilan per-Bulan *:</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" class="form-control numericOnly currency-rp" name="couple_salary" maxlength="24" value="{{$eformData['customer']['financial']['salary_couple']}}">
                            <!-- <span class="input-group-addon">,00</span> -->
                            @if ($errors->has('couple_salary')) <p class="help-block">{{ $errors->first('couple_salary') }}</p> @endif
                        </div>
                    </div>
                </div>
                <div class="form-group" id="income_other" style="{{ $eformData['customer']['financial']['salary_couple'] > 0 ? '' : "display: none;" }}">
                    <label class="col-md-4 control-label">Tunjangan / Insentif Lain :</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" class="form-control numericOnly currency-rp" name="couple_other_salary" maxlength="24" value="{{$eformData['customer']['financial']['other_salary_couple']}}">
                            @if ($errors->has('couple_other_salary')) <p class="help-block">{{ $errors->first('couple_other_salary') }}</p> @endif
                            <!-- <span class="input-group-addon">,00</span> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
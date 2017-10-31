<div class="row">
    <div class="col-md-12">
        <div class="panel panel-color panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Data Pekerjaan</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Bidang Pekerjaan * :</label>
                                <div class="col-md-8">
                                    {!! Form::select('job_field_id', [$dataCustomer['customer']['job_field_id']['desc1'] => $dataCustomer['customer']['job_field_id']['desc2']], old('work_field'), [
                                    'class' => 'select2 work_field',
                                    'data-placeholder' => 'Pilih Bidang Pekerjaan'
                                    ]) !!}
                                    @if ($errors->has('work_field')) <p class="help-block">{{ $errors->first('work_field') }}</p> @endif
                                </div>
                                <input type="hidden" name="job_field_name" id="new_job_field">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Jenis Pekerjaan * :</label>
                                <div class="col-md-8">
                                    {!! Form::select('job_type_id', [$dataCustomer['customer']['job_type_id']['desc1'] => $dataCustomer['customer']['job_type_id']['desc2']], old('work_type'), [
                                    'class' => 'select2 work_type',
                                    'data-placeholder' => 'Pilih Jenis Pekerjaan',
                                    'readonly' => true
                                    ]) !!}
                                    @if ($errors->has('work_type')) <p class="help-block">{{ $errors->first('work_type') }}</p> @endif
                                </div>
                                <input type="hidden" name="job_type_name" id="new_job_type">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Pekerjaan * :</label>
                                <div class="col-md-8">
                                    {!! Form::select('job_id', [$dataCustomer['customer']['job_id']['desc1'] => $dataCustomer['customer']['job_id']['desc2']], old('work'), [
                                    'class' => 'select2 work',
                                    'data-placeholder' => 'Pilih Pekerjaan',
                                    'readonly' => true
                                    ]) !!}
                                    @if ($errors->has('work')) <p class="help-block">{{ $errors->first('work') }}</p> @endif
                                </div>
                                <input type="hidden" name="job_name" id="new_job">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama Perusahaan * :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="company_name" maxlength="50" value="{{$dataCustomer['customer']['company_name']}}">
                                    @if ($errors->has('company_name')) <p class="help-block">{{ $errors->first('company_name') }}</p> @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Jabatan * :</label>
                                <div class="col-md-8">
                                    {!! Form::select('position', [$dataCustomer['customer']['position']['desc1'] => $dataCustomer['customer']['position']['desc2']], old('positions'), [
                                    'class' => 'select2 positions',
                                    'data-placeholder' => 'Pilih Posisi',
                                    'readonly' => true
                                    ]) !!}
                                    @if ($errors->has('position')) <p class="help-block">{{ $errors->first('position') }}</p> @endif
                                </div>
                                <input type="hidden" name="position_name" id="new_position">
                            </div>
                            <div class="form-group work_duration {!! $errors->has('work_duration') ? 'has-error' : '' !!}">
                                <label class="col-md-4 control-label">Lama Kerja * :</label>
                                <div class="col-md-8">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="work_duration" maxlength="3" min="0" value="{{$dataCustomer['customer']['work_duration']}}">
                                    </div>
                                    <label class="col-md-2 control-label">Tahun</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control numericOnly" name="work_duration_month" maxlength="2" value="{{$dataCustomer['customer']['work_duration_month']}}">
                                    </div>
                                    <label class="col-md-1 control-label">Bulan</label>
                                    @if ($errors->has('work_duration')) <p class="help-block">{{ $errors->first('work_duration') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group office_address {!! $errors->has('office_address') ? 'has-error' : '' !!}">
                                <label class="col-md-4 control-label">Alamat Kantor * :</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" rows="3" name="office_address" maxlength="255">{{$dataCustomer['customer']['office_address']}}</textarea>
                                    @if ($errors->has('office_address')) <p class="help-block">{{ $errors->first('office_address') }}</p> @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--End--> 
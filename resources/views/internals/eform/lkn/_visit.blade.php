<div class="panel-body">
    <input type="hidden" name="status_id" value="{{$eformData['customer']['personal']['status_id']}}">
        <div class="row">
            <div class="col-md-9">
                <div class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Pejabat BRI yang mengunjungi *:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="visitor_name" maxlength="50" value="{{ $data['name'] }}" readonly="">
                            @if ($errors->has('visitor_name')) <p class="help-block">{{ $errors->first('visitor_name') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tempat Kunjungan *:</label>
                        <div class="col-md-8">
                            <input id="searchInput" class="input-controls " type="text" placeholder="Masukkan nama tempat atau nama jalan untuk lokasi pertemuan" name="place">
                            <div class="map" id="map" style="width: 100%; height: 200px;"></div>
                            <textarea class="form-control" rows="3" name="address" maxlength="255" id="location">{{ $eformData['address'] }}</textarea>
                            @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
                            <input type="hidden" name="lng" id="lng" value="{{$eformData['longitude']}}"><input type="hidden" name="lat" id="lat" value="{{$eformData['latitude']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tanggal Kunjungan *:</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" name="date" value="{{ $eformData['appointment_date'] }}" readonly="">
                                <span class="input-group-addon b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                                @if ($errors->has('date')) <p class="help-block">{{ $errors->first('date') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama Calon Debitur/ Debitur *:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" maxlength="50" value="{{ $eformData['customer']['personal']['name'] }}" readonly="">
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Pendidikan Terakhir *:</label>
                        <div class="col-md-8">
                            {!! Form::select( 'title'
                                , array_merge([""=>""],get_title('all'))
                                , old('title')
                                , [
                                    'class' => 'select2 title'
                                    , 'data-placeholder' => 'Pilih Pendidikan Terakhir'
                                ]
                            ) !!}

                            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Agama *:</label>
                        <div class="col-md-8">
                            {!! Form::select( 'religion'
                                , array_merge([""=>""],get_religion('all'))
                                , old('religion')
                                , [
                                    'class' => 'select2 religion'
                                    , 'data-placeholder' => 'Pilih Agama'
                                ]
                            ) !!}

                            @if ($errors->has('religion')) <p class="help-block">{{ $errors->first('religion') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Riwayat Kepemilikan Rekening Pinjaman *:</label>
                        <div class="col-md-8">
                            {!! Form::select( 'loan_history_accounts'
                                , array_merge([""=>""],get_loan_history('all'))
                                , old('loan_history_accounts')
                                , [
                                    'class' => 'select2 loan_history_accounts'
                                    , 'data-placeholder' => 'Pilih Riwayat Kepemilikan Rekening Pinjaman'
                                ]
                            ) !!}

                            @if ($errors->has('loan_history_accounts')) <p class="help-block">{{ $errors->first('loan_history_accounts') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Pekerjaan / Usaha *:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="job" maxlength="50" value="{{ $eformData['customer']['work']['work'] }}" readonly="">
                            @if ($errors->has('job')) <p class="help-block">{{ $errors->first('job') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No Telp Kantor / Tempat Usaha *:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control numericOnly" name="office_phone" maxlength="12" value="{{ old('office_phone') }}">
                            @if ($errors->has('office_phone')) <p class="help-block">{{ $errors->first('office_phone') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Status Kepegawaian *:</label>
                        <div class="col-md-8">
                            {!! Form::select( 'employment_status'
                                , array_merge([""=>""],get_employment('all'))
                                , old('employment_status')
                                , [
                                    'class' => 'select2 employment_status'
                                    ,'data-placeholder' => 'Pilih Status Kepegawaian'
                                ]
                            ) !!}

                            @if ($errors->has('employment_status')) <p class="help-block">{{ $errors->first('employment_status') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Usia MPP *:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control numericOnly age-of-mpp" name="age_of_mpp" maxlength="2" value="{{ old('age_of_mpp') }}">
                            @if ($errors->has('age_of_mpp')) <p class="help-block">{{ $errors->first('age_of_mpp') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nomor NPWP *:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control numericOnly" name="npwp_number" maxlength="50" value="{{old('npwp_number')}}" id="npwp_number">
                            @if ($errors->has('npwp_number')) <p class="help-block">{{ $errors->first('npwp_number') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No Rekening Pinjaman / ID Aplikasi *:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control numericOnly" name="ref_number" maxlength="20" value="{{ $eformData['ref_number'] }}" readonly="">
                            @if ($errors->has('account')) <p class="help-block">{{ $errors->first('account') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Jumlah Permohonan *:</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control numericOnly currency-rp" name="amount" maxlength="16" readonly value="{{ $eformData['nominal'] }}">
                                @if ($errors->has('amount')) <p class="help-block">{{ $errors->first('amount') }}</p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Jenis Permohonan *:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="product_type" maxlength="50" value="{{ strtoupper($eformData['product_type']) }}" readonly="">
                            @if ($errors->has('product_type')) <p class="help-block">{{ $errors->first('product_type') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tujuan Kunjungan *:</label>
                        <div class="col-md-8">
                            {!! Form::select( 'purpose_of_visit'
                                , array("" => "" , "prakarsa" => "Prakarsa Kredit" , "negosiasi" => "Negosiasi" ,"pembinaan" => "Pembinaan" , "penagihan" => "Penagihan" , "lain-lain" => "Lain-lain" )
                                , old('purpose_of_visit')
                                , [
                                    'class' => 'select2 purpose_of_visit'
                                    ,'data-placeholder' => 'Pilih Tujuan Kunjungan'
                                ]
                            ) !!}
                            <div id="other-input" style="display: none;">
                                <input type="text" class="form-control">
                            </div>
                            @if ($errors->has('purpose_of_visit')) <p class="help-block">{{ $errors->first('purpose_of_visit') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Hasil Kunjungan *:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="visit_result">{{ old('result') }}</textarea>
                            @if ($errors->has('result')) <p class="help-block">{{ $errors->first('result') }}</p> @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
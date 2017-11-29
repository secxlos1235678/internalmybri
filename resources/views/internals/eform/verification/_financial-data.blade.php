<div class="row">
    <div class="col-md-12">
        <div class="panel panel-color panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Data Keuangan</h3>
            </div>
            <div class="col-md-12">
                <div class="card-box m-t-30">
                    <h4 class="m-t-min30 m-b-30 header-title custom-title">Nasabah</h4>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label title ="Take Home Pay Per Bulan" class="col-md-4 control-label">Gaji/Pendapatan * :</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                            @if ($type != 'preview')
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control numericOnly currency-rp" name="salary" maxlength="24" value="{{$dataCustomer['customer']['salary']}}">
                                                @if ($errors->has('salary')) <p class="help-block">{{ $errors->first('salary') }}</p> @endif
                                            @else
                                                <p>Rp. {{ number_format($dataCustomer['customer']['salary'],2) }}</p>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label title ="Rata-Rata Per Bulan" class="col-md-4 control-label">Pendapatan Lain * :</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                            @if ($type != 'preview')
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control numericOnly currency-rp" name="other_salary" maxlength="24" value="{{$dataCustomer['customer']['other_salary']}}">
                                                @if ($errors->has('salary')) <p class="help-block">{{ $errors->first('salary') }}</p> @endif
                                            @else
                                                <p>Rp. {{ number_format($dataCustomer['customer']['other_salary']) }}</p>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Angsuran Pinjaman Lain * :</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                            @if ($type != 'preview')
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control numericOnly currency-rp" name="loan_installment" maxlength="24" value="{{$dataCustomer['customer']['loan_installment']}}">
                                            @else
                                                <p>Rp. {{ number_format($dataCustomer['customer']['loan_installment'])}}</p>
                                            @endif
                                                @if ($errors->has('loan_installment')) <p class="help-block">{{ $errors->first('loan_installment') }}</p> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label title ="Anak Dalam Tanggungan" class="col-md-5 control-label">Jumlah Tanggungan :</label>
                                        <div class="col-md-7">
                                        @if ($type != 'preview')
                                            <input type="text" class="form-control numericOnly" name="dependent_amount" maxlength="2" value="{{$dataCustomer['customer']['dependent_amount']}}">
                                        @else
                                            <p>{{@$dataCustomer['customer']['dependent_amount']}}</p>
                                        @endif
                                            @if ($errors->has('dependent_amount')) <p class="help-block">{{ $errors->first('dependent_amount') }}</p> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7" id="join_income">
                <div class="checkbox checkbox-single checkbox-primary">
                    <input type="checkbox" name="join_income" @if(!empty($dataCustomer)) @if(($dataCustomer['customer']['couple_salary']) > 0) ? checked="" @endif @endif value="join_income" id="join_check">
                    <label class="header-title custom-title-2" for="join_check"><b>  Joint Income</b></label>
                </div>
            </div>

            <!--Pasangan-->
            <div class="col-md-12" id="couple_financial"@if(($dataCustomer['customer']['couple_salary']) > 0) style="display:block;" @else style="display:none;" @endif >
                <div class="card-box m-t-30">
                    <h4 class="m-t-min30 m-b-30 header-title custom-title">Pasangan</h4>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label title ="Take Home Pay Per Bulan" class="col-md-4 control-label">Gaji/Pendapatan * :</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control numericOnly currency-rp" name="couple_salary" maxlength="24" @if(!empty($dataCustomer['customer']['couple_salary'])) value="{{$dataCustomer['customer']['couple_salary']}}" @else value="{{ old('couple_salary') }}" @endif>
                                                @if ($errors->has('couple_salary')) <p class="help-block">{{ $errors->first('couple_salary') }}</p> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label title ="Rata-Rata Per Bulan" class="col-md-4 control-label">Pendapatan Lain :</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control numericOnly currency-rp" name="couple_other_salary" maxlength="24" @if(!empty($dataCustomer['customer']['couple_other_salary'])) value="{{$dataCustomer['customer']['couple_other_salary']}}" @else value="{{ old('couple_other_salary') }}" @endif>
                                                @if ($errors->has('couple_other_salary')) <p class="help-block">{{ $errors->first('couple_other_salary') }}</p> @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <div class="form-group ">
                                        <label class="col-md-5 control-label">Angsuran Permohonan :</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control numericOnly currency-rp" name="couple_loan_installment" maxlength="24" @if(!empty($dataCustomer['customer']['couple_loan_installment'])) value="{{$dataCustomer['customer']['couple_loan_installment']}}" @else value="{{ old('couple_loan_installment') }}" @endif>
                                                @if ($errors->has('couple_loan_installment')) <p class="help-block">{{ $errors->first('couple_loan_installment') }}</p> @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--End-->
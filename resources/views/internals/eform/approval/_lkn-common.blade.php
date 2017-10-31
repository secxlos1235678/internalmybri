<div class="row">
     <div class="panel-heading">
        <h4 class="panel-title">Dokumen Pendukung</h4>
    </div>
    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="{{$detail['visit_report']['npwp']}}" class="img-responsive" id="zoom">
            <p>NPWP</p>
        </div>
    </div>
    
    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['legal_document'])){{$detail['visit_report']['legal_document']}}@endif" class="img-responsive">
            <p>Dokumen Legal Agunan</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['marrital_certificate'])){{$detail['visit_report']['marrital_certificate']}}@endif" class="img-responsive">
            <p>Slip Gaji</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            @if((pathinfo($detail['visit_report']['legal_document'], PATHINFO_EXTENSION) == 'jpg') || (pathinfo($detail['visit_report']['legal_document'], PATHINFO_EXTENSION) == 'png'))
            <img src="{{$detail['visit_report']['marrital_certificate']}}" class="img-responsive">
            @else
            <a href="#" class="btn btn-default"><i class="fa fa-download"></i></a>
            @endif
            <p>Dokumen Legal Usaha</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['marrital_certificate'])){{$detail['visit_report']['marrital_certificate']}}@endif" class="img-responsive">
            <p>Izin Praktek</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['marrital_certificate'])){{$detail['visit_report']['marrital_certificate']}}@endif" class="img-responsive">
            <p>Surat Keterangan Kerja</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['marrital_certificate'])){{$detail['visit_report']['marrital_certificate']}}@endif" class="img-responsive">
            <p>Kartu Keluarga</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['marrital_certificate'])){{$detail['visit_report']['marrital_certificate']}}@endif" class="img-responsive">
            <p>Akta Nikah/Cerai</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['divorce_certificate'])){{$detail['visit_report']['divorce_certificate']}}@endif" class="img-responsive">
            <p>Akta Pisah Harta</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['photo_with_customer'])){{$detail['visit_report']['photo_with_customer']}}@endif" class="img-responsive">
            <p>Foto Debitur</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['offering_letter'])){{$detail['visit_report']['offering_letter']}}@endif" class="img-responsive">
            <p>Surat Penawaran</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['down_payment'])){{$detail['visit_report']['down_payment']}}@endif" class="img-responsive">
            <p>Bukti DP</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['marrital_certificate'])){{$detail['visit_report']['marrital_certificate']}}@endif" class="img-responsive">
            <p>Surat Hak Milik</p>
        </div>
    </div>

    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['marrital_certificate'])){{$detail['visit_report']['marrital_certificate']}}@endif" class="img-responsive">
            <p>Izin Mendirikan Bangunan</p>
        </div>
    </div>
    
    <div class="col-md-6" align="center">
        <div class="card-box">
            <img src="@if(!empty($detail['visit_report']['building_tax'])){{$detail['visit_report']['building_tax']}}@endif" class="img-responsive">
            <p>PBB Terakhir</p>
        </div>
    </div>
</div>
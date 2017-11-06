@section('title','My BRI - Form Approval Collateral Properti')
@include('internals.layouts.head')
@include('internals.layouts.header')
@include('internals.layouts.navigation')
<div class="content-page">
    <div class="content">
        <div class="container">
            <!-- header -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Approval Collateral Properti</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="{{url('/')}}">Dasboard</a>
                            </li>
                            <li>
                                <a href="{{route('collateral.index')}}">List Approval Pengajuan Properti Baru</a>
                            </li>
                            <li class="active">
                                Approval Collateral Properti
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- contains -->
            <div class="row">
                <div class="col-md-12">
                    @if (\Session::has('error'))
                     <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    @endif
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="m-t-0 header-title"><b>Form Approval Collateral Appraisal</b></h5>
                                <p class="text-muted m-b-30 font-13">
                                    No. Contact Agen / Sales : 
                                </p>
                                @if (\Session::has('error'))
                                 <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                                @endif

                                <!-- detail properti -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Data Properti</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Nama Proyek :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">ELWYN GOTTLIEB</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Kota :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Bandung</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Kategori :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Rukan</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Foto :</label>
                                                        <div class="col-md-7">
                                                            <img id="preview" src="{{asset('assets/images/logo_dummy.png')}}" width="300">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Deskripsi Properti :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Architecto dolorem ut voluptas vitae numquam. Ipsum sequi delectus tempora sit. Nulla dolorum quisquam recusandae eligendi.</p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <form class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Nama PIC Proyek :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Reece Morar</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Alamat Proyek :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">224 Conn Springs West Donnashire, MS 16200-7219</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Nomor PKS :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">871871811</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">No. HP PIC Project :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">08191777171</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Fasilitas :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Kamar Tidur, Kamar Mandi</p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- tipe -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Tipe Properti</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered accountTable" id="accountTable0">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Tipe</th>
                                                            <th>Luas Bangunan (m<sup>2</sup>)</th>
                                                            <th>Luas Tanah (m<sup>2</sup>)</th>
                                                            <th>Sertifikat</th>
                                                            <th>Stok</th>
                                                            <th>Foto</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <p class="form-control-static">21 Lux</p>
                                                            </td>
                                                            <td>
                                                                <p class="form-control-static">11</p>
                                                            </td>
                                                            <td>
                                                                <p class="form-control-static">120</p>
                                                            </td>
                                                            <td>
                                                                <p class="form-control-static">SHM</p>
                                                            </td>
                                                            <td>
                                                                <p class="form-control-static">1</p>
                                                            </td>
                                                            <td>
                                                                <img id="preview" src="{{asset('assets/images/logo_dummy.png')}}" width="200">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                    </div>
                                                </div>
                                            </div>                    
                                        </div>
                                    </div>
                                </div>

                                <!-- unit -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Unit Properti</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered accountTable" id="accountTable0">
                                                    <thead>
                                                        <tr>
                                                            <th>Tipe Proyek</th>
                                                            <th>Alamat</th>
                                                            <th>Harga</th>
                                                            <th>Available</th>
                                                            <th>Status</th>
                                                            <th>Foto</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <p class="form-control-static">21 Lux</p>
                                                            </td>
                                                            <td>
                                                                <p class="form-control-static">Jln. Asia Afrika</p>
                                                            </td>
                                                            <td>
                                                                <p class="form-control-static">Rp. 154.215.245</p>
                                                            </td>
                                                            <td>
                                                                <p class="form-control-static">Avaliable</p>
                                                            </td>
                                                            <td>
                                                                <p class="form-control-static">Baru</p>
                                                            </td>
                                                            <td>
                                                                <img id="preview" src="{{asset('assets/images/logo_dummy.png')}}" width="200">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                    </div>
                                                </div>
                                            </div>                    
                                        </div>
                                    </div>
                                </div>

                                <!-- informasi penilaian -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Informasi Penilaian</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Tipe Agunan :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">ELWYN GOTTLIEB</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Kota :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Bandung</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Kecamatan :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Cigondewah</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Kelurahan/Desa :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Melong</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">RT/RW :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">07/01</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Jarak :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">10 KM dari pusat Kota</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Posisi Terhadap Jalan :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Langsung menghadap jalan</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Bentuk Tanah :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Trapesium</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Jarak Posisi Terhadap Jalan :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">10 Meter</p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <form class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Batas Utara :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Sungai</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Batas Timur :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Rumah Sakit</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Batas Barat :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Indomaret</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Batas Selatan :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Danau</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Keterangan Lain :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Lorem ipsum</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Permukaan Tanah :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">Tanah Rata</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Luas Tanah Sesuai Lapangan :</label>
                                                        <div class="col-md-7">
                                                            <p class="form-control-static">250 meter persegi</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label"></label>
                                                        <a href="#"><label class="col-md-7 control-label">+ Lihat informasi lain</label></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <!-- rekomendasi approval -->
                                        <form class="form-horizontal" role="form" method="POST" id="form1">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="is_approved" id="is_approved">
                                            <div class="text-center">
                                                <button type="submit" href="#" class="btn btn-success waves-light waves-effect w-md m-b-20" id="btn-approve">Setujui</button>
                                                <button type="submit" href="#" class="btn btn-danger waves-light waves-effect w-md m-b-20" id="btn-reject">Tolak</button>
                                                <a href="{{URL::previous()}}" class="btn btn-default waves-light waves-effect w-md m-b-20">Kembali</a>
                                            </div>
                                        </form>
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

@include('internals.layouts.footer')
@include('internals.layouts.foot')

<script type="text/javascript">
    $(document).ready(function () {
        var lastStatusElement = null;
        $('.select2').select2({
            witdh : '100%',
            allowClear: true,
        });
        
        $('.name').select2({
            witdh : '100%',
            allowClear: true,
            ajax: {
                url: '{{route("getAO")}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        name: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    // console.log(data);
                    return {
                        results: data.officers.data,
                        pagination: {
                            more: (params.page * data.officers.per_page) < data.officers.total
                        }
                    };
                },
                cache: true
            },
        });
    });
</script>
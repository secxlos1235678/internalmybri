@section('title','My BRI - E-Form')
@include('internals.layouts.head')
@include('internals.layouts.header')
@include('internals.layouts.navigation')
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">E-Form</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="{{url('/')}}">Dashboard</a>
                                        </li>
                                        <li class="active">
                                            E-Form
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                @if (\Session::has('success'))
                                    <div class="alert alert-success">{{ \Session::get('success') }}</div>
                                @endif
                                <div class="card-box">
                                    <div class="add-button">
                                        <!-- <a href="#filter" class="btn btn-primary waves-light waves-effect w-md m-b-15" data-toggle="collapse"><i class="mdi mdi-filter"></i> Filter</a> -->
                                        <a href="{{route('eform.create')}}" class="btn btn-primary waves-light waves-effect w-md m-b-15"><i class="mdi mdi-plus-circle-outline"></i> Tambah Pengajuan Aplikasi</a>
                                        <!-- <a href="#" class="btn btn-primary waves-light waves-effect w-md m-b-15"><i class="mdi mdi-export"></i> Ekspor ke Excel</a> -->
                                    </div>
                                    <div id="filter" class="m-b-15">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="card-box">
                                                    <form class="form-horizontal" role="form">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Tanggal Pengajuan :</label>
                                                            <div class="col-sm-4">
                                                                <input type="text" class="form-control" id="from" name="start_date">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <input type="text" class="form-control" id="to" name="end_date">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Nomor Referensi :</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="ref_number" id="ref_number">
                                                            </div>
                                                        </div>

                                                        {{-- <div class="form-group">
                                                            <label class="col-sm-4 control-label">Nama Customer :</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="customer_name" id="customer_name">
                                                            </div>
                                                        </div> --}}

                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Status Pengajuan :</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" id="status">
                                                                    <option selected="" value="All"> Semua</option>
                                                                    <option value="Rekomend">Pengajuan Kredit</option>
                                                                    <option value="Dispose">Disposisi Pengajuan</option>
                                                                    <option value="Initiate">Prakarsa</option>
                                                                    <option value="Submit">Proses CLF</option>
                                                                    <option value="Approval1">Kredit Disetujui</option>
                                                                    <option value="Approval2">Rekontes Kredit</option>
                                                                    <option value="Rejected">Kredit Ditolak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Status Prescreening :</label>
                                                            <div class="col-sm-8">
                                                                <select id="prescreening_filter" class="form-control">
                                                                    <option selected="" value="All"> Semua</option>
                                                                    <option value="1" class="text-success">Hijau</option>
                                                                    <option value="2" class="text-warning">Kuning</option>
                                                                    <option value="3" class="text-danger">Merah</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="text-right">
                                                        <a href="javascript:void(0);" class="btn btn-orange waves-light waves-effect w-md" id="btn-filter">Filter</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="datatable" class="table table-bordered">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No. Ref</th>
                                                <th>Nasabah</th>
                                                <th>Nominal</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>No. HP</th>
                                                <th>Status Prescreening</th>
                                                <th>id</th>
                                                <th>Status</th>
                                                <th>Aging (hari)</th>
                                                <th>Status Data Nasabah</th>
                                                {{-- <th>Catatan Disposisi</th> --}}
                                                <th style="width: 100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@include('internals.eform._result-modal')
@include('internals.layouts.footer')
@include('internals.layouts.foot')
<script type="text/javascript">
    $(document).ready(function(){
        $("#from").datepicker({
            todayBtn:  1,
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#to').datepicker('setStartDate', minDate);
        });

        $("#to").datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        }).on('changeDate', function (selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#from').datepicker('setEndDate', maxDate);
            });

    });

    var table1 = $('#datatable').DataTable({
            searching: false,
            order : [[3, 'asc']],
            "language": {
                "emptyTable": "No data available in table"
            }
        });

    $(document).on('click', "#btn-filter", function(){
        table1.destroy();
        reloadData1($('#from').val(), $('#to').val(), $('#status').val());
    })

    //show modal CRS
    $(document).on('click', "#btn-prescreening", function(){
        eformId = $(this).parent().next().html();

        HoldOn.open();

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: '{{ route("getPrescreening") }}',
            data: {
                eform : eformId
            },
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }

        }).done(function(data){
            console.log(data);
            // sicd.bikole: 1 = hijau; 2 = kuning; dst = merah
            contents = data.response.contents;

            $('.card-box.m-t-30.remove-class-prescreening').remove();

            if (contents.eform.prescreening_status == "Hijau") {
                warna = '<p class="text-success form-control-static">Hijau</p>';

            } else if (contents.eform.prescreening_status == "Kuning") {
                warna = '<p class="text-warning form-control-static">Kuning</p>';

            } else if (contents.eform.prescreening_status == "Merah") {
                warna = '<p class="text-danger form-control-static">Merah</p>';

            }

            pefindo_warna = '<p class="text-warning form-control-static">Kuning</p>';
            if (contents.eform.pefindo_score >= 250 && contents.eform.pefindo_score <= 573) {
                pefindo_warna = '<p class="text-danger form-control-static">Merah</p>';

            } else if (contents.eform.pefindo_score >= 677 && contents.eform.pefindo_score <= 900 ) {
                pefindo_warna = '<p class="text-success form-control-static">Hijau</p>';

            }

            $("#prescreening-nik").html(contents.eform.nik);
            $("#prescreening-name").html(contents.eform.customer_name);
            $("#prescreening-result").html(warna);
            $("#prescreening-color").html(pefindo_warna);
            $("#prescreening-score").html(contents.eform.pefindo_score);
            $("#prescreening-notice").html(contents.eform.ket_risk);

            uploadscore = contents.eform.uploadscore;
            html = '';
            assets = "{{asset('assets/images/download.png')}}";

            if ( uploadscore != null || uploadscore != '') {
                split = uploadscore.split(',');
                $.each(split, function(key, value) {
                    if (value != ''){
                        html += '<a href="'+value+'" target="_blank"><img src="'+assets+'" width="50" class="img-responsive"></a><br/>';
                    }
                })
            } else {
                html = '<p class="form-control-static">-</p>';
            }
            $("#prescreening-image").html(html);

            base = $(".card-box.m-t-30.after-this");

            if (contents.dhn.warna == "Hijau") {
                warna = '<p class="text-success form-control-static">Hijau</p>';

            } else if (contents.dhn.warna == "Kuning") {
                warna = '<p class="text-warning form-control-static">Kuning</p>';

            } else if (contents.dhn.warna >= "Merah") {
                warna = '<p class="text-danger form-control-static">Merah</p>';

            }

            html = '<div class="card-box m-t-30 remove-class-prescreening"><h4 class="m-t-min30 m-b-30 header-title custom-title" id="success">Hasil DHN</h4><div class="row"><div class="col-md-6"><div class="form-horizontal" role="form"><div class=""><label class="col-md-6 control-label"> Warna </label><div class="col-md-6">'+warna+'</div></div></div></div></div></div>';

            $.each(contents.sicd, function(key, sicd) {
                if (sicd.bikole == 1) {
                    warna = '<p class="text-success form-control-static">Hijau</p>';

                } else if (sicd.bikole == 2) {
                    warna = '<p class="text-warning form-control-static">Kuning</p>';

                } else if (sicd.bikole >= 3) {
                    warna = '<p class="text-danger form-control-static">Merah</p>';

                }

                html += '<div class="card-box m-t-30 remove-class-prescreening"><h4 class="m-t-min30 m-b-30 header-title custom-title" id="success">Hasil SICD</h4><div class="row"><div class="col-md-6"><div class="form-horizontal" role="form"><div class=""><label class="col-md-6 control-label"> Nama Nasabah </label><div class="col-md-6"><p class="form-control-static">'+sicd.nama_debitur+'</p></div></div><div class=""><label class="col-md-6 control-label"> NIK </label><div class="col-md-6"><p class="form-control-static">'+sicd.no_identitas+'</p></div></div><div class=""><label class="col-md-6 control-label"> Tanggal Lahir </label><div class="col-md-6"><p class="form-control-static">'+sicd.tgl_lahir+'</p></div></div><div class=""><label class="col-md-6 control-label"> Kolektibilitas </label><div class="col-md-6"><p class="form-control-static">'+sicd.bikole+'</p></div></div><div class=""><label class="col-md-6 control-label"> Warna </label><div class="col-md-6">'+warna+'</div></div><div class=""><label class="col-md-6 control-label"> Status </label><div class="col-md-6"><p class="form-control-static">'+sicd.status+'</p></div></div></div></div></div>';
            })
            $(html).insertAfter(base);

            // $('#detail').html(data['view']);
            $('#result-modal').modal('show');
            HoldOn.close();

        }).fail(function(errors) {
            alert("Gagal Terhubung ke Server");
            HoldOn.close();

        });
    });

    function reloadData1(from, to, status)
      {
        table1 = $('#datatable').DataTable({
           processing : true,
           serverSide : true,
           order : [[3, 'asc']],
           lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'All' ]
            ],
           language : {
                infoFiltered : '(disaring dari _MAX_ data keseluruhan)'
            },
            ajax : {
                url : '/datatables/eform-ao',
                data : function(d, settings){
                    var api = new $.fn.dataTable.Api(settings);

                    d.page = Math.min(
                        Math.max(0, Math.round(d.start / api.page.len())),
                        api.page.info().pages
                    );

                    d.start_date = $('#from').val();
                    d.end_date = $('#to').val();
                    d.status = $('#status').val();
                    d.ref_number = $('#ref_number').val();
                    d.customer_name = $('#customer_name').val();
                    d.prescreening = $('#prescreening_filter').val();
                }
            },
          aoColumns : [
                {   data: 'ref_number', name: 'ref_number', bSortable: false },
                {   data: 'customer_name', name: 'customer_name', bSortable: false  },
                {   data: 'request_amount', name: 'request_amount', bSortable: false  },
                {   data: 'created_at', name: 'created_at' },
                {   data: 'mobile_phone', name: 'mobile_phone', bSortable: false  },
                {   data: 'prescreening_status', name: 'prescreening_status', bSortable: false },
                {   data: 'id', name: 'eforms.id', bSortable: false, className: 'hidden' },
                {   data: 'status', name: 'created_at', bSortable: false },
                {   data: 'aging', name: 'aging' },
                {   data: 'response_status'
                    , name: 'response_status'
                    , bSortable: false
                    , mRender: function (data, type, full) {
                        text = '-';

                        if (full.response_status == 'approve') {
                            text = 'Telah Disetujui';

                        } else if(full.response_status == 'reject') {
                            text = 'Belum Disetujui';

                        } else if(full.response_status == 'unverified') {
                            text = 'Dalam Proses';

                        }
                        return text;
                    }
                },
                //{   data: 'aging', name: 'aging' },
                {   data: 'action', name: 'action', orderable: false, searchable: false}
            ],
      });
    }
</script>
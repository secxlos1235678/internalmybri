@section('title','My BRI - Index Report')
@include('internals.layouts.head')
@include('internals.layouts.header')
@include('internals.layouts.navigation')
<style>
  .select2-selection__clear {
    display: none;
  }
</style>
<div class="content-page">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">

          <div class="page-title-box">
            <h4 class="page-title">Daftar Report</h4>
            <ol class="breadcrumb p-0 m-0">
              <li>
                <a href="">Dashboard</a>
              </li>
              <li class="active">
                Daftar Report
              </li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      @if (\Session::has('success'))
      <div class="alert alert-success">{{ \Session::get('success') }}</div>
      @endif
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box">
            <fieldset hidden>
              <div class="add-button">
                <a href="#filter" class="btn btn-primary waves-light waves-effect w-md m-b-15" data-toggle="collapse"><i class="mdi mdi-filter"></i> Filter</a>
                <a href="#" class="btn btn-primary waves-light waves-effect w-md m-b-15"><i class="mdi mdi-sync"></i> Sinkronisasi Profil Customer</a>
                <a href="#" class="btn btn-primary waves-light waves-effect w-md m-b-15"><i class="mdi mdi-export"></i> Ekspor ke Excel</a>
              </div>
            </fieldset>
            <div id="filter" class="m-b-15">
              <div class="row">
                <div class="col-md-8">
                  <div class="card-box">
                    <form class="form-horizontal" role="form">

                      <div class="form-group">
                        <label class="col-sm-4 control-label">Kantor Wilayah :</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="kanwil" name="kanwil" {{($regionList == "disable") ? "disabled" : ""}}>
                            @foreach($kanwil['data'] as $kw)
                            <option value="{{$kw['region_id']}}" {{($kw['region_id'] == $region) ? "selected" : ""}}> {{$kw['region_name']}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">Kantor Cabang :</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="kanca" name="kacab" {{($branchList == "disable") ? "disabled" : ""}}>
                            <option value="">Semua</option>
                            @foreach($kanca as $k)
                            <option value="{{$k['mainbr']}}" {{($k['mainbr'] == $branch) ? "selected" : ""}}>{{$k['mbdesc']}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <label class="col-sm-4 control-label">Unit Kerja :</label>
                        <div class="col-sm-8">
                          <select class="form-control" id="uker" name="uker">
                            <option selected="" value="All"> Semua</option>
                          </select>
                        </div>
                      </div> -->

                      <div class="form-group">
                        <label class="col-sm-4 control-label">Pemasar :</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="pemasar">
                            <option selected="" value=""> Semua</option>
                            @foreach($fo as $f)
                            <option value="{{$f['PERNR']}}">{{$f['SNAME']}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                    </form>
                    <div class="text-right">
                      <a href="javascript:void(0);" class="btn btn-orange waves-light waves-effect w-md" id="btn-filter">Cari</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-scroll table-responsive" id="table-activity">
              <table id="datatable" class="table table-bordered">
                <thead class="bg-primary text-center">
                  <tr>
                    <th>No</th>
                    <th>Wilayah</th>
                    <th>Cabang</th>
                    <th>Nama FO</th>
                    <th>Activity</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Alamat</th>
                    <th>Jenis Marketing</th>
                    <th>Nama Nasabah</th>
                    <th>Deskripsi</th>
                    <th>Hasil Activity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  @foreach($reports as $report)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$report['wilayah']}}</td>
                    <td>{{$report['cabang']}}</td>
                    <td>{{$report['fo_name']}}</td>
                    <td>{{$report['activity']}}</td>
                    <td>{{$report['tujuan']}}</td>
                    <td>{{$report['tanggal']}}</td>
                    <td>{{$report['alamat']}}</td>
                    <td>{{$report['marketing_type']}}</td>
                    <td>{{$report['nama']}}</td>
                    <td>{{$report['desc']}}</td>
                    <td>{{$report['result']}}</td>
                  </tr>
                  <?php $i++ ?>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('internals.layouts.footer')
@include('internals.layouts.foot')
<!-- <script type="text/javascript">
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
    searching : false,
    order : [[3, 'asc']],
    "language": {
      "emptyTable": "No data available in table"
    }
  });

  $(document).on('click', "#btn-filter", function(){
    table1.destroy();
    reloadData1($('#from').val(), $('#to').val(), $('#status').val());
  })

  function reloadData1(from, to, status)
  {
    table1 = $('#datatable').DataTable({
      searching : false,
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
        url : '/datatables/eform',
        data : function(d, settings){
          var api = new $.fn.dataTable.Api(settings);

          d.page = Math.min(
          Math.max(0, Math.round(d.start / api.page.len())),
          api.page.info().pages
          );

          d.start_date = from;
          d.end_date = to;
          d.status = status;
          d.ref_number = $('#ref_number').val();
          d.customer_name = $('#customer_name').val();
          d.prescreening = $('#prescreening_filter').val();
          d.product = $('#product_filter').val();
        }
      },
      aoColumns : [
      {   data: 'ref_number', name: 'ref_number',  bSortable: false },
      {   data: 'customer_name', name: 'customer_name',  bSortable: false  },
      {   data: 'request_amount', name: 'request_amount',  bSortable: false  },
      {   data: 'created_at', name: 'created_at' },
      {   data: 'branch_id', name: 'branch_id', bSortable: false, className: 'hidden' },
      {   data: 'prescreening_status', name: 'prescreening_status', bSortable: false },
      {   data: 'id', name: 'eforms.id', bSortable: false, className: 'hidden' },
      {   data: 'ao_name', name: 'ao_name', bSortable: false },
      {   data: 'status', name: 'status', bSortable: false },
      {   data: 'aging', name: 'aging' },
      {   data: 'action', name: 'action', orderable: false, searchable: false},
      ],
    });
  }
</script> -->
<script type="text/javascript">
  $('#kanwil').on('change', function(){
    HoldOn.open(options);
    $('#kanca').html('');
    $('#pemasar').html('');
    var region = $('#kanwil').val();
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '{{ url("report/list-kanca") }}',
        data: {
            region : region
        },
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }

    }).done(function(data){
      var options = '';
      for (var x = 0; x < data.length; x++) {
        options += '<option value="' + data[x]['mainbr'] + '">' + data[x]['mbdesc'] + '</option>';
      }
      // console.log("<option value=''>Semua</option>"+options);
      $('#kanca').html("<option value=''>Semua</option>"+options);
        HoldOn.close();
    }).fail(function(errors){
        alert("Gagal Terhubung ke Server");
        HoldOn.close();
    });

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '{{ url("report/list-fo") }}',
        data: {
            region : region
        },
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }

    }).done(function(data){
      console.log(data);
      var options = '';
      for (var x = 0; x < data.length; x++) {
        options += '<option value="' + data[x]['PERNR'] + '">' + data[x]['SNAME'] + '</option>';
      }
      // console.log("<option value=''>Semua</option>"+options);
      $('#pemasar').html("<option value=''>Semua</option>"+options);
    }).fail(function(errors){
        alert("Gagal Terhubung ke Server");
        HoldOn.close();
    });
  });

  $('#kanca').on('change', function(){
    HoldOn.open(options);
    var branch = $('#kanca').val();
    $('#pemasar').html('');
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '{{ url("report/list-fo-kanca") }}',
        data: {
            branch : branch
        },
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }

    }).done(function(data){
      console.log(data);
      var options = '';
      for (var x = 0; x < data.length; x++) {
        options += '<option value="' + data[x]['PERNR'] + '">' + data[x]['SNAME'] + '</option>';
      }
      // console.log("<option value=''>Semua</option>"+options);
      $('#pemasar').html("<option value=''>Semua</option>"+options);
      HoldOn.clos();
    }).fail(function(errors){
        alert("Gagal Terhubung ke Server");
        HoldOn.close();
    });
  });

  $('#btn-filter').on('click', function() {
    HoldOn.open(options);
    var kanwil = $('#kanwil').val();
    var kanca = $('#kanca').val();
    var pemasar = $('#pemasar').val();
    var start = $('#start').val();
    var end = $('#end').val();
    // console.log(kanwil);
    $.ajax({
        type: 'POST',
        url: '{{ url("report/list-report-activity") }}',
        data: {
            region : kanwil,
            branch : kanca,
            pn : pemasar,
            start: start,
            end: end
        },
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }

    }).done(function(data){
      console.log(data);
      $('#table-activity').html(data);
      $('#datatable').dataTable();
      HoldOn.close();
    }).fail(function(errors){
        alert("Gagal Terhubung ke Server");
        HoldOn.close();
    });
  });
</script>

<script type="text/javascript">
$('#add_account').click(function(){
  var index = $('.bank').length;
    $('#mutations').append(
        '<div class="panel-body" style="border-style:solid;border-width:0.5px;border-color:#f3f3f3">'
            +'<div class="row">'
                +'<div class="col-md-4">'
                    +'<div class="form-horizontal" role="form">'
                        +'<div class="form-group">'
                            +'<label class="col-md-4 control-label">Nama Bank *:</label>'
                            +'<div class="col-md-6">'
                                +'<select class="form-control bank" name="mutations['+index+'][bank]">'
                                   +' <option selected="" disabled="">-- Pilih Bank --</option>'
                                   +' <option value="bni">BNI</option>'
                                   +' <option value="mandiri">Bank Mandiri</option>'
                               +' </select>'
                            +'</div>'
                        +'</div>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-5">'
                    +'<div class="form-horizontal" role="form">'
                       +' <div class="form-group">'
                           +' <label class="col-md-4 control-label">No. Rekening *:</label>'
                           +' <div class="col-md-6">'
                                +'<input type="text" class="form-control numericOnly" name="mutations['+index+'][number]" maxlength="12">'
                            +'</div>'
                        +'</div>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-2 pull-right">'
                    +'<div class="form-horizontal" role="form">'
                       +'<div class="form-group">'
                           +'<a href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-danger delete-account" title="Delete Account">'
                           +'Hapus Rekening </a>'
                        +'</div>'
                    +'</div>'
                +'</div>'
            +'</div>'
            +'<div class="row">'
                +'<div class="col-md-12">'
                   +' <table class="table table-bordered" id="accountTable'+index+'">'
                      +'<thead>'
                          +'<tr data-row="'+index+'">'
                              +'<th>Tanggal *</th>'
                              +'<th>Nominal *</th>'
                              +'<th>Jenis Transaksi *</th>'
                              +'<th>Keterangan *</th>'
                              +'<th></th>'
                          +'</tr>'
                     +' </thead>'
                     +' <tbody>'
                          +'<tr>'
                             +' <td>'
                                +'<div class="input-group">'
                                   +' <input type="text" class="form-control datepicker-mindate" id="datepicker-inline" name="mutations['+index+'][tables]['+index+'][date]">'
                                   +' <span class="input-group-addon b-0"><i class="mdi mdi-calendar"></i></span>'
                                +'</div>'
                              +'</td>'
                              +'<td>'
                                +'<div class="input-group">'
                                   +' <span class="input-group-addon">Rp</span>'
                                   +' <input type="text" class="form-control numericOnly currency-rp" name="mutations['+index+'][tables]['+index+'][amount]" maxlength="24">'
                                +'</div>'
                             +' </td>'
                             +' <td>'
                               +' <select class="form-control" name="mutations['+index+'][tables]['+index+'][type]">'
                                   +' <option selected="" disabled="">-- Pilih --</option>'
                                   +' <option value="1">Transaksi Tidak Terkait Usaha</option>'
                                   +' <option value="2">Transaksi Overbooking</option>'
                                +'</select>'
                              +'</td>'
                              +'<td>'
                                +'<input type="text" class="form-control" name="mutations['+index+'][tables]['+index+'][note]" maxlength="255">'
                              +'</td>'
                              +'<td>'
                                +'<a href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-info add-row" title="Tambah Row" id="add-row"  data-row="'+index+'"> + </a>'
                              +'</td>'
                          +'</tr>'
                     +' </tbody>'
                    +'</table>'
                    +'<div class="col-md-6">'
                      +'<div class="form-group mutation_file">'
                          +'<label class="col-md-4 control-label">Unggah Foto Slip Gaji *</label>'
                          +'<div class="col-md-8">'
                              +'<input type="file" class="filestyle-mutation" data-buttontext="Unggah" data-buttonname="btn-default" data-iconname="fa fa-cloud-upload" data-placeholder="Tidak ada file" name="mutations['+index+'][file]" accept="image/png,image/jpg,application/pdf,application/docx">'
                         +' </div>'
                     +' </div>'
                    +'</div>'
               +' </div>'
           +' </div>'
           +' <div class="panel-body">'
            +'</div>'
            +'<div class="mutation_form" id="render_form">'
            +'</div>'
      );
      $('.filestyle-mutation').filestyle({
        buttonText : "Unggah",
        htmlIcon : '<span class="icon-span-filestyle fa fa-cloud-upload"></span>',
        placeholder: "Tidak ada file"
      });
      
      $('.currency-rp').inputmask({ alias : "rupiah" });
  });

$('#mutations').on('click', '.delete-account', function () {
      $(this).closest('div.panel-body').remove();
  })

</script>
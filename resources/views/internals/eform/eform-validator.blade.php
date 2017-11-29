<script type="text/javascript">
    $form_container = $('#wizard-validation-form');

    $form_container.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
            return currentIndex > newIndex ? true : $form_container.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            // reinit gmaps
            google.maps.event.trigger(map, 'resize');
        },
        onFinishing: function (event, currentIndex) {
            return $form_container.valid();
        },
        onFinished: function (event, currentIndex) {
           // $form_container.submit();

                var request_amount = $('#request_amount').val();
                // console.log(request_amount);
                var year = $('#year').val();
                var office = $('#office').val();
                var appointment_date = $('#datepicker-mindate').val();
                var year = $('#year').val();
                var office = $('#branch_id').val();

                var nik = $('#nik').val();

                $.ajax({
                    dataType: 'json',
                    type: 'GET',
                    url: '/getData',
                    data: { nik : nik },
                    success: function(result, data) {
                        console.log(result);
                        var nik = result.data.nik;
                        var full_name = (result.data.first_name ? result.data.first_name : '')+' '+(result.data.last_name ? result.data.last_name : '');
                        var email = result.data.email;
                        var birth_place = result.data.birth_place;
                        var birth_date = result.data.birth_date;
                        var mother_name = result.data.mother_name;
                        var mobile_phone = result.data.mobile_phone;
                        var couple_nik = result.data.couple_nik;
                        var couple_name = result.data.couple_name;
                        var couple_birth_place = result.data.couple_birth_place;
                        var couple_birth_date = result.data.couple_birth_date;
                        var couple_identity = result.data.couple_identity;
                        var identity = result.data.identity;
                        var ao_name = result.data.name;

                        if(result.data.status == 1){
                            var status = 'Belum Menikah';
                            $('#view-modal #couple1').hide();
                            $('#view-modal #couple2').hide();
                            $('#view-modal #couple3').hide();
                            $('#view-modal #couple4').hide();
                            $('#view-modal #couple5').hide();
                        }else if(result.data.status == 2){
                            var status = 'Menikah';
                            $('#view-modal #couple1').show();
                            $('#view-modal #couple2').show();
                            $('#view-modal #couple3').show();
                            $('#view-modal #couple4').show();
                            $('#view-modal #couple5').show();
                        }else{
                            var status = 'Janda/Duda';
                            $('#view-modal #couple1').hide();
                            $('#view-modal #couple2').hide();
                            $('#view-modal #couple3').hide();
                            $('#view-modal #couple4').hide();
                            $('#view-modal #couple5').hide();
                        }

                        $('#view-modal').modal('show');
                        // currentClass = $('body').attr('class');
                        // $('body').attr('class', currentClass+' modal-open');
                        // console.log("pas validasi data");
                        $("#view-modal #request_amount").html('Rp '+request_amount);
                        $("#view-modal #year").html(year+' tahun');
                        $("#view-modal #month").html(year+' bulan');
                        $("#view-modal #office").html(office);
                        $("#view-modal #appointment_date").html(appointment_date);
                        $("#view-modal #nik").html(nik);
                        $("#view-modal #customer_name").html(full_name);
                        $("#view-modal #customer_fullname").html(full_name);
                        $("#view-modal #email").html(email);
                        $("#view-modal #birth_place").html(birth_place);
                        $("#view-modal #birth_date").html(birth_date);
                        $("#view-modal #mother_name").html(mother_name);
                        $("#view-modal #mobile_phone").html(mobile_phone);
                        $("#view-modal #status").html(status);
                        $("#view-modal #couple_nik").html(couple_nik);
                        $("#view-modal #couple_name").html(couple_name);
                        $("#view-modal #couple_birth_place").html(couple_birth_place);
                        $("#view-modal #couple_birth_date").html(couple_birth_date);
                        $("#view-modal #couple_identity").html('<img src="'+couple_identity+'" class="img-responsive">');
                        $("#view-modal #identity").html('<img src="'+identity+'" class="img-responsive">');
                        $("#view-modal #marritalstatus").val(status);
                        $("#view-modal #office").val(office);
                        $("#view-modal #ao_name").html(ao_name);

                    },
                    error: function(result, data){
                        console.log('error');
                    }
               });
                return false;
            }
    });

    $('.select2').select2({width: '100%'});
</script>
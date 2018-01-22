<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <p>Dengan ini saya meyakini kebenaran data nasabah dan merekomendasikan permohonan kredit untuk dapat diproses lebih lanjut</p>
                @if ($errors->has('job')) <p class="help-block">{{ $errors->first('job') }}</p> @endif
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="yes" value="yes" name="recommended" checked="">
                        <label for="yes"> Ya </label>
                    </div>
                    <div class="radio radio-pink radio-inline">
                        <input type="radio" id="no" value="no" name="recommended">
                        <label for="no"> Tidak </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
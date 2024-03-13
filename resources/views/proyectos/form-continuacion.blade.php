<div class="row align-items-center justify-content-center">
    <p>En caso afirmativo aprobar los rubros de gasto que se justifiquen de acuerdo con el proyecto</p>
    <h4>Recursos</h4>
    <span class="text-muted">*NOTA: en caso de no solicitar recursos omitir este espacio</span>
    <hr class="border border-dark border-1 opacity-50 mt-3">
    <div class="row col-md-6">
        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3711 Transporte aéreo nacional <br> <b>Monto solicitado:</b> <span class="text-muted">{{ $proyecto->recursos->p_01 }}</span></label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($evaluacion->p_01) ? $evaluacion->p_01 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>

        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">
                    3721 Transporte terrestre nacional <br> <b>Monto solicitado:</b> <span class="text-muted">{{ $proyecto->recursos->p_02 }}</span> </label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($evaluacion->p_02) ? $evaluacion->p_02 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>

        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3722 Casetas <br> <b>Monto solicitado:</b> <span class="text-muted">{{ $proyecto->recursos->p_03 }}</span></label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($evaluacion->p_03) ? $evaluacion->p_03 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>

        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3751 Hospedaje nacional <br> <b>Monto solicitado:</b> <span class="text-muted">{{ $proyecto->recursos->p_04 }}</span></label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($evaluacion->p_04) ? $evaluacion->p_04 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>
    </div>
    <div class="row col-md-6">
        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3753 Alimentación nacional <br> <b>Monto solicitado:</b> <span class="text-muted">{{ $proyecto->recursos->p_05 }}</span></label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($evaluacion->p_05) ? $evaluacion->p_05 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>
        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">2611 Combustible <br> <b>Monto solicitado:</b> <span class="text-muted">{{ $proyecto->recursos->p_06 }}</span></label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($evaluacion->p_06) ? $evaluacion->p_06 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>

        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">2111 Papelería <br> <b>Monto solicitado:</b> <span class="text-muted">{{ $proyecto->recursos->p_07 }}</span></label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($evaluacion->p_07) ? $evaluacion->p_07 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>
        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">2141 Tóner y memoria usb (para el caso de las memorias USB
                    con precio unitario menor a $4,211.83 pesos) <br> <b>Monto solicitado:</b> <span class="text-muted">{{ $proyecto->recursos->p_08 }}</span></label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($evaluacion->p_08) ? $evaluacion->p_08 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>
    </div>
</div>

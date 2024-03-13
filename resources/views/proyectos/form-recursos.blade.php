<div class="row align-items-center">
    <h4>Recursos</h4>
    <span class="text-muted">* NOTA: en caso de no solicitar recursos omitir este estacio</span>
    <hr class="border border-dark border-1 opacity-50 mt-3">
    <div class="row col-md-6">
        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3711 Transporte aéreo nacional</label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($proyecto->recursos->p_01) ? $proyecto->recursos->p_01 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>

        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3721 Transporte terrestre nacional</label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($proyecto->recursos->p_02) ? $proyecto->recursos->p_02 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>

        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3722 Casetas</label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($proyecto->recursos->p_03) ? $proyecto->recursos->p_03 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>

        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3751 Hospedaje nacional</label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($proyecto->recursos->p_04) ? $proyecto->recursos->p_04 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>
    </div>
    <div class="row col-md-6">
        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">3753 Alimentación nacional</label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($proyecto->recursos->p_05) ? $proyecto->recursos->p_05 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>
        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">2611 Combustible</label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($proyecto->recursos->p_06) ? $proyecto->recursos->p_06 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>

        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">2111 Papelería</label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($proyecto->recursos->p_07) ? $proyecto->recursos->p_07 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>
        <div class="col-md-12 pt-1 row justify-content-around align-items-center">
            <div class="col-md-8 ">
                <label class="form-label" for="">2141 Tóner y memoria usb (para el caso de las memorias USB
                    con precio unitario menor a $4,211.83 pesos)</label>
            </div>
            <div class="col-md-3">
                <input name="recursos[]" step="0.1"
                    value="{{ isset($proyecto->recursos->p_08) ? $proyecto->recursos->p_08 : 0 }}" min="0"
                    type="number" name="" class="form-control" id="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 mt-2 pt-2">
            <label class="form-label" for="recursos">En caso de solicitar recursos favor de justificarlos tomando en
                cuenta las normas
                de austeridad de la Universidad de Guadalajara (máx: 2000 caracteres)</label>
            <textarea name="justificacion_recursos" id="recursos" class="form-control">{{ isset($proyecto->recursos->justificacion) ? $proyecto->recursos->justificacion : 'No aplica' }}</textarea>
        </div>
    </div>

</div>

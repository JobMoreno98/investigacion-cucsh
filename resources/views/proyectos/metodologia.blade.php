<div class="row mt-3 justify-content-center align-items-center">
    <h3>Metodologia</h3>
    <hr class="mt-3">
    <div class="col-sm-12 col-md-6 p-2">
        <label class="form-label" for="">Metodologia</label>
        <textarea class="form-control" name="metodologia" id="" >{{ isset($metodologias->metodologia) ? $metodologias->metodologia :old('metodologia') }}</textarea>
    </div>
    <div class="col-sm-12 col-md-6 p-2">
        <label class="form-label" for="">Objetivos</label>
        <textarea class="form-control" name="objetivos" id="" >{{ isset($metodologias->objetivos) ? $metodologias->objetivos :old('objetivos') }}</textarea>
    </div>

    <div class="col-sm-12 col-md-6 p-2">
        <label class="form-label" for="">Preguntas o Hipotesis</label>
        <textarea class="form-control" name="hipotesis" id="" >{{ isset($metodologias->hipotesis) ? $metodologias->hipotesis : old('hipotesis') }}</textarea>
    </div>

    <div class="col-sm-12 col-md-6 p-2">
        <label class="form-label" for="">Criterios Éticos</label>
        <textarea class="form-control" name="criterios_eticos" id="" >{{ isset($metodologias->criterios_eticos) ? $metodologias->criterios_eticos :old('criterios_eticos') }}</textarea>
    </div>
    <div class="col-sm-12 col-md-6 p-2">
        <label class="form-label" for="">Referencias</label>
        <textarea class="form-control" name="referencias" id="" >{{ isset($metodologias->referencias) ? $metodologias->referencias :old('referencias') }}</textarea>
    </div>
</div>

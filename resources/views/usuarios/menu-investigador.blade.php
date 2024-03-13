<div class="section_our_solution mt-5">
    <div class="row justify-content-center">
        <div class=" col-sm-12 col-md-10 h-100">
            <div class="our_solution_category w-100 ">
                <div class="solution_cards_box sol_card_top_1 h-100">
                    <div class="solution_card pb-3">
                        <div class="solu_title">
                            <h3 class="text-center border-bottom">Menu investigador</h3>
                        </div>
                        <div class="solu_description">
                            <div class="row justify-content-center">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-auto m-1">
                                    <a href="{{ route('datos_generales') }}"
                                        class="w-100 text-decoration-none btn btn-primary ">Datos Generales</a>
                                </div>

                                @if (isset(Auth::user()->datos) && isset(Auth::user()->proyecto))
                                    <div class="col-sm-12 col-md-auto m-1">
                                        <a href="{{ route('proyectos.index') }}"
                                            class="w-100 text-decoration-none btn btn-primary ">Ver mis
                                            proyectos</a>
                                    </div>
                                @endif
                                @if (isset(Auth::user()->datos) && isset($ciclo->anio))
                                    <div class="col-sm-12 col-md-auto m-1">
                                        <a href="{{ route('proyectos.create') }}"
                                            class="w-100 text-decoration-none btn btn-primary ">
                                            Registrar Proyecto
                                        </a>
                                    </div>
                                @else
                                    @if (!isset($ciclo->anio))
                                        <p class="fs-6 text-muted m-0 mt-2 pt-2 fw-bold">* El registro de
                                            proyectos no esta disponible
                                            por el
                                            momento, favor de comunicarte a la Coordinación de Investigación para más
                                            información</p>
                                    @else
                                        <p class="fs-6 text-muted m-0 mt-2 pt-2  fw-bold">* Para poder registrar
                                            algún proyecto debes primero llenar tus datos generales</p>
                                    @endif
                                @endif
                                    <p class="text-muted m-0 mt-2 pt-2 border-top fw-bold">* Recuerda siempre tener tus datos generales actualizados.</p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

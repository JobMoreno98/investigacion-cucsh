<div class="section_our_solution mt-5">
    <div class="row justify-content-center">
        <div class=" col-sm-12 col-md-10 h-100">
            <div class="our_solution_category w-100 ">
                <div class="solution_cards_box sol_card_top_1 h-100">
                    <div class="solution_card pb-3">
                        <div class="solu_title">
                            <h3 class="text-center border-bottom">Menu evaluador</h3>
                        </div>
                        <div class="solu_description">
                            <div class="row justify-content-center">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-auto m-1">
                                    <a href="{{route('evaluador-proyectos',Auth::user()->id)}}" class="w-100 text-decoration-none btn btn-primary ">Ver
                                        proyectos a evaluar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

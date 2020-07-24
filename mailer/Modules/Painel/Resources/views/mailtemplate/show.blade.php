@extends('painel::layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Templates de Email | Ver Templates</h3>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="float-left mt-3">
                            <h3><a href="javascript:window.history.go(-1)" class="pull-right"><span
                                        class="fa fa-chevron-left"></span><span class="hidden-xs"> Voltar</span></a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! $template->content !!}
            </div>
        </div>
    </div>
</div>
</div>
@stop

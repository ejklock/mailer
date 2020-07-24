@extends('painel::layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Templates de Email | Criar Templates</h3>
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

                <form class="form-horizontal" role="form" method="POST"
                    action="{{ route('painel.mailtemplate.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Título</span>
                            </div>
                            <input type="text" name="name" aria-label="assunto" class="form-control">

                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Template</h5>
                                </div>
                                <div class="card-body">
                                    <textarea id="texto" class="my-editor" name="content"></textarea>
                                </div>
                            </div>


                        </div>

                        <div class="">
                            <div class="float-right">
                                <button type="submit" class="btn btn-outline-primary" style="font-size: 25px">
                                    Salvar</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@stop

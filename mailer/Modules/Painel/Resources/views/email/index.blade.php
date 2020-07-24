@extends('painel::layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Email | Enviar Emails</h3>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="float-right m-3">
                                <a title="Gerenciar Templates de Email" data-toggle="tooltip" data-placement="top"
                                    href="{{ route('painel.mailtemplate.index')}}"
                                    class="btn btn-lg btn-primary  float-right-right"><span class="fa fa-plus"></span>
                                    Gerenciar Templates</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <form class="form-horizontal" role="form" method="POST" action="{{ route('painel.email.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="form-group">


                            <div class="input-group mb-4">
                                <div class="input-group-prepend">

                                    <div class="input-group-text">
                                        <i class="far fa-file-excel p-1"></i>
                                        <i class="pr-2">Excel</i>
                                        <input type="checkbox" name="csv" id="csv" value="1"
                                            aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                                <input id="emails" name="to" type="text" placeholder="Informe os emails"
                                    class="form-control">
                            </div>


                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Responder Para</span>
                            </div>
                            <input type="text" name="replyto" value="email@example.com"
                                aria-label="assunto" class="form-control">

                        </div>


                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Assunto</span>
                            </div>
                            <input type="text" name="subject" aria-label="assunto" class="form-control">

                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Anexos</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" id="anexo" name="anexos[]" class="custom-file-input"
                                    id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" multiple>
                                <label class="custom-file-label" for="inputGroupFile01">Escolher Anexos</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Templates de Email</label>
                            </div>
                            <select class="custom-select" id="mail-template">
                                <option value="-1" selected>Em Branco</option>
                                @foreach ($templates as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Corpo do Email</h5>
                                </div>
                                <div class="card-body">
                                    <textarea id="content" class="my-editor" name="content"></textarea>
                                </div>
                            </div>


                        </div>

                        <div class="">
                            <div class="float-right">
                                <button type="submit" class="btn btn-outline-primary" style="font-size: 25px">
                                    <i class="far fa-paper-plane"></i> Enviar</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@stop

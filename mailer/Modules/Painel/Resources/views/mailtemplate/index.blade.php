@extends('painel::layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Templates de Email</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="float-right m-0">
                            <a title="Adicionar nova associação" data-toggle="tooltip" data-placement="top"
                                href="{{route('painel.mailtemplate.create')}}"
                                class="btn btn-lg btn-primary  float-right-right"><span class="fa fa-plus"></span>
                                Adicionar novo Template</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($templates as $template)
                                <tr>
                                    <td>
                                        {{ $template->name}}
                                    </td>
                                    <td>
                                        {{ $template->description}}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a title="Editar" href="{{route('painel.mailtemplate.edit',$template->id)}}"
                                                class="edit btn btn-secondary"><i style="font-size: 20px"
                                                    class="far fa-edit" aria-hidden="true"></i></a>
                                            <div class="btn-group" role="group">
                                                <a title="Ver"
                                                    href="{{route('painel.mailtemplate.show',$template->id)}}"
                                                    class="edit btn btn-primary"><i style="font-size: 20px"
                                                        class="fas fa-eye" aria-hidden="true"></i></a>

                                                <form action="{{route('painel.mailtemplate.destroy',$template->id)}}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="edit btn btn-danger" type="submit"><i
                                                            style="font-size: 20px" class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <p class="text-center">Nenhum template cadastrado ainda</p>
                                    </td>
                                </tr>

                                @endforelse
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('modules/painel/js/datatable.js') }}"></script>
@endsection

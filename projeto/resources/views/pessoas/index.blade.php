@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark float-left">Pessoas</h1>

            <form class="form-inline mt-1 ml-3 float-left" method="get" action="{{ route('pessoas')}}">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" name="search" type="search" placeholder="Busca" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
              <li class="breadcrumb-item active">Pessoa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
            @isset($search)
                <br>
                <h4 class="ml-3 mt-5">Busca por: {{$search}}</h4>
            @endisset
    </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-warning card-outline">
              <div class="card-body">
                <h5 class="card-title"><a class="btn btn-sm btn-outline-success" href="{{ route('pessoas.novo') }}">+ Pessoa</a></h5>

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>UF</th>
                        <th>Cidade</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @isset($pessoas)
                        @foreach($pessoas as $pessoa)
                        <tr>
                            <td>{{ $pessoa->id }}</td>
                            <td><a href="{{ route('pessoas.info', $pessoa->id) }}" >{{ $pessoa->nome}}</a></td>
                            <td>{{ $pessoa->cpf}}</td>
                            <td>{{ $pessoa->uf}}</td>
                            <td>{{ $pessoa->cidade}}</td>
                            <td><a href="javascript:void(0)" data-status="{{ $pessoa->status }}" data-id="{{$pessoa->id}}" id="modal_exemplo">{{ $pessoa->status }}</a>
                            </td>
                        </tr>
                        @endforeach
                      @endisset
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Botão para acionar modal -->


<!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="{{ route('pessoas.salvar.status') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put" />
            <input type="hidden" name="id" id="seletor-pessoaId" value="">
            <div class="form-group">
            <label for="apelido">Status</label>
                <select name="status" id="seletor-status" class="form-control">
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>
            </div>

            <input type="submit" class="btn btn-success float-right ml-2" value="Salvar">
            <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Fechar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
    <script>
        $('a#modal_exemplo').on('click', function(){
            let button      = $(this);
            let modal       = $('#modalExemplo').modal();
            let pessoaId    = button.data('id');
            let statusAtual = button.data('status');

            document.querySelector('#seletor-status').value = statusAtual;
            document.querySelector('#seletor-pessoaId').value = pessoaId;
        })
    </script>
@endsection

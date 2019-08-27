<style>
    .card-documento{
        border:2px solid #ffc107;
        border-radius: 5px !important;
        padding-top: 10px;
        padding-bottom: 10px;
        min-height: 150px;
    }
    .card-documento h2{
        font-size: 1.3rem;
    }

    .card-documento div{
        height: 50px;
    }
</style>
<div class="card card-warning card-outline">
    <div class="card-body">
        <div class="box-body box-profile">
            <h3 class="profile-username pt-2" style="border-bottom:1px solid #ffc107;">Documentos</h3>
            <div class="row">
                <div class="col-md-4 p-1">
                    <div class="card card-default card-outline">
                        <div class="card-body">
                            <div class="box-body box-profile">
                                <h3 class="profile-username pt-2" style="border-bottom:1px solid #ffc107;">Laudo para transferência</h3>
                                <div class="row m-1 mt-3">
                                    <div class="col-sm-12 m-0 p-0">
                                        <p>Foto do laudo efetuado.</p>
                                    </div>
                                    <div class="col-sm-12 m-0 p-0">
                                        @foreach ($documentos as $item)
                                            @if($item['tipo'] == 'LAUDO')
                                                <img class="img img-fluid"  src="{{ asset('storage/'.$item['nome']) }}">
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-sm-12 m-0 p-0">
                                        <form action="{{ route('documento.incluir') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="arquivo">
                                            <input type="hidden" name="tipo" value="LAUDO">
                                            <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                                            <input type="submit" class="btn btn-success btn-block mt-3 pl-5 pr-5" value="ENVIAR">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 m-0 p-1">
                    <div class="card card-default card-outline">
                        <div class="card-body">
                            <div class="box-body box-profile">
                                <h3 class="profile-username pt-2" style="border-bottom:1px solid #ffc107;">Documento de Frente</h3>
                                <div class="row m-1 mt-3">
                                    <div class="col-sm-12 m-0 p-0">
                                        <p>parte de cima do(a) RG ou CNH</p>
                                    </div>
                                    <div class="col-sm-12 m-0 p-0">
                                        @foreach ($documentos as $item)
                                            @if($item['tipo'] == 'IDENTIFICACAO_FRENTE')
                                                <br>
                                                <img class="img img-fluid" src="{{ asset('storage/'.$item['nome']) }}">
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-sm-12 m-0 p-0">
                                        <form action="{{ route('documento.incluir') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="arquivo">
                                            <input type="hidden" name="tipo" value="IDENTIFICACAO_FRENTE">
                                            <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                                            <input type="submit" class="btn btn-success btn-block mt-3 pl-5 pr-5" value="ENVIAR">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 m-0 p-1">
                    <div class="card card-default card-outline m-0">
                        <div class="card-body">
                            <div class="box-body box-profile">
                                <h3 class="profile-username pt-2" style="border-bottom:1px solid #ffc107;">Documento Verso</h3>
                                <div class="row m-1 mt-3">
                                    <div class="col-sm-12 m-0 p-0">
                                        <p>parte de cima do(a) RG(com cpf) ou CNH</p>
                                    </div>
                                    <div class="col-sm-12 m-0 p-0">
                                        @foreach ($documentos as $item)
                                            @if($item['tipo'] == 'IDENTIFICACAO_VERSO')
                                                <br>
                                                <img class="img img-fluid" src="{{ asset('storage/'.$item['nome']) }}">
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-sm-12 m-0 p-0">
                                        <form action="{{ route('documento.incluir') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="arquivo">
                                            <input type="hidden" name="tipo" value="IDENTIFICACAO_VERSO">
                                            <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                                            <input type="submit" class="btn btn-success btn-block mt-3 pl-5 pr-5" value="ENVIAR">
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
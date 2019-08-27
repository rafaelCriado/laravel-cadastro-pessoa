<div class="card card-warning card-outline">
    <div class="card-body">
        <div class="box-body box-profile">
            <a href="{{ route('pedido.atualizar.debitos', $pedido->id) }}" class="btn btn-dark btn-sm float-right">
                <i class="nav-icon fas fa-history"></i>
                Atualizar Débitos
            </a>
            
            <h3 class="profile-username pt-2" style="border-bottom:1px solid #ffc107;">{{$pedido->placa}}</h3>
            
            <p class="text-muted mb-0">Estado: <b>{{$pedido->uf}}</b></p>
            <br>
            
            <form action="{{ route('pedido.salvar.debitos', $pedido->id) }}" method="POST" name="formDebitos">
                <input type="hidden" name="_method" value="put" />
                {{ csrf_field() }}
                @foreach ($debitos as $debito=>$array)
                    <div class="callout callout-warning">
                        <h5>
                            <input type="checkbox" checked="checked" name="{{$debito}}-all" value="{{$soma_debitos[$debito]}}" id="">
                            <b>{{$debito}} - R$ {{ number_format($soma_debitos[$debito],2,',','.') }}</b>
                        </h5>
        
                        @if(is_array($array))
                            @foreach($array as $descricao=>$valor)
                                    <span>&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" checked="checked"  name="{{$debito}}-{{$descricao}}" value="{{$valor}}" id="">
                                        {{ $descricao }} - R$ {{ number_format($valor,2,',','.') }}
                                    </span>
                                    <br>
                            @endforeach
                        @else
                            <span>&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" checked="checked" name="{{$debito}}-{{$descricao}}" value="{{$array}}" id="">
                                R$ {{ number_format($array,2,',','.') }}
                            </span>
                            <br>
                        @endif
                    </div>
                @endforeach
                <div class="callout callout-warning">
                    <h5>
                        <input type="checkbox" checked="checked" name="TAXA_SERVICO-all" value="{{$soma_debitos['TAXA_SERVICO']}}" id="">
                        <b>TAXA DE SERVIÇO - R$ {{ number_format($soma_debitos['TAXA_SERVICO'],2,',','.') }}</b> 
                    </h5>
                </div>
                <h4 class="text-center bg-dark pt-2 pb-2"><b>Total &nbsp;&nbsp;&nbsp;R$ {{ number_format($total,2,',','.') }}</b></h4>
                <center><input type="submit" value="PROSSEGUIR" class="btn pl-5 pr-5 pt-2 pb-2 btn-success"></center>
            </form>
        </div>
    </div>
</div>
<div class="card card-warning card-outline">
    <div class="card-body">
        <div class="box-body box-profile">
            <h3 class="profile-username pt-2" style="border-bottom:1px solid #ffc107;">Endereço</h3>
                <!-- inicio form -->
            <form action="{{ route('pessoas.endereco.salvar', $pessoa->id) }} " method="post" >
                <input type="hidden" name="_method" value="put" />
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label id="erroCEP" style="color:red"></label>
                        <input placeholder="CEP" maxlength="9" onkeypress="mascara(this, '#####-###')" value="{{ $pessoa->cep }}" type="text" id="cep" name="cep" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for=""></label>
                            <input placeholder="Endereço" type="text" value="{{ $pessoa->logradouro }}" id="rua" name="logradouro" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""></label>
                            <input placeholder="Número" type="text" value="{{ $pessoa->numero }}" name="numero" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input placeholder="Cidade" id="cidade" type="text" name="cidade" value="{{ $pessoa->cidade }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="uf" id="uf" class="form-control">
                                @foreach ($estados as $estado)
                                    <option value="{{$estado->uf}}" @if (isset($pessoa->uf) and $pessoa->uf == $estado->uf)
                                        selected='selected'
                                    @endif>{{$estado->uf}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input placeholder="Bairro" type="text" value="{{ $pessoa->bairro }}" id="bairro" name="bairro" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input placeholder="Complemento" type="text" value="{{ $pessoa->complemento }}" id="complemento" name="complemento" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <input type="submit" class="btn pl-2 pr-2 pt-1 pb-1 btn-success" value="Atualizar Endereço">
                    </div>
                </div>
            </form>
            <!-- fim form -->
        </div>
    </div>
</div>

<script>
    var cep = document.getElementById('cep');
    cep.addEventListener('change',function(){
        fetch(`http://127.0.0.1:8000/cep/${cep.value}`)
        .then(response => response.json())
        .then(data=>mostrarResposta(data))
        .catch(erro => console.error(erro));
    })

    function mostrarResposta(cep) {
        if(cep.hasOwnProperty('erro')){
            document.getElementById('erroCEP').innerHTML('CEP não encontrado');
        }else{
            document.getElementById('rua').value = cep.logradouro;
            document.getElementById('cidade').value = cep.localidade;
            document.getElementById('bairro').value = cep.bairro;
            document.getElementById('uf').value = cep.uf;
            document.getElementById('complemento').value = cep.complemento;
            document.getElementById('cep').value = cep.cep;
        }
    }

    function mascara(t, mask){
        var i = t.value.length;
        var saida = mask.substring(1,0);
        var texto = mask.substring(i)
        if (texto.substring(0,1) != saida){
            t.value += texto.substring(0,1);
        }
    }
</script>

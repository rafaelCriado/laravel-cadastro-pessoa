<div class="row">
    <div class="col-3">
        <div class="form-group">
            <label for="enderecoCEP">CEP</label>
            <input type="text" class="form-control" id="enderecoCEP" name="cep" placeholder="CEP" value="{{ isset($pessoa->cep) ? $pessoa->cep : '' }}">
        </div>
    </div>
    <div class="col-7">
        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="{{ isset($pessoa->endereco) ? $pessoa->endereco : '' }}">
        </div>
  </div>
  <div class="col-2">
    <div class="form-group">
      <label for="enderecoNumero">Número</label>
      <input type="text" class="form-control" id="enderecoNumero" name="numero" placeholder="Número" value="{{ isset($pessoa->numero) ? $pessoa->numero : '' }}">
    </div>
  </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="form-group">
            <label for="enderecoBairro">Bairro</label>
            <input type="text" class="form-control" id="enderecoBairro" name="bairro" placeholder="Bairro" value="{{ isset($pessoa->bairro) ? $pessoa->bairro : '' }}">
        </div>
    </div>

    <div class="col-3">
    <div class="form-group">
      <label for="enderecoCidade">Cidade</label>
      <input type="text" class="form-control" id="enderecoCidade" name="cidade" placeholder="Cidade" value="{{ isset($pessoa->cidade) ? $pessoa->cidade : '' }}">
    </div>
  </div>
  <div class="col-2">
    <div class="form-group">
      <label for="apelido">Estado</label>
      <select name="estado" id="uf" class="form-control">
        @foreach ($estados as $estado)
          <option value="{{$estado->uf}}" @if (isset($pedido->uf) and $pedido->uf == $estado->uf)
              selected='selected'
          @endif>{{$estado->uf}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-3">
    <div class="form-group">
      <label for="enderecoComplemento">Complemento</label>
      <input type="text" class="form-control" id="enderecoComplemento" name="complemento" placeholder="Complemento" value="{{ isset($pessoa->complemento) ? $pessoa->complemento : '' }}">
    </div>
  </div>
</div>
<script>
    var cep = document.getElementById('enderecoCEP');
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
            document.getElementById('endereco').value = cep.logradouro;
            document.getElementById('enderecoCidade').value = cep.localidade;
            document.getElementById('enderecoBairro').value = cep.bairro;
            document.getElementById('uf').value = cep.uf;
            document.getElementById('enderecoComplemento').value = cep.complemento;
            document.getElementById('enderecoCEP').value = cep.cep;
        }
    }
</script>

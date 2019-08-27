<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ isset($pedido->nome) ? $pedido->nome : '' }}">
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for ="cpf">CPF &nbsp;<span id="erroCPF" style="color:red"></span></label>
      <input type="text" class="form-control" maxlength="14"  id="cpf" name="cpf" placeholder="CPF" value="{{ isset($pedido->cpf) ? $pedido->cpf : '' }}">
    </div>  
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label for="placa">Placa/Renavam do Veículo</label>
      <input type="text" class="form-control" id="placa" name="placa" placeholder="Placa/Renavam" value="{{ isset($pedido->placa) ? $pedido->placa : '' }}">
    </div>  
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="apelido">Estado</label>
      <select name="uf" id="uf" class="form-control">
        @foreach ($estados as $estado)
          <option value="{{$estado->uf}}" @if (isset($pedido->uf) and $pedido->uf == $estado->uf)
              selected='selected'
          @endif>{{$estado->uf}}</option>
        @endforeach
      </select>
    </div>  
  </div>
</div>
<script>
    function verificarCPF(strCpf) {
      if (!/[0-9]{11}/.test(strCpf)) return false;
      if (strCpf === "00000000000") return false;

      var soma = 0;

      for (var i = 1; i <= 9; i++) {
          soma += parseInt(strCpf.substring(i - 1, i)) * (11 - i);
      }

      var resto = soma % 11;

      if (resto === 10 || resto === 11 || resto < 2) {
          resto = 0;
      } else {
          resto = 11 - resto;
      }

      if (resto !== parseInt(strCpf.substring(9, 10))) {
          return false;
      }

      soma = 0;

      for (var i = 1; i <= 10; i++) {
          soma += parseInt(strCpf.substring(i - 1, i)) * (12 - i);
      }
      resto = soma % 11;

      if (resto === 10 || resto === 11 || resto < 2) {
          resto = 0;
      } else {
          resto = 11 - resto;
      }
  
      if (resto !== parseInt(strCpf.substring(10, 11))) {
          return false;
      }

      return true;
  }
    function mascara(t, mask){
        var i = t.value.length;
        var saida = mask.substring(1,0);
        var texto = mask.substring(i)
        if (texto.substring(0,1) != saida){
            t.value += texto.substring(0,1);
        }
    }

    function limparCPF(cpf){
      let retorno = cpf.replace('-','').replace('.','').replace('.','');
      return retorno;
    }

    function validaCPF(cpf){
      if(verificarCPF(limparCPF(cpf)) === false){
        document.getElementById('erroCPF').innerHTML = 'cpf inválido!';
        document.getElementById('cpf').value = '';
        
      }else{
        document.getElementById('erroCPF').innerHTML = '';
      }
    }

    var inputCPF = document.getElementById('cpf');
    inputCPF.addEventListener('keypress',function(){
      mascara(inputCPF, '###.###.###-##')
      
      let cpf_limpo = limparCPF(inputCPF.value);
      if(cpf_limpo.length == 11){
        validaCPF(inputCPF.value);
      }
    });

    inputCPF.addEventListener('change',function(){
      validaCPF(inputCPF.value);
    });
</script>


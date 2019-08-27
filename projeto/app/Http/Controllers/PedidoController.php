<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Estado;
use App\Configuracao;
use App\Documentos;
use App\ApiBancoRendimento;
use Illuminate\Http\Request;
use App\Http\Requests\PedidoRequest;
use Illuminate\Support\Facades\Storage;


class PedidoController extends Controller
{
    //Lista de todos os pedidos
    public function pedidos(){
        try {
            $pedidos = Pedido::all();
            return view('pedido.index', ['pedidos'=> $pedidos]);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    private function somaDebitos($debitos){
        $arrayTotal = [];
        if(is_array($debitos))
            foreach($debitos as $item=>$debito)
                $arrayTotal[$item]= $this->somaArray($debito);
            
        return $arrayTotal;
    }

    private function somaArray($array){
        $xTotal = 0;
        if(is_array($array)){
            foreach($array as $item)
                if(is_numeric($item))
                    $xTotal += $item;
                
            return $xTotal;
        }else{
            return (float) $array;
        }
    }

    public function documentosPedido($documentos){
        $nomes = [];
        foreach($documentos as $documento){
            $nome = $documento->pedido_id.$documento->tipo.'.'.$documento->arquivo_tipo;
            //if(!Storage::disk('public')->exists($nome)){
                $this->criarImagem($documento->arquivo,$nome);
            //}

            $nomes[]= ['tipo'=> $documento->tipo, 'nome'=>$nome];
        }
        return $nomes;
    }

    //Mostra informações de um pedido
    public function pedido($id){
        try {
            $estados = Estado::all();
            $configuracao = Configuracao::find(1);
            $pedido = Pedido::find($id);

            $api = new ApiBancoRendimento();
            $debitos = $api->ConsultaDebitos($pedido->placa);
            $somaDebitos = $this->somaDebitos($debitos);
            $somaDebitos['TAXA_SERVICO'] = (float)$configuracao->taxa_servico;
            $total  = $this->somaArray($somaDebitos);
            //Gera imagens dos documentos
            $docs = $this->documentosPedido($pedido->documentos);
            
            $arrayView = [
                'estados'=>$estados,
                'pedido'=>$pedido,
                'debitos'=>$debitos,
                'soma_debitos'=>$somaDebitos,
                'total'=>$total,
                'documentos'=>$docs
            ];
            //dd($arrayView);
            return view('pedido.info', $arrayView);
        } catch (\Exception $th) {
            dd($th);
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        } 
    }

    public function salvarDebitos(Request $request, $id){
        try {
            $pedido = Pedido::find($id);
            dd($pedido);
        } catch (\Exception $th) {
            dd($th);
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    public function atualizarDebitos($id){
        dd(['atualizar debitos', $id]);
    }

    //Tela de cadastro de novo pedido
    public function novo(){
        try {
            $estados = Estado::all();
            return view('pedido.novo', ['estados'=> $estados]);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    //Tela de editar um pedido expecifico
    public function editar($id){
        try {
            $pedido = Pedido::find($id);
            dd($pedido);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    //Salvar dados de um pedido
    public function salvar(Request $request, $id){
        try {
            $pedido = Pedido::find($id);
            dd($pedido);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    //Incluir novo pedido
    public function incluir(PedidoRequest $request){
        try {
            $formData = $request->all();

            $pedido         = new Pedido();
            $pedido->nome   = request('nome');
            $pedido->cpf    = request('cpf');
            $pedido->placa  = request('placa');
            $pedido->uf     = request('uf');
            
            $save = $pedido->save();
            if($save){
                \Session::flash('mensagem', ['msg'=>'Pedido cadastrado com sucesso', 'class'=>'success']);
                return redirect()->route('pedido.info', $pedido->id);
            }else{
                \Session::flash('mensagem', ['msg'=>'Erro ao cadastrar pedido!', 'class'=>'danger']);
                return redirect()->route('pedido.novo');
            }
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');;
        }
    }

    //Excluir pedido
    public function excluir($id){
        try {
            $pedido = Pedido::find($id);
            dd($pedido);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }


    public function salvarEndereco(Request $request, $id){
        try {
            $pedido = Pedido::find($id);

            $pedido->cep         = request('cep');
            $pedido->logradouro  = request('logradouro');
            $pedido->bairro      = request('bairro');
            $pedido->cidade      = request('cidade');
            $pedido->uf          = request('uf');
            $pedido->numero      = request('numero');
            $pedido->complemento = request('complemento');

            $save = $pedido->save();
            if($save){
                \Session::flash('mensagem', ['msg'=>'Endereço cadastrado com sucesso', 'class'=>'success']);
                return redirect()->route('pedido.info', $pedido->id);
            }else{
                \Session::flash('mensagem', ['msg'=>'Erro ao cadastrar endereço!', 'class'=>'danger']);
                return redirect()->route('pedido.novo');
            }
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }
    

    function criarImagem($file64,$nome){
        if(!empty($file64)){
            Storage::disk('public')->put($nome, base64_decode($file64));
        }
        return $nome;
    }
}

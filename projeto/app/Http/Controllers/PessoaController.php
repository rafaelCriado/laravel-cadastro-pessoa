<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\Estado;
use Illuminate\Http\Request;
use App\Http\Requests\PessoaRequest;

class PessoaController extends Controller
{
    //Lista de todos as pessoas
    public function index(Request $request){
        try {
            $search = request('search');
            if($search && $search !== ''){
                $pessoas = Pessoa::where('nome', 'like', "%$search%")->get();
            }else{
                $pessoas = Pessoa::all();
            }

            return view('pessoas.index', ['pessoas'=> $pessoas, 'search' => $search]);
        } catch (\Exception $th) {
            dd($th);
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    //Mostra informações de uma pessoa
    public function view($id){
        try {
            $estados = Estado::all();
            $pessoa = Pessoa::find($id);

            $arrayView = [
                'estados'=>$estados,
                'pessoa'=>$pessoa,
            ];
            //dd($arrayView);
            return view('pessoas.view', $arrayView);
        } catch (\Exception $th) {
            dd($th);
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    //Tela de cadastro de nova pessoa
    public function novo(){
        try {
            $estados = Estado::all();
            return view('pessoas.novo', ['estados'=> $estados]);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    //Incluir nova pessoa
    public function incluir(PessoaRequest $request){
        try {
            $pessoa              = new Pessoa();
            $pessoa->nome        = request('nome');
            $pessoa->cpf         = request('cpf');
            $pessoa->cep         = request('cep');
            $pessoa->logradouro  = request('endereco');
            $pessoa->bairro      = request('bairro');
            $pessoa->cidade      = request('cidade');
            $pessoa->uf          = request('estado');
            $pessoa->numero      = request('numero');
            $pessoa->complemento = request('complemento');

            $save = $pessoa->save();
            //dd($pessoa);
            if($save){
                \Session::flash('mensagem', ['msg'=>'Pessoa cadastrado com sucesso', 'class'=>'success']);
                return redirect()->route('pessoas.info', $pessoa->id);
            }else{
                \Session::flash('mensagem', ['msg'=>'Erro ao cadastrar pessoa!', 'class'=>'danger']);
                return redirect()->route('pessoas.novo');
            }
        } catch (\Exception $th) {
            //dd($th);
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');;
        }
    }

    //Salvar endereço
    public function salvarEndereco(Request $request, $id){
        try {
            $pessoa = Pessoa::find($id);

            $pessoa->cep         = request('cep');
            $pessoa->logradouro  = request('logradouro');
            $pessoa->bairro      = request('bairro');
            $pessoa->cidade      = request('cidade');
            $pessoa->uf          = request('uf');
            $pessoa->numero      = request('numero');
            $pessoa->complemento = request('complemento');

            $save = $pessoa->save();
            if($save){
                \Session::flash('mensagem', ['msg'=>'Endereço cadastrado com sucesso', 'class'=>'success']);
                return redirect()->route('pessoas.info', $pessoa->id);
            }else{
                \Session::flash('mensagem', ['msg'=>'Erro ao cadastrar endereço!', 'class'=>'danger']);
                return redirect()->route('pessoa.novo');
            }
        } catch (\Exception $th) {
            dd($th);
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    //Altera status da pessoa
    public function salvarStatus(Request $request){
        try {
            $pessoa = Pessoa::find(request('id'));
            $pessoa->status = request('status');

            $save = $pessoa->save();
            if($save){
                \Session::flash('mensagem', ['msg'=>'Status de (#'.$pessoa->id.')'.$pessoa->nome.' alterado para '.$pessoa->status.' com sucesso', 'class'=>'success']);
                return redirect()->back();
            }else{
                \Session::flash('mensagem', ['msg'=>'Erro ao alterar status!', 'class'=>'danger']);
                return redirect()->back();
            }
        } catch (\Exception $th) {
            dd($th);
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }
}

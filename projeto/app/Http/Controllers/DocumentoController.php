<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Documentos;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DocumentoController extends Controller
{
    //
    public function incluir(Request $request){
        try {
            //Tratamento de arquivo
            $file = request('arquivo');
            $mime = $file->getMimeType();
            $name = $file->getPathName();
            $file = base64_encode(file_get_contents($request->file('arquivo')));
            //$src  = 'data:'.$mime.';'.$file;
            //========================

            $pedido = Pedido::find(request('pedido_id'));
            $documento = $pedido->documentos->where('tipo',request('tipo'))->first();

            if(!isset($documento) or empty($documento)){
                $documento = new Documentos();
            }

            $documento->pedido_id    = $pedido->id;
            $documento->tipo         = request('tipo');
            $documento->arquivo      = $file;
            $documento->arquivo_tipo = $this->tipo($mime);

            $save = $documento->save();
            if($save){
                \Session::flash('mensagem', ['msg'=>'Documento salvo com sucesso', 'class'=>'success']);
                return redirect()->route('pedido.info', $pedido->id);
            }else{
                \Session::flash('mensagem', ['msg'=>'Erro ao salvar documento!', 'class'=>'danger']);
                return redirect()->route('pedido.novo');
            }
        } catch (\Throwable $th) {
            //dd([$request,$th]);
            return redirect()->back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
        
    }

    private function tipo($tipo){
        switch($tipo){
            case 'application/pdf':
                return 'pdf';
                break;
            
            case 'image/png':
                return 'png';
                break;
            
            case 'image/jpeg':
                return 'jpg';
                break;
            
            case 'image/jpg':
                return 'jpg';
                break;
            
        }

        return false;
    }
}

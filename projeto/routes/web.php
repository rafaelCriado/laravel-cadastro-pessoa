<?php

use GuzzleHttp\Middleware;

Route::get('/login', 'UsuarioController@home')->name('login');
Route::post('/login', 'UsuarioController@login')->name('login');

//Rota de consulta de cep
Route::get('/cep/{cep}', 'RequisicoesController@cep')->name('cep');

//Rotas que necessitam authenticacao
Route::group(['middleware'=>'auth'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', function(){
        return redirect()->route('home');
    });
    Route::get('/logout', 'UsuarioController@logout')->name('logout');

    //Rotas de Usuario
    Route::get('/usuarios', 'UsuarioController@index')->name('usuarios');
    Route::get('/usuario/novo', 'UsuarioController@novo')->name('usuario.novo');
    Route::get('/usuario/perfil/{id}', 'UsuarioController@perfil')->name('usuario.perfil');
    Route::get('/usuario/editar/{id}', 'UsuarioController@editar')->name('usuario.editar');
    Route::get('/usuario/excluir/{id}', 'UsuarioController@excluir')->name('usuario.excluir');
    Route::post('/usuario/salvar', 'UsuarioController@incluir')->name('usuario.incluir');
    Route::put('/usuario/atualizar/{id}', 'UsuarioController@salvar')->name('usuario.salvar');

    Route::get('/usuarios/papel/{id}', 'UsuarioController@papel')->name('usuarios.papel');
    Route::post('/usuarios/papel/salvar/{id}', 'UsuarioController@salvarPapel')->name('usuarios.papel.salvar');
    Route::get('/usuarios/papel/remover/{id}/{papel_id}', 'UsuarioController@removerPapel')->name('usuarios.papel.remover');

    //Rotas de Papeis
    Route::get('/papel', 'PapelController@index')->name('papel');
    Route::get('/papel/novo', 'PapelController@novo')->name('papel.novo');
    Route::get('/papel/editar/{id}', 'PapelController@editar')->name('papel.editar');
    Route::get('/papel/excluir/{id}', 'PapelController@excluir')->name('papel.excluir');
    Route::post('/papel/salvar', 'PapelController@incluir')->name('papel.incluir');
    Route::put('/papel/atualizar/{id}', 'PapelController@salvar')->name('papel.salvar');

    //Permissoes
    Route::get('/papel/permissao/{id}', 'PapelController@permissao')->name('papel.permissao');
    Route::post('/papel/permissao/{id}/salvar', 'PapelController@salvarPermissao')->name('papel.permissao.salvar');
    Route::get('/papel/permissao/{id}/remover/{id_permissao}', 'PapelController@removerPermissao')->name('papel.permissao.remover');

    //Rota de Pessoas
    Route::get('/pessoas',                        'PessoaController@index')->name('pessoas');
    Route::get('/pessoas/novo',                   'PessoaController@novo')->name('pessoas.novo');
    Route::post('/pessoas/incluir',               'PessoaController@incluir')->name('pessoas.incluir');

    Route::get('/pessoas/editar/{id}',            'PessoaController@editar')->name('pessoas.editar');
    Route::delete('/pessoas/excluir/{id}',        'PessoaController@excluir')->name('pessoas.excluir');
    Route::put('/pessoas/atualizar/{id}',         'PessoaController@salvar')->name('pessoas.salvar');
    Route::put('/pessoas/{id}/endereco/salvar',   'PessoaController@salvarEndereco')->name('pessoas.endereco.salvar');
    Route::put('/pessoas/salvar/status',          'PessoaController@salvarStatus')->name('pessoas.salvar.status');

    Route::get('/pessoas/{id}',                   'PessoaController@view')->name('pessoas.info');
});


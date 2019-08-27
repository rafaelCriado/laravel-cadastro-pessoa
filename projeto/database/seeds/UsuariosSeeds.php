<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Papel;

class UsuariosSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::where('email','=', 'teste@teste.com')->count()){
            $usuario = User::where('email','=', 'teste@teste.com')->first();
            $usuario->name = "Teste";
            $usuario->email = "teste@teste.com";
            $usuario->image = "";
            $usuario->password = bcrypt("123456");
            $usuario->save();
            $usuario->papeis()->save(
                Papel::where('nome', '=', 'admin')->firstOrFail()
            );
        }else{
            $usuario = new User();
            $usuario->name = "Teste";
            $usuario->email = "teste@teste.com";
            $usuario->image = "";
            $usuario->password = bcrypt("123456");
            $usuario->save();
            $usuario->papeis()->save(
                Papel::where('nome', '=', 'admin')->firstOrFail()
            );
        }
    }
}

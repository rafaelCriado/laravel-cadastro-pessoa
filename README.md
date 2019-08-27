Programar uma tela igual essa: https://dribbble.com/shots/5352545-Hotel-Guests-Management/attachments/1160937
Em que pode:

adicionar pessoa
mudar status da pessoa
ver mais detalhes da pessoa
Os requisitos são:

Usar bootstrap 4
Usar framework php para o back-end
Usar banco de dados mysql (a estrutura, voce pode definir)
Mandar o link do repositorio git depois de concluido
Você tem total liberdade pra definir o que quer fazer e como quer fazer. Nos avisa se for fazer.

#Projeto Tecnologias Utilizadas#

Framework Laravel (PHP)
Bootstrap 4
AdminLTE
JQuery
Banco de Dados Relacional

Mysql (As tabelas são geradas via Migrations do Laravel), Devido à um bug nas migrations do laravel para o comando de gerar as migrations funcionar necessário criar a tabela abaixo manualmente CREATE TABLE permissaos ( id int(11) NOT NULL AUTO_INCREMENT, nome varchar(150) DEFAULT NULL, descricao varchar(150) DEFAULT NULL, updated_at datetime DEFAULT NULL, created_at datetime DEFAULT NULL, PRIMARY KEY (id) ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
Ao rodar o comando para gerar os seeds "php artisan db:seed" é gerado um usuario de teste (usuario: teste@teste.com.br, senha:123456)
Telas

Login (Usuário e Senha)
Tela de Cadastro de Novo Usuário
Tela de Listagem com busca, Cadastro, Detalhamento e Alteração de dados.
Sistema de perfis e permissões de usuários.

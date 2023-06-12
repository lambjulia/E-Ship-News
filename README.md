
# Projeto Notícias E-Ship

Este projeto foi desenvolvido para um teste na empresa E-Ship.

O sistema tem 2 usuários, admin e usuário normal, os usuários normais podem se cadastrar e publicar notícias, podendo editar e excluir elas. 

O admin tem acesso a tudo no sistema, podendo editar e excluir os usuários, também podendo editar e excluir as notícias publicadas por qualquer usuário. 

Na página inicial mostra todas as notícias cadastradas , cada notícia tem uma página onde mostram todas as informações incluindo imagens e as tags relacionadas a ela. Na tela inicial é possível filtrar por tags e títulos, também é possível escolher a quantidade de notícias que mostra por página e o formato delas, em grid ou em linhas.  
# Como Rodar o Projeto

- Abra o terminal e rode este comando
git clone https://github.com/lambjulia/E-Ship-News

- Abra o projeto e rode os seguintes comandos:

1 - composer install

2 - npm install

3 - npm run dev

4- php artisan key:generate

5 - php artisan migrate --seed -> de "yes" para criar o banco de dados

6 - php artisan serve

7 - E abra o sistema no navegador utilizando: http://127.0.0.1:8000

O sistema ja tem o usuário de admin cadastrado

login: admin@admin.com
senha: admin

Caso as imagens não estejam aparecendo, apague a pasta public/storage e rode php artisan storage:link
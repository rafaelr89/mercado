# Projeto Mercado

Para abrir o projeto PHP utilizando o XAMPP com Apache e MySQL e o banco de dados "mercado", siga os seguintes passos:

## 1 - Faça o download do XAMPP no site oficial: 

https://www.apachefriends.org/pt_br/download.html.

Selecione a versão adequada para o seu sistema operacional e siga as instruções para instalação.

## 2- Após a instalação, abra o XAMPP e inicie os serviços do Apache e do MySQL.

## 3 - Coloque o projeto PHP na pasta "htdocs" do XAMPP.

Esta pasta geralmente está localizada em:

- No Windows: C:\xampp\htdocs
- No macOS: /Applications/XAMPP/xamppfiles/htdocs
- No Linux: /opt/lampp/htdocs

## 4 - Crie o banco de dados "mercado".

Para isso, acesse o phpMyAdmin através do endereço http://localhost/phpmyadmin. Clique em "Novo" no menu à esquerda, insira o nome do banco de dados como "mercado" e clique em "Criar".

## 5 - Importe o arquivo SQL que contém a estrutura e os dados do banco de dados.

O arquivo está localizado na raiz do projeto com o nome "mercado.sql". Para importar, acesse o phpMyAdmin, selecione o banco de dados "mercado" e clique na aba "Importar". Selecione o arquivo SQL e clique em "Executar".

## 6 - Acesse o projeto PHP

No navegador digite a URL http://localhost/nome_do_projeto, onde "nome_do_projeto" é o nome da pasta do projeto PHP dentro da pasta "htdocs". Por exemplo, se o projeto estiver em "C:\xampp\htdocs\mercado", acesse http://localhost/mercado.

Observação: É importante lembrar que para o projeto funcionar corretamente, é necessário configurar as credenciais do banco de dados no arquivo de conexão com o banco.
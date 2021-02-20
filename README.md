# <center>Site Cursinho PES</center>
### <center>Versão 2.0.0</center>
##
<p style="text-align: justify;">Implementação apresentada a Universidade Federal de Santa Catarina como requisito para a aprovação na Disciplica CIT7598 - Desenvolvimento de Sistemas WEB, do curso de Engenharia de Computação, no semestre 2020-2.</p>

<p style="text-align: justify;">Durante o decorrer do ano letivo, a equipe de gestão do Cursinho Projeto Educação Solidária precisa gerenciar uma grande quantidade de informação a respeito dos voluntários e alunos que participam do projeto, como dados de inscrição em Processos Seletivos, notas dos candidatos nas etapas de seleção, acompanhamento da frequência dos alunos matriculados, entre outros. Desta forma, a proposta desse sistema, é criar uma interface que torne capaz o gerenciamento desses dados através de uma interface única, facilitando a manipulação e geração de relatórios por partes dos gestores, e consulta a esses dados por partes dos demais voluntários e alunos.</p>

## Organização das pastas

Este projeto usa como base a arquitetura MVC e o conceito de URL Amigáveis.

    - banco/               → Diagrama ER e dumps do banco de dados.
    - private/             → Pasta privada (inacessível pela internet).
        |- config/         → Arquivos de configuração e senhas.
        |- routes/         → Arquivos que armazenam as rotas do site.
        |- src/            → Implementação das classes, páginas e modelos.
            |- app/        → Clases para funcionamento geral do site.
            |- database/   → Clases que conectam e manipulam o banco de dados.
            |- helpers/    → Definição de funções auxiliares globais.
            |- models/     → Modelos para enviar e-mails automáticos e gerar PDFs.
            |- router/     → Classe que gerencia as rotas do site.
            |- view        → Pasta com os componentes e páginas em html (camada de visualização).
        |- vendor/         → Dependências e pacotes do Composer (A ser adiciona após o término da disciplina).
    - public_html/         → Pasta pública do projeto (acessível pela internet).
        |- assets/         → Pasta com arquivos do site.
            |- css/        → Folhas de estilo.
            |- img/        → Imagens.
            |- js/         → Scripts em Javascript.
        |- documentos/     → Documentos de acesso público (editais, lista de classificação, entre outros).
        - index.php        → Arquivo que recebe as requisições.

## Dependências e bibliotecas utilizadas no projeto

#### Back-end
- [PHP](https://www.php.net/) 7.4.14
#### Front-end
- [Bootstrap](https://getbootstrap.com/) 4.6.0
- [Jquery](https://jquery.com/) 3.5.1
#### Banco de Dados
- [MySQL](https://www.mysql.com/) 8.0.19

O projeto roda em um servidor Apache (Versão 2.4.41) com a pasta pública raiz em /public_html.
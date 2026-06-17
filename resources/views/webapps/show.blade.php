@extends('laravel-usp-theme::master')
@section('content')
    <p class="card-text"><a href="/webapps/{{ $webapp->id }}">{{ $webapp->dominio }}</a></p>

    <b>Justificativa:</b>
    <p class="card-text">{{ $webapp->justificativa }}</p>
    <b>Tipo de solicitação: </b>
    <p>{{ $webapp->tipo == 'outro_app' ? 'Outro App' : 'Drupal' }}</p>
    @if ($webapp->url_github)
        <b>Repositório Github: </b>
        <p><a href="{{ $webapp->url_github }}" target="_blank">{{ $webapp->url_github }} </a><b>Tag:
            </b>{{ $webapp->version ?? 'não informado' }}</p>
    @endif
    <b>Status: </b>
    <p>{{ $webapp->status }}</p>
    <b>Solicitante: </b>
    <p>{{ $webapp->user->name }}</p>

    @switch($dockerStatus)
        @case('not_configured')
            <p>Cadastre a imagem docker antes de configurar banco de dados, bucket e publicar a aplicação. </p>

            <a class="btn btn-primary" href="/webapps/{{ $webapp->id }}/docker/image">Adicionar imagem docker</a>
        @break

        @case('configured')
            <div class="mb-3">
                <a href="/gwmariadb/store/{{ $webapp->id }}" class="btn btn-primary">Cirar bancos de dados</a>
                <a href="/gwmariadb/show/{{ $webapp->id}}" class="btn btn-primary">Ver banco de dados</a>
                <a href="/gwmariadb/testconnection" class="btn btn-secondary">Testar conexão</a>
                <br>
                Implementar: 1) Criar um banco de dados para o dominio, 2) Criar um usuário, 3) Criar uma senha para esse usuário e
                guardar localmente, 4) Conceder as permissões necessárias para o usuário acessar o banco de dados criado 5) Testar a
                conexão do app com o banco de dados criado. 6) opção de deletar o banco de dados
            </div>
            <div class="mb-3">
                <a href="/bucket/store/{{ $webapp->id }}" class="btn btn-primary">Criar Bucket</a>
                <a href="/bucket/show/{{$webapp->id}}" class="btn btn-primary">Ver dados bucket</a>
                <a href="/bucket/delete/{{ $webapp->id }}" class="btn btn-danger">Excluir bucket</a>
                <br>
                Implementar: 1) Criar um bucket para o dominio (ok), 2) Criar um usuário, 3) Criar uma senha para esse usuário e
                guardar localmente, 4) Conceder as permissões necessárias para o usuário acessar o bucket criado 5) Testar a conexão
                do app com o bucket criado. 6) opção de deletar o bucket
            </div>
            <div class="mb-3">
                <a class="btn btn-primary" href="/webapps/{{ $webapp->id }}/docker/image">Alterar imagem docker</a>
                <a class="btn btn-primary" href="/webapps/{{ $webapp->id }}/docker/variables">Configurar variáveis de
                    ambiente</a>
                @if ($webapp->status == 'Solicitado')
                    <a href="/portainer/{{ $webapp->id }}/store" class="btn btn-primary">Publicar aplicação</a>
                @else
                    <a href="/portainer/{{ $webapp->id }}/update" class="btn btn-primary">Atualizar aplicação</a>
                @endif
                <br>
                <br>
                Implementado:
                <br> 1- Model Variaveis
                <br> 2- Model Imagem 
                <br> 3- Relacionamento entre imagem, variaveis e webapp
                <br> 4- Adição e atualização da imagem e das variaveis para o webapp
                <br> 5- Requisições para publicação do app no container e atualização do mesmo
                <br>
            </div>

            @default
        @endswitch
    @endsection

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
            <p>Cadastre a imagem docker e as variáveis de ambiente do app antes de configurar banco de dados, bucket e docker. </p>

            <a class="btn btn-primary" href="/webapps/{{ $webapp->id }}/docker/create">Preparar docker</a>
        @break

        @case('partial_configured')
            <p>Antes de criar o docker, banco de dados e bucket, os dados de configuração do docker devem estar todos
                preenchidos. Verifique se todas as variáveis de ambiente, a tag da imagem e a versão da imagem estão
                configuradas corretamente.</p>

            <a class="btn btn-primary" href="/webapps/{{ $webapp->id }}/docker/edit">Configurações docker</a>
        @break

        @case('configured')
            
            <br><br><a href="/webapps/{{ $webapp->id }}/docker" class="btn btn-primary">Configurar Docker (Augusto)</a>
            <a href="/webapps/{{ $webapp->id }}/docker/edit" class="btn btn-secondary">Editar configurações</a>
            <br>
            Implementar: 1) Model para variavéis de ambiente, 2) Escolher a tag do deploy 3) Configurar o serviço para usar as
            variáveis de ambiente necessárias

            <br><br><a href="/gwmariadb/store/{{ $webapp->id }}" class="btn btn-primary">Bancos de dados (Mônica)</a>
            <a href="/gwmariadb/testconnection" class="btn btn-secondary">Testar conexão</a>
            <br>
            Implementar: 1) Criar um banco de dados para o dominio, 2) Criar um usuário, 3) Criar uma senha para esse usuário e
            guardar localmente, 4) Conceder as permissões necessárias para o usuário acessar o banco de dados criado 5) Testar a
            conexão do app com o banco de dados criado. 6) opção de deletar o banco de dados


            <br><br><a href="/bucket/store/{{ $webapp->id }}" class="btn btn-primary">Configurar Bucket (Ricardo)</a>
            <a href="/bucket/delete/{{ $webapp->id }}" class="btn btn-danger">Excluir bucket</a>
            Implementar: 1) Criar um bucket para o dominio (ok), 2) Criar um usuário, 3) Criar uma senha para esse usuário e
            guardar localmente, 4) Conceder as permissões necessárias para o usuário acessar o bucket criado 5) Testar a conexão
            do app com o bucket criado. 6) opção de deletar o bucket

            @default
        @endswitch
    @endsection

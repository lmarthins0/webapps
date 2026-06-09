@extends('laravel-usp-theme::master')
@section("content")

<p class="card-text"><a href="/webapps/{{ $webapp->id }}">{{ $webapp->dominio }}</a></p>
    
    <b>Justificativa:</b>
    <p class="card-text">{{ $webapp->justificativa }}</p>
    <b>Tipo de solicitação: </b>
    <p>{{ $webapp->tipo == 'outro_app' ? 'Outro App' : 'Drupal' }}</p>
    @if ($webapp->url_github)
        <b>Repositório Github: </b>
        <p><a href="{{ $webapp->url_github }}" target="_blank">{{ $webapp->url_github }} </a><b>Tag:
            </b>{{ $webapp->version ?? 'não informado'}}</p>
    @endif
    <b>Status: </b>
    <p>{{ $webapp->status }}</p>
    <b>Solicitante: </b>
    <p>{{ $webapp->user->name }}</p>

    <br><br><a href="/gwmariadb" class="btn btn-primary">Bancos de dados (Mônica)</a>
    <br>
    Implementar: 1) Criar um banco de dados para o dominio, 2) Criar um usuário, 3) Criar uma senha para esse usuário e guardar localmente, 4) Conceder as permissões necessárias para o usuário acessar o banco de dados criado 5) Testar a conexão do app com o banco de dados criado. 6) opção de deletar o banco de dados


    <br><br><a href="/rustfs/{{ $webapp->dominio }}" class="btn btn-primary">Configurar Bucket (Ricardo)</a>
    Implementar: 1) Criar um bucket para o dominio (ok), 2) Criar um usuário, 3) Criar uma senha para esse usuário e guardar localmente, 4) Conceder as permissões necessárias para o usuário acessar o bucket criado 5) Testar a conexão do app com o bucket criado. 6) opção de deletar o bucket
    


    <br><br><a href="/portainer" class="btn btn-primary">Configurar Docker (Augusto)</a>
    Implementar: 1) Model para variavéis de ambiente, 2) Escolher a tag do deploy 3) Configurar o serviço para usar as variáveis de ambiente necessárias
    
@endsection
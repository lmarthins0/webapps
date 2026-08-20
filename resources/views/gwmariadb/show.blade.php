@extends('laravel-usp-theme::master')
@section('content')
    <div class="card p-4">
        <div>
            <h5>Dados do banco do app: {{ $database->App->name }}</h5>
            <p>Adicione os valores abaixo nas variáveis corretas de banco de dados.</p>
        </div>
        <div class="w-25 mb-2">
            <div class="input-group mb-2">
                <span class="input-group-text">Nome</span>
                <input disabled type="text" class="form-control" value="&#123;&#123;{{ config('app.dbname') }}&#125;&#125;">
            </div>
            <div class="input-group mb-2">
                <span class="input-group-text">Usuário</span>
                <input disabled type="text" class="form-control" value="&#123;&#123;{{ config('app.dbuser') }}&#125;&#125;">
            </div>
            <div class="input-group mb-2">
                <span class="input-group-text">Senha</span>
                <input disabled type="text" class="form-control" value="&#123;&#123;{{ config('app.dbpassword') }}&#125;&#125;">
            </div>
        </div>
        <div class="d-flex justify-content-start w-50">
            <div class="mr-2">
                <button class="btn btn-primary">Ver senha</button>
            </div>
            <form class="" method="post" action="/gwmariadb/{{ $database->id }}/update">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-warning">Alterar senha</button>
            </form>
        </div>
    </div>
@endsection

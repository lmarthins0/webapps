@extends('laravel-usp-theme::master')
@section('content')
    <div class="card">
        <div>
            <p>{{ $docker_image->name }}</p>
        </div>
        <div>
            <form action="/dockerimages/{{ $docker_image->id }}" method="post">
                @method('delete')
                @csrf
                <p class="mb-3">Nome da imagem: {{ $docker_image->name }}</p>
                <p class="mb-3">Imagem docker: {{ $docker_image->path}}</p>
                <p class="mb-3">Versão da imagem: {{ $docker_image->tag }}</p>
                <p class="">Variáveis de ambiente da imagem: {{ $docker_image->env_variables }}</p>

                <a class="btn btn-primary" href="/dockerimages/{{ $docker_image->id}}/edit">editar</a>
                <button type="submit" class="btn btn-danger">deletar</button>
            </form>
        </div>
    </div>
@endsection

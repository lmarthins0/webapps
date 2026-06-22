@extends('laravel-usp-theme::master')
@section('content')
    <div class="card">
        <div>
            <p>Atualize a imagem: {{ $docker_image->name }}</p>
        </div>
        <div>
            <form action="/dockerimages/{{ $docker_image->id }}" method="post">
                @method('patch')
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Imagem docker:</span>
                    <input type="text" class="form-control" value="{{ old('path', $docker_image->path) }}" name="path"
                        placeholder="ghcr.io/caminho/nome_da_imagem">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Versão imagem: </span>
                    <input type="text" class="form-control" value="{{ old('tag', $docker_image->tag) }}" name="tag"
                        placeholder="1.0.0">
                </div>
                <button type="submit" class="btn btn-primary">salvar</button>
            </form>
        </div>
    </div>
@endsection

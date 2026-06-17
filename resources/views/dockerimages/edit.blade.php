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
                <div>
                    <div class="input-group">
                        <span class="input-group-text">Variáveis de ambiente necessárias para a imagem:</span>
                        <textarea class="form-control" name="env_variables" placeholder="Ex: APP_URL,ACCESS_KEY,APP_TOKEN">{{ old('env_variables', $docker_image->env_variables) }}</textarea>
                    </div>
                    <div class="form-text">Separe cara variável apenas por uma vírgula.</div>
                </div>
                <button type="submit" class="btn btn-primary">salvar</button>
            </form>
        </div>
    </div>
@endsection

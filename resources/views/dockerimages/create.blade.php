@extends('laravel-usp-theme::master')
@section('content')
    <div class="card">
        <div>
            <p>Adicionar nova imagem:</p>
        </div>
        <div>
            <form action="/dockerimages" method="post">
                @method('post')
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nome da imagem:</span>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="sites">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Imagem docker:</span>
                    <input type="text" class="form-control" value="{{ old('path') }}" name="path" placeholder="ghcr.io/caminho/nome_da_imagem">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Versão imagem: </span>
                    <input type="text" class="form-control" value="{{ old('tag') }}" name="tag" placeholder="1.0.0">
                </div>
                <button type="submit" class="btn btn-primary">salvar</button>
            </form>
        </div>
    </div>
@endsection

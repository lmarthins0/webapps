@extends('laravel-usp-theme::master')
@section('content')
    <div class="card">
        <div class="col m-2">
            <p><b>Adicionar nova imagem:</b></p>
        </div>
        <div>
            <form action="/dockerimages" method="post" class="card w-50 pt-2 pb-2 m-2">
                @method('post')
                @csrf
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nome da imagem:</span>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="sites">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Imagem docker:</span>
                        <input type="text" class="form-control" value="{{ old('path') }}" name="path" placeholder="ghcr.io/caminho/nome_da_imagem">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <button type="submit" class="btn btn-primary">salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

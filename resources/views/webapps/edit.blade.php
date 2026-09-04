@extends('laravel-usp-theme::master')
@section('content')
    <div class="card">
        <div class="card-header"><b>Editar</b></div>
        <div class="card-body">
            <form method="post" action="/webapps/{{ $webapp->id }}">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col">
                        <label><b>Domínio</b></label>
                        <div class="input-group mb-3 w-25">
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $webapp->name) }}">
                            <span class="input-group-text ">fflch.usp.br</span>
                        </div>

                    </div>
                </div>

                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label><b>Imagem</b></label>
                        <select class="form-select" name="image_id" id="dockerImage">
                            <option @if (!$webapp->docker_image_id) selected @endif>
                                Seleciona a imagem docker para a aplicação
                            </option>
                            @foreach ($docker_images as $image)
                                <option @if ($webapp->docker_image_id == $image->id) selected @endif value="{{ $image->id }}">
                                    {{ $image->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Versão</b></label>
                        <input class="form-control" type="text" name="version"
                            value="{{ old('version', $webapp->version) }}" placeholder="1.0.0" />
                    </div>
                </div>

                <div class="row" style="margin-top:20px;">
                    <div class="col">
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </div>
                </div>

                <style>
                    label {
                        margin-top: 5px;
                        margin-bottom: -15px;
                    }
                </style>

            </form>
        </div>
    </div>
@endsection

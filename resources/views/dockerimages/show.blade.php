@extends('laravel-usp-theme::master')
@section('content')
    <div class="card p-3">
        <div>
            <h2>{{ $docker_image->name }}</h2>
        </div>
        <div class="w-100 d-flex justify-content-around">
            <div class="card p-3 w-50 mr-3">
                <form action="/dockerimages/{{ $docker_image->id }}" method="post">
                    @method('delete')
                    @csrf
                    <p class="mb-3">Nome da imagem: {{ $docker_image->name }}</p>
                    <p class="mb-3">Imagem docker: {{ $docker_image->path }}</p>
                    <p class="mb-3">Versão da imagem: {{ $docker_image->tag }}</p>

                    <a class="btn btn-primary" href="/dockerimages/{{ $docker_image->id }}/edit">editar</a>
                    <button type="submit" class="btn btn-danger">deletar</button>
                </form>
            </div>
            <div class="card p-3 w-50">
                <div>
                    <h4 class="mb-4">Variáveis de ambiente da imagem:</h4>
                    <div class="d-flex">
                        <div class="w-50">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($docker_image->imageVariables)
                                        @foreach ($docker_image->imageVariables as $variable)
                                            <tr>
                                                <td>
                                                    <form class="d-flex justify-content-between"
                                                        action="/dockerimages/{{ $docker_image->id }}/variable/{{ $variable->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <p>{{ $variable->name }}</p>
                                                        <button class="btn btn-danger" type="submit">remover</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <form class="ml-4 w-50" action="/dockerimages/{{ $docker_image->id }}/variable/store"
                            method="post">
                            @csrf
                            @method('post')
                            <p>Adicionar variável de ambiente</p>
                            <div class="input-group mb-3">
                                <input value="{{ old('nome') }}" type="text" name="name" class="form-control"
                                    placeholder="nome" aria-label="nome" aria-describedby="basic-addon1">
                            </div>
                            <div class="d-flex justify-content-end" role="group" aria-label="Basic example">
                                <button class="w-50 btn btn-success" type="submit">adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('laravel-usp-theme::master')
@section('content')
    <div>
        <div>
            <h1>{{ $webapp->dominio }}</h1>
            <p>Configurar docker:</p>
        </div>
        <div>
            <form action="/webapps/{{ $webapp->id }}/dockerimage" method="post">
                @method('put')
                @csrf
                <div class="input-group mb-3">
                    <select name="image" id="dockerImage">
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
                <button type="submit" class="btn btn-primary">salvar imagem</button>
            </form>
        </div>
    </div>
@endsection

@section('javascripts_bottom')
    <script>
        console.log('carreguei')
        $("#dockerImage").on('change', function(e) {})
    </script>
@endsection('javascripts_bottom')

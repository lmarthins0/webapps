@extends('laravel-usp-theme::master')
@section('content')
    <div>
        <div>
            <h1>{{ $webapp->dominio }}</h1>
            <p>Atualizar configuração docker:</p>
        </div>
        <div>
            <form id="editDockerForm" action="/webapps/{{ $webapp->id }}/docker/update" method="post">
                @method('put')
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text">tag docker:</span>
                    <input type="text" class="form-control" value="{{ old('docker_tag', $webapp->docker_tag) }}"
                        name="docker_tag" placeholder="ghcr.io/caminho/nome_da_imagem">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">versão da tag:</span>
                    <input type="text" class="form-control" value="{{ old('tag_version', $webapp->tag_version) }}"
                        name="tag_version" placeholder="1.0.0">
                </div>
                <div class="w-50">
                    @if ($webapp->envVariables)
                        @foreach ($webapp->envVariables as $env_variable)
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">{{ $env_variable->name }}:</span>
                                <input aria-label="env_variable_input" name={{ $env_variable->name }} type="text"
                                    class="form-control w-50" value={{ old('value', $env_variable->value) }}>
                            </div>
                        @endforeach
                    @endif
                </div>
                <input type="hidden" name="env_variables" value="">
                <button type="submit" class="btn btn-primary">salvar</button>

            </form>
        </div>
    </div>
@endsection

@section('javascripts_bottom')
    <script>
        console.log('carreguei')
        $("#editDockerForm").on('submit', function(e) {
            e.preventDefault()
            var envVariablesHiddenInput = $('input[name="env_variables"]')
            var envVariableInputs = $('[aria-label="env_variable_input"]')
            var envVariables = []
            $(envVariableInputs).each(function(index, element) {
                var inputName = $(element).attr('name')
                var inputValue = $(element).val()
                var envVariableObject = {
                    name: inputName,
                    value: inputValue
                }
                envVariables.push(envVariableObject)
            })
            var envVariablesJson = JSON.stringify(envVariables)
            $(envVariablesHiddenInput).val(envVariablesJson)
            //console.log(envVariablesHiddenInput, $(envVariablesHiddenInput).val(), envVariablesJson)
            this.submit()
        })
    </script>
@endsection('javascripts_bottom')

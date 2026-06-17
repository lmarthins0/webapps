@extends('laravel-usp-theme::master')
@section('content')
    <div>
        <div>
            <h1>{{ $webapp->dominio }}</h1>
            <p>Configure as variáveis de ambiente da aplicação:</p>
        </div>
        <div>
            <form id="envVariablesForm" action="/webapps/{{ $webapp->id }}/docker/variables" method="post">
                @method('post')
                @csrf
                <div class="w-50">
                    @if ($env_variables)
                        @foreach ($env_variables as $env_variable)
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">{{ $env_variable['name'] }}:</span>
                                <input aria-label="env_variable_input" name={{ $env_variable['name'] }} type="text"
                                    class="form-control w-50" value="{{ $env_variable['value'] }}">
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
        $("#envVariablesForm").on('submit', function(e) {
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

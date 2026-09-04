@extends('laravel-usp-theme::master')
@section('content')
    <div>
        <div>
            <h1>{{ $webapp->dominio }}</h1>
            <p>Configure as variáveis de ambiente da aplicação:</p>
        </div>
        <div>
            <div class="w-50">
                @if ($env_variables)
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($env_variables as $env_variable)
                                <tr>
                                    <td>
                                        {{ $env_variable->imageVariable->name }}
                                    </td>
                                    <td>
                                        <form class="d-flex justify-content-between" method="post"
                                            action="/webapps/{{ $webapp->id }}/variables/{{ $env_variable->id }}">
                                            @csrf
                                            @method('put')
                                            <div class="input-group mr-4">
                                                <input aria-label="env_variable_input" name="value" type="text"
                                                    class="form-control w-50" value="{{ $env_variable->value }}">
                                            </div>
                                            <button class="btn btn-success" type="submit">salvar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <small>
                    Para adicionar as informações de banco de dados, utilize as variáveis:
                    @switch($webapp->Appdatabase->driver)
                        @case('mariadb')
                            <br />@{{mariadb_name}}
                            <br />@{{mariadb_user}}
                            <br />@{{mariadb_password}}
                        @break

                        @case('postgres')
                            <br />@{{postgres_name}}
                            <br />@{{postgres_user}}
                            <br />@{{postgres_password}}
                        @break

                        @default
                            <br />@{{db_name}}
                            <br />@{{db_user}}
                            <br />@{{db_password}}
                    @endswitch
                </small>
            </div>
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

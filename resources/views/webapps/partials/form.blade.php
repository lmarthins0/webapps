<div class="row">
    <div class="col">
        <label><b>Domínio</b></label>
        <div class="input-group mb-3 w-25">
            <input type="text" class="form-control" name="dominio" value="{{ old('dominio', $webapp->dominio) }}">
            <span class="input-group-text ">fflch.usp.br</span>
        </div>

    </div>
</div>

<div class="row">
    <div class="col">
        <label><b>Justificativa</b></label>
        <textarea class="form-control" name="justificativa">{{ old('justificativa', $webapp->justificativa) }}</textarea>
    </div>
</div>

<div class="row" id="url_github" style="display:none;">
    <div class="col">
        <label><b>Repositório github</b></label>
        <input type="text" class="form-control" name="url_github"
            value="{{ old('url_github', $webapp->url_github) }}"
            placeholder="https://github.com/usuario/nome-repositorio">
    </div>
</div>

<div class="row">
    <div class="col-12">
        <label><b>Tipo</b></label>
    </div>
    <div class="col-1" style="margin-left:15px;">
        <input name="tipo" class="form-check-input" type="radio" value="drupal"
            @if (old('tipo', $webapp->tipo) == 'drupal') checked @endif>Drupal
    </div>
    <div class="col-1">
        <input name="tipo" class="form-check-input" type="radio" value="outro_app" id="button_outro_app"
            @if (old('tipo', $webapp->tipo) == 'outro_app') checked @endif>Outro app
    </div>
</div>

<div class="row" style="margin-top:20px;">
    <div class="col">
        <button class="btn btn-success" type="submit">Enviar</button>
    </div>
</div>


@section('javascripts_bottom')
    <script>
        $(document).ready(function() {

            function toggleGithubField() {
                if ($('#button_outro_app').is(':checked')) {
                    $('#url_github').css('display', 'flex');
                } else {
                    $('#url_github').css('display', 'none');
                }
            }

            //executa quando a página carrega
            toggleGithubField();

            //executa quando o usuário muda o radio
            $('input[name="tipo"]').on('change', function() {
                toggleGithubField();
            });

        });
    </script>
@endsection
<style>
    label {
        margin-top: 5px;
        margin-bottom: -15px;
    }
</style>

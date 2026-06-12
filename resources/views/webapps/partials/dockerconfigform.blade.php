<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">tag docker:</span>
    <input type="text" class="form-control" name="docker_tag" placeholder="ghcr.io/caminho/nome_da_imagem">
</div>
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">versão da tag:</span>
    <input type="text" class="form-control" name="tag_version" placeholder="1.0.0">
</div>
<div>
    <div class="input-group">
        <span class="input-group-text">Variáveis de ambiente:</span>
        <textarea class="form-control" name="env_variables" placeholder="Ex: APP_URL,ACCESS_KEY,APP_TOKEN"></textarea>
    </div>
    <div class="form-text">Separe cara variável apenas por uma vírgula.</div>
</div>
<button type="submit" class="btn btn-primary">salvar</button>

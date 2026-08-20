<?php

namespace App\Services;

use App\Actions\GetGwmariadbPayload;
use App\Actions\SendGwmariadbRequest;

class GwmariadbService
{

    protected string $siteName;

    function __construct(string $siteName = '')
    {
        $this->siteName = $siteName;
    }

    public function listarDatabase()
    {
        $action = 'listar_databases';
        $payload = GetGwmariadbPayload::execute($action);
        $response = SendGwmariadbRequest::execute($payload);

        return $response->json();
    }

    public function listarUsuarios()
    {
        $action = 'listar_usuarios';
        $payload = GetGwmariadbPayload::execute($action);
        $response = SendGwmariadbRequest::execute($payload);

        return $response;
    }

    public function storeDatabase()
    {
        //dd($this->userExists(), $this->databaseExists());
        if(!$this->userExists() && !$this->databaseExists()) {
            $response = $this->criarDatabaseUsuarioPrivilegio();
            return $response;
        }

        if(!$this->userExists() && $this->databaseExists()) {
            $response = $this->criarUsuario();
            $this->concederPrivilegios();
            return $response;
        }

        if($this->userExists() && !$this->databaseExists()) {
            $response = $this->criarDatabase();
            $this->concederPrivilegios();
            return $response;
        }

        if($this->userExists() && $this->databaseExists()) {
            return false;
        }
    }

    public function criarDatabase()
    {
        $action = 'criar_database';
        $payload = GetGwmariadbPayload::execute($action, $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);
        return $response;
    }

    public function trocarSenhaUsuario()
    {
        $action = 'trocar_senha';
        $payload = GetGwmariadbPayload::execute($action, $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);
        return $response;
    }

    public function criarUsuario()
    {
        $action = 'criar_usuario';
        $payload = GetGwmariadbPayload::execute($action, $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);

        return $response;
    }

    public function criarDatabaseUsuario()
    {
        $action = 'criar_database_usuario';
        $payload = GetGwmariadbPayload::execute($action, $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);

        return $response;
    }

    public function criarDatabaseUsuarioPrivilegio()
    {
        $action = 'criar_database_usuario_privilegio';
        $payload = GetGwmariadbPayload::execute($action, $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);

        return $response;
    }

    public function concederPrivilegios()
    {
        $action = 'conceder_privilegios';
        $payload = GetGwmariadbPayload::execute($action, $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);

        return $response;
    }

    protected function databaseExists()
    {
        $action = 'database_existe';
        $payload = GetGwmariadbPayload::execute($action, $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);
        return $response['existe'];
    }

    protected function userExists()
    {
        $action = 'usuario_existe';
        $payload = GetGwmariadbPayload::execute($action, $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);

        return $response['existe'];
    }
}

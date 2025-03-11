<?php

namespace NFSePHP\NotaSaquarema;

use NFSePHP\NotaSaquarema\Operations\CancelarNfse;
use NFSePHP\NotaSaquarema\Operations\ConsultarNfse;
use NFSePHP\NotaSaquarema\Operations\ConsultarNfsePorRps;
use NFSePHP\NotaSaquarema\Operations\GerarNfseNotaSaquarema;

class NotaCariocaOperationFactory {

    public function createOperation(string $action = '', string $env = 'dev', array $rps = []) {
        switch($action)
        {
            case "cancelar":
                $notaSaquaremaAction = new CancelarNfse($env, $rps);
                break;
            case "consultar-nfse":
                $notaSaquaremaAction = new ConsultarNfse($env, $rps);
                break;
            case "consultar-por-rps":
                $notaSaquaremaAction = new ConsultarNfsePorRps($env, $rps);
                break;
            case "gerar-nfse":
                $notaSaquaremaAction = new GerarNfseNotaSaquarema($env, $rps);
                break;
            default:
                $notaSaquaremaAction = new ConsultarNfse($env, $rps);
                break;
        }

        return $notaSaquaremaAction;
    }
}

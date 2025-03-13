<?php

namespace NotaSaquarema;

use NotaSaquarema\Operations\CancelarNfse;
use NotaSaquarema\Operations\ConsultarNfse;
use NotaSaquarema\Operations\ConsultarNfsePorRps;
use NotaSaquarema\Operations\GerarNfseNotaSaquarema;

class NotaSaquaremaFactory {

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

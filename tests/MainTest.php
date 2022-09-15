<?php
declare(strict_types=1);

namespace Rmagnoprado\Debug;

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Rmagnoprado\Debug\Main;

/** @MainTest */
class MainTest extends TestCase {

    public function test_show() : void{

        $json = '{"data":{"outages":[{"outageTime":"2022-05-17T17:08:00","endOutage":"2022-05-17T17:10:00","duration":"PT2M","explanation":"Agendamento de manutenção dos serviços.","isPartial":false,"unavailableEndpoints":["/open-banking/admin/v1/metrics"]},{"outageTime":"2022-09-13T23:00:00","endOutage":"2022-09-13T23:30:00","duration":"PT30M","explanation":"Agendamento temporário","isPartial":false,"unavailableEndpoints":["/open-banking/admin/v1/metrics"]},{"outageTime":"2022-09-14T22:00:00","endOutage":"2022-09-15T01:00:00","duration":"PT3H","explanation":"Agendamento temporário","isPartial":false,"unavailableEndpoints":["/open-banking/admin/v1/metrics"]},{"outageTime":"2022-04-11T06:00:00","endOutage":"2022-04-11T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-05-30T06:00:00","endOutage":"2022-05-30T08:00:00","duration":"PT2H","explanation":"Atualização do banco de dados de Corbans.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-06-06T06:00:00","endOutage":"2022-06-06T07:30:00","duration":"PT1H30M","explanation":"Atualização da base de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-06-13T06:00:00","endOutage":"2022-06-13T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados de corbans.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-06-20T06:00:00","endOutage":"2022-06-20T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-06-27T06:00:00","endOutage":"2022-06-27T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-07-11T06:00:00","endOutage":"2022-07-11T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-07-18T06:00:00","endOutage":"2022-07-18T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-07-25T06:00:00","endOutage":"2022-07-25T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-08-15T06:00:00","endOutage":"2022-08-15T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-08-22T06:00:00","endOutage":"2022-08-22T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-08-29T06:00:00","endOutage":"2022-08-29T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-09-05T06:00:00","endOutage":"2022-09-05T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-09-12T06:00:00","endOutage":"2022-09-12T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-09-19T06:00:00","endOutage":"2022-09-19T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]},{"outageTime":"2022-09-26T06:00:00","endOutage":"2022-09-26T07:30:00","duration":"PT1H30M","explanation":"Atualização do banco de dados.","isPartial":false,"unavailableEndpoints":["/open-banking/channels/v1/banking-agents"]}]},"links":{"self":"https://api.itau/discovery/v1/outages?page=1&page-size=25"},"meta":{"totalPages":1,"totalRecords":19}}';

        $debug = new Main();

        $this->assertIsString(
            $debug->getScript($json)
        );
    }

    public function test_getHeader() : void{

        $debug = new Main();

        $this->assertIsString(
            $debug->getHeader()
        );
    }

    public function test_getBody() : void{

        $debug = new Main();

        $this->assertIsString(
            $debug->getBody()
        );
    }
}
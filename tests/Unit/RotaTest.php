<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Rota as Rota;
use App\Http\Controllers\RotaController as RotaController;

class RotaTest extends TestCase
{

    public function testGetRotaTimesIndex()
    {
        $rotaController = new RotaController();

        $result         = $rotaController->index();
        $expectedResult = file_get_contents('../Resources/expectedResult.json', true);

        $this->assertEquals(json_decode($expectedResult), $result);
    }

    public function testGetRotaTimes()
    {
        $rotaModel      = new Rota();

        $result         = $rotaModel->getRotaTimes();
        $expectedResult = file_get_contents('../Resources/expectedModelResult.json', true);

        $this->assertEquals(json_decode($expectedResult), $result);
    }
}

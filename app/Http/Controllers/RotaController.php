<?php

namespace App\Http\Controllers;

use App\Rota as Rota;

class RotaController extends Controller
{
    private $totalHours;
    private $totalAloneHours;
    private $rotaModel;
    private $aloneHoursArray;

    function __construct() {

        $this->totalHours       = array();
        $this->totalAloneHours  = array();
        $this->aloneHoursArray  = array();
        $this->rotaModel        = new Rota;

    }

    /**
     * Handles the data called from the model to the view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $results    = $this->rotaModel->getRotaTimes();

        if (!empty($results['totalHoursArray'])) {
            foreach ($results['totalHoursArray'] as $day => $totalTime) {
                $this->totalHours[$day] = array_sum($totalTime);
            }
        }

        if (!empty($results['aloneWork'])) {
            foreach ($results['aloneWork'] as $day => $aloneTimeObject) {

                foreach ($aloneTimeObject as $aloneTime) {
                    $this->aloneHoursArray[$day][] = $aloneTime->format(("%H.%I"));
                }

                $this->totalAloneHours[$day] = array_sum($this->aloneHoursArray[$day]);
            }
        }

        return view('rota', array(
            'days'              => $results['days'],
            'employees'         => $results['employees'],
            'totalHours'        => $this->totalHours,
            'totalAloneHours'   => $this->totalAloneHours
        ));
    }
}

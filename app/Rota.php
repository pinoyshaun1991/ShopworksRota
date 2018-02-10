<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rota extends Model
{
    /**
     * Fetches all data ordered by day where staff id is not null
     *
     * @return array
     */
    public function getRotaTimes()
    {
        $startTimeAlone = null;
        $endTimeAlone   = null;
        $data           = array();

        $results = DB::table('rota_slot_staff')
            ->select('*')
            ->whereNotNull('staffid')
            ->orderBy('daynumber')
            ->get();

        foreach ($results as $result) {
            $startTime  = new \DateTime($result->starttime);
            $endTime    = new \DateTime($result->endtime);
            $data['days'][$result->daynumber] = $result->daynumber;
            $data['employees'][$result->staffid][$result->daynumber] = array(
                'startTime' => !empty($result->starttime) ? $startTime->format('H:i') : '',
                'endTime' => !empty($result->endtime) ? $endTime->format('H:i') : '',
            );

            if(!empty($result->starttime) && !empty($result->endtime)) {
                $data['totalHoursArray'][$result->daynumber][] = $result->workhours;
            }

            if ($startTimeAlone !== null && $endTimeAlone !== null
                && !empty($result->starttime) && !empty($result->endtime)) {

                if ($startTimeAlone <> $startTime && $endTimeAlone > $startTime) {
                    $data['aloneWork'][$result->daynumber][] = $startTimeAlone->diff($startTime);
                }
            }

            $startTimeAlone = $startTime;
            $endTimeAlone   = $endTime;
        }

        return $data;
    }
}

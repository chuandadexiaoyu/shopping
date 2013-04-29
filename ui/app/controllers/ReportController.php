<?php

class ReportController extends BaseController
{
    public function index()
    {
        $date = $this->getApi('dates/next');

        if($date) {
            $date = DateFormatter::long($date);
        }

        return View::make('user/report')
            ->with('date', $date);
    }
}


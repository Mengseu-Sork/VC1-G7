<?php
class DashboardController extends BaseController
{

    function index()
    {
        $this->view('dashboard/list');
    }
}

<?php

require_once 'BaseController.php';
require_once 'Models/ReportModel.php';

class ReportController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new ReportModel();
    }
    function index(){
        $reports = $this->model->getAllReports();
        $this->view('reports/report', ['reports' => $reports]);
    }
   
}
<?php
  class Job {
    public $year;
    private $job_title;
    private $company;

    function __construct($year, $job_title, $company){
      $this->year = $year;
      $this->job_title = $job_title;
      $this->company = $company;
    }

    function setCompany ($new_company){
      $this->company = (string) $new_company;
    }

    function getCompany (){
      return $this->company;
    }

    function setJobTitle ($new_job_title){
      $this->job_title = (string) $new_job_title;
    }

    function getJobTitle (){
      return $this->job_title;
    }

    function save (){
      array_push($_SESSION['job'], $this);
    }

    static function getAll (){
      return $_SESSION['job'];
    }

    static function reset(){
      $_SESSION['job'] = array();
    }
  }

?>

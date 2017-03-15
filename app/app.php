<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Job.php";

  session_start();
  if(empty($_SESSION['job'])){
    $_SESSION['job'] = array();
  };

  $app = new Silex\Application();

  $app->register(new Silex\Provider\TwigServiceProvider(), array ('twig.path' => __DIR__."/../views"));

  $app->get("/", function() use ($app) {

    return $app['twig']->render('jobsearch.html.twig');
  });

  $app->post("/search", function () use ($app) {
    $job_one = new Job ("2012", "Cashier", "Asian Market");
    $job_two = new Job ("2013", "Cook", "Cafeteria");
    $job_three = new Job ("2014", "Manager", "Four Seasons");
    $job_four = new Job ("2015", "Sandwich Artist", "Sandwich Yum");
    $job_search = new Job ($_POST['year'], $_POST['jobTitle'], $_POST['company']);
    $job_search->save();

    $jobs = array ($job_one, $job_two, $job_three, $job_four);
    $match_array = array ();

    foreach ($jobs as $job ){
      if($_POST['year']==$job->year){
        array_push($match_array, $job);
      } else if ($_POST['jobTitle']===$job->getJobTitle()){
        array_push($match_array, $job);
      } elseif ($_POST['company']===$job->getCompany()) {
        array_push($match_array, $job);
      }
    }

    return $app['twig']->render('jobsearch.html.twig', array('alljobs'=>Job::getAll(), 'matchjobs'=>$match_array));
  });

  $app->post("/delete", function() use ($app){
    Job::reset();
    return $app['twig']->render('jobsearch.html.twig');
  });

  return $app;
?>

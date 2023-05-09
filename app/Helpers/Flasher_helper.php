<?php


function showFlasher()
{
  if(session()->getFlashdata('CRUD')){
    return "
    <div id='flash-crud' data-title='". session()->get('CRUD')['title'] . "' data-text='" . session()->get('CRUD')['text'] . "' data-icon='" . session()->get('CRUD')['icon'] . "' data-flash=true>
    </div>
    ";
  }
}

function setFlasher($title, $icon, $text)
{
  session()->setFlashdata('CRUD', [
       'title' => $title,
       'icon' => $icon,
       'text' => $text
      ]); 
}


function getMonthFromDate($tgl)
{
  // get montoh from 2023-05-08 12:43:01
  $tgl = explode('-', $tgl);
  $tgl = $tgl[1];
  // short month
  $month = [
    '01' => 'Jan',
    '02' => 'Feb',
    '03' => 'Mar',
    '04' => 'Apr',
    '05' => 'Mei',
    '06' => 'Jun',
    '07' => 'Jul',
    '08' => 'Agu',
    '09' => 'Sep',
    '10' => 'Okt',
    '11' => 'Nov',
    '12' => 'Des'
  ];
  return $month[$tgl];
}

function getDayFromDate($tgl)
{
  // get montoh from 2023-05-08 12:43:01
  $tgl = explode('-', $tgl);
  // explode day and time
  $tgl = explode(' ', $tgl[2]);
  $tgl = $tgl[0];
  return $tgl;
}

function getYearFromDate($tgl)
{
  // get montoh from 2023-05-08 12:43:01
  $tgl = explode('-', $tgl);
  $tgl = $tgl[0];
  return $tgl;
}

function getFullTimeFromDate($tgl)
{
  $tgl = explode(' ', $tgl);
  $tgl = $tgl[1];
  return $tgl;
}
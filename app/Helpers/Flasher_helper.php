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


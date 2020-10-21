<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function helper_createPwd(){
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $string = '';
  for($i = 0; $i < 6; $i++) {
      $pos = rand(0, strlen($data)-1);
      $string .= $data{$pos};
  }
  return $string;
}

function helper_kodeUser(){
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $string = '';
  for($i = 0; $i < 8; $i++) {
      $pos = rand(0, strlen($data)-1);
      $string .= $data{$pos};
  }
  return 'U_'.$string;
}
  function helper_kodeGuru(){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 0; $i < 8; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return 'G_'.$string;
  }

  function helper_kodeSiswa(){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 0; $i < 8; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return 'S_'.$string;
  }

  

  function helper_kodemapel(){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 0; $i < 7; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return 'Ma_'.$string;
  }

  function helper_kodekelas(){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 0; $i < 7; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return 'Kl_'.$string;
  }

  function helper_kodeTugas(){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 0; $i < 7; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return 'Tg_'.$string;
  }

  function helper_kodeujian(){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 0; $i < 7; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return 'Qz_'.$string;
  }

  function helper_kodesoal(){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 0; $i < 7; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return 'Sl'.$string;
  }


  function helper_kodenilai(){
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 0; $i < 7; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return 'Ni_'.$string;
  }

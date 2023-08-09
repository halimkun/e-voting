<?php


function getDataAdmin($field, $id = null)
{
  $db = \Config\Database::connect();
  $id_admin = $id !== null ? $id : session()->get('login')['id'];
  $data = $db->table('admin')->where('id_admin', $id_admin)->get()->getRowArray();
  return $data[$field];
}

function getDataPeserta($field)
{
  $db = \Config\Database::connect();
  $id_peserta = session()->get('login');
  if($id_peserta == null){
    return "Data tidak ditemukan!!";
  }
  $id_peserta = $id_peserta['id'];
  $data = $db->table('peserta')->where('id_peserta', $id_peserta)->get()->getRowArray();
  return $data[$field];
}
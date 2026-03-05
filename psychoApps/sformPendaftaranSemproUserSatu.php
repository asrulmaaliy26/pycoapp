<?php
   include( "contentsConAdm.php" );
   $id_sempro=mysqli_real_escape_string($con, $_POST['id_sempro']);
   $nim=mysqli_real_escape_string($con, $_POST['nim']);
   $angkatan=mysqli_real_escape_string($con, $_POST['angkatan']);
   $judul_prop=mysqli_real_escape_string($con, $_POST['judul_prop']);
   $pembimbing1=mysqli_real_escape_string($con, $_POST['pembimbing1']);
   $pembimbing2=mysqli_real_escape_string($con, $_POST['pembimbing2']);
   $tgl_pengajuan=mysqli_real_escape_string($con, $_POST['tgl_pengajuan']);
   $split = explode('-', $tgl_pengajuan);
   $thn_pengajuan= mysqli_real_escape_string($con, $split['2']);
   $val_adm=mysqli_real_escape_string($con, $_POST['val_adm']);
   $statusform=mysqli_real_escape_string($con, $_POST['statusform']);
   
   mysqli_query($con, "INSERT INTO peserta_sempro(id_sempro,nim,angkatan,judul_prop,pembimbing1,pembimbing2,tgl_pengajuan,thn_pengajuan,val_adm,statusform)".
   "VALUES('$id_sempro','$nim','$angkatan','$judul_prop','$pembimbing1','$pembimbing2','$tgl_pengajuan','$thn_pengajuan','$val_adm','$statusform')")  or die(mysqli_error($con));

   $qid = "SELECT id FROM peserta_sempro WHERE nim='$nim' AND id_sempro='$id_sempro' ORDER BY id DESC LIMIT 1";
   $res = mysqli_query($con,  $qid)or die( mysqli_error($con));
   $dId = mysqli_fetch_assoc( $res );
   $id=$dId['id'];
   $genId = str_pad($id, 4, '0', STR_PAD_LEFT);
   $id_reg='SEMPRO'.'.'.$thn_pengajuan.'.'.$genId;

   $qreg="UPDATE peserta_sempro SET id_reg='$id_reg' WHERE id='$id' LIMIT 1";
   $rreg = mysqli_query($con, $qreg) or die(mysqli_error($con));
   
   mysqli_query($con, "INSERT INTO jadwal_sempro(id_sempro,id_pendaftaran,penguji1)".
   "values('$id_sempro','$id','$pembimbing1')")  or die(mysqli_error($con));
 
   $qidjdwl = "SELECT id FROM jadwal_sempro ORDER BY id DESC LIMIT 1";
   $res = mysqli_query($con,  $qidjdwl )or die( mysqli_error($con) );
   $dIdjdwl = mysqli_fetch_assoc( $res );
   $idJdwl=$dIdjdwl['id'];
  
   $q="UPDATE peserta_sempro SET id_jdwl='$idJdwl' WHERE id='$id' LIMIT 1";
   $r = mysqli_query($con, $q) or die(mysqli_error($con));

   mysqli_query($con, "INSERT INTO nilai_sempro(id_sempro,nim,angkatan,id_pendaftaran,validasi)".
   "values('$id_sempro','$nim','$angkatan','$id','1')")  or die(mysqli_error($con));
   header("location:prePendaftaranSemproUser.php?nim=$nim&id=$id&message=notifInput");
   ?>
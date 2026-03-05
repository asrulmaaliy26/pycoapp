<?php
   include( "contentsConAdm.php" );
   $id_kompre=mysqli_real_escape_string($con, $_POST['id_kompre']);
   $nim=mysqli_real_escape_string($con, $_POST['nim']);
   $angkatan=mysqli_real_escape_string($con, $_POST['angkatan']);
   $sks_ditempuh=mysqli_real_escape_string($con, $_POST['sks_ditempuh']);
   $tgl_pengajuan=mysqli_real_escape_string($con, $_POST['tgl_pengajuan']);
   $split = explode('-', $tgl_pengajuan);
   $tgl= mysqli_real_escape_string($con, $split['0']);
   $bln= mysqli_real_escape_string($con, $split['1']);
   $thn= mysqli_real_escape_string($con, $split['2']);
   $val_adm=mysqli_real_escape_string($con, $_POST['val_adm']);
   $statusform=mysqli_real_escape_string($con, $_POST['statusform']);
   
   mysqli_query($con, "INSERT INTO peserta_kompre(id_kompre,nim,angkatan,sks_ditempuh,tgl_pengajuan,tgl,bln,thn,val_adm,statusform)".
   "VALUES('$id_kompre','$nim','$angkatan','$sks_ditempuh','$tgl_pengajuan','$tgl','$bln','$thn','$val_adm','$statusform')")  or die(mysqli_error($con));

   $qid = "SELECT id FROM peserta_kompre WHERE nim='$nim' AND id_kompre='$id_kompre' ORDER BY id DESC LIMIT 1";
   $res = mysqli_query($con,  $qid)or die( mysqli_error($con));
   $dId = mysqli_fetch_assoc( $res );
   $id=$dId['id'];
   $genId = str_pad($id, 4, '0', STR_PAD_LEFT);
   $id_reg='KOMPRE'.'.'.$thn.'.'.$genId;

   $qreg="UPDATE peserta_kompre SET id_reg='$id_reg' WHERE id='$id' LIMIT 1";
   $rreg = mysqli_query($con, $qreg) or die(mysqli_error($con));   
   header("location:prePendaftaranUjianKompreUser.php?nim=$nim&id=$id&message=notifInput");
   ?>
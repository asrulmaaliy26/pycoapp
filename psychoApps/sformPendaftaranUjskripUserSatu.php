<?php
   include( "contentsConAdm.php" );
   $id_ujskrip=mysqli_real_escape_string($con, $_POST['id_ujskrip']);
   $nim=mysqli_real_escape_string($con, $_POST['nim']);
   $angkatan=mysqli_real_escape_string($con, $_POST['angkatan']);
   $judul_skripsi=mysqli_real_escape_string($con, $_POST['judul_skripsi']);
   $pembimbing1=mysqli_real_escape_string($con, $_POST['pembimbing1']);
   $pembimbing2=mysqli_real_escape_string($con, $_POST['pembimbing2']);
   $tgl_pengajuan=mysqli_real_escape_string($con, $_POST['tgl_pengajuan']);
   $split = explode('-', $tgl_pengajuan);
   $thn_pengajuan= mysqli_real_escape_string($con, $split['2']);
   $val_adm=mysqli_real_escape_string($con, $_POST['val_adm']);
   $statusform=mysqli_real_escape_string($con, $_POST['statusform']);
   
   mysqli_query($con, "INSERT INTO peserta_ujskrip(id_ujskrip,nim,angkatan,judul_skripsi,pembimbing1,pembimbing2,tgl_pengajuan,thn_pengajuan,val_adm,statusform)".
   "VALUES('$id_ujskrip','$nim','$angkatan','$judul_skripsi','$pembimbing1','$pembimbing2','$tgl_pengajuan','$thn_pengajuan','$val_adm','$statusform')")  or die(mysqli_error($con));

   $qid = "SELECT id FROM peserta_ujskrip WHERE nim='$nim' AND id_ujskrip='$id_ujskrip' ORDER BY id DESC LIMIT 1";
   $res = mysqli_query($con,  $qid)or die( mysqli_error($con));
   $dId = mysqli_fetch_assoc( $res );
   $id=$dId['id'];
   $genId = str_pad($id, 4, '0', STR_PAD_LEFT);
   $id_reg='UJSKRIP'.'.'.$thn_pengajuan.'.'.$genId;

   $qreg="UPDATE peserta_ujskrip SET id_reg='$id_reg' WHERE id='$id' LIMIT 1";
   $rreg = mysqli_query($con, $qreg) or die(mysqli_error($con));
   
   mysqli_query($con, "INSERT INTO jadwal_ujskrip(id_ujskrip,id_pendaftaran,sekretaris_penguji)".
   "values('$id_ujskrip','$id','$pembimbing1')")  or die(mysqli_error($con));
 
   $qidjdwl = "SELECT id FROM jadwal_ujskrip ORDER BY id DESC LIMIT 1";
   $res = mysqli_query($con,  $qidjdwl )or die( mysqli_error($con) );
   $dIdjdwl = mysqli_fetch_assoc( $res );
   $idJdwl=$dIdjdwl['id'];
  
   $q="UPDATE peserta_ujskrip SET id_jdwl='$idJdwl' WHERE id='$id' LIMIT 1";
   $r = mysqli_query($con, $q) or die(mysqli_error($con));

   mysqli_query($con, "INSERT INTO nilai_ujskrip(id_ujskrip,nim,angkatan,id_pendaftaran,validasi)".
   "values('$id_ujskrip','$nim','$angkatan','$id','1')")  or die(mysqli_error($con));
   header("location:prePendaftaranUjianskripsiUser.php?nim=$nim&id=$id&message=notifInput");
   ?>
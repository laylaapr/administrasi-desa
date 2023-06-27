
<div class="card">
	<div class="header"><h2>Profil Warga</h2></div>
	<div class="body">

		<table border="0" width="100%" class="table table-hover">
	<tr>
		
		<td width="15%">Nama Lengkap</td>
		<td width="1%">:</td>
		<td width="40%"><?php echo $p['nama_lengkap'];?></td>
	</tr>
	<tr>
		
		<td>Nomor KTP</td>
		<td>:</td>
		<td><?php echo $p['no_ktp'];?></td>
	</tr>
    
	<tr>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td><?php echo $p['sex'];?></td>
	</tr>
	<tr>
		<td>Usia</td>
		<td>:</td>
		<td><?php echo hitung_umur($p['tgl_lahir']);?> Tahun</td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>:</td>
		<td><?php echo $p['agama'];?></td>
	</tr>
	<tr>
		<td>Pendidikan</td>
		<td>:</td>
		<td><?php echo $p['pendidikan'];?></td>
	</tr>
	<tr>
		<td>Pekerjaan</td>
		<td>:</td>
		<td><?php echo $p['pekerjaan'];?></td>
	</tr>
	<tr>
		<td>Nomor Rumah</td>
		<td>:</td>
		<td><?php echo $p['no_rumah'];?></td>
	</tr>
	<tr>
		<td>Nomor Kontak</td>
		<td>:</td>
		<td><?php echo $p['no_kontak'];?></td>
	</tr>
</table>
<br>


</div>
</div>

<form action="<?php echo site_url('Warga/tambah_keluarga/');?>" method="post" enctype="multipart/form-data">
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Tambah Warga</h4>
                        </div>
                        <div class="modal-body">
                        	<input type="hidden" name="no_parent" value="<?php echo $p['no_ktp'];?>">
                        	<input type="hidden" name="rt" value="<?php echo $p['rt'];?>">
                        	<input type="hidden" name="no_rumah" value="<?php echo $p['no_rumah'];?>">
                            <div class="form-group form-float">
                            	<div class="form-line">
                            		<input type="text" name="no_ktp" class="form-control" required>
                            		<label class="form-label">No KTP / ID Lainnya</label>
                            	</div>
                            </div>
                            <div class="form-group form-float">
                            	<div class="form-line">
                            		<input type="text" name="nama_lengkap" class="form-control" required>
                            		<label class="form-label">Nama Lengkap</label>
                            	</div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="email_warga" class="form-control" required>
                                    <label class="form-label">Email</label>
                                </div>
                            </div>
                            <div class="form-group">
                            	<label class="form-label">Jenis Kelamin</label>
                               <select name="sex" class="form-control" required>
                               	<option value="">--Pilih--</option>
                               	<option value="Pria">Pria</option>
                               	<option value="Wanita">Wanita</option>
                               </select>
                            </div>
                           <div class="form-group form-float">
                            	<label class="form-label">Tanggal Lahir</label>
                            	<div class="input-group">
                            		<span class="input-group-addon">
                            			<i class="material-icons">date_range</i>
                            		</span>
                            		<div class="form-line">
                            			<input type="text" name="tgl_lahir" class="datepicker form-control" placeholder="Format : thn-bln-tgl Ex: 2000-03-30">
                            		</div>
                            	</div>

                            </div>
                            <div class="form-group">
                            	<label class="form-label">Agama</label>
                            	<select name="agama" required class="form-control">
                            		<option value="">--Pilih--</option>
                            		<option value="Islam">Islam</option>
                            		<option value="Hindu">Hindu</option>
                            		<option value="Budha">Budha</option>
                            		<option value="Protestan">Protestan</option>
                            		<option value="Katolik">Katolik</option>
                            		<option value="Konghucu">Konghucu</option>
                            	</select>
                            </div>
                           
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="no_kontak" class="form-control" >
                                    <label class="form-label">Nomor Kontak</label>
                                </div>
                            </div>
                            <div class="form-group">
                            	<label class="form-label">Pendidikan</label>
                            	<select name="pendidikan" class="form-control" required>
                            		<option value="">--Pilih--</option>
                            		<option value="Belum Sekolah">Belum Sekolah</option>
                            		<option value="SD">SD</option>
                            		<option value="SMP">SMP</option>
                            		<option value="SMA">SMA/SMK</option>
                            		<option value="S1">S1</option>
                            		<option value="S2">S2</option>
                            		<option value="S3">S3</option>
                            	</select>
                            </div>
                            <div class="form-group">
                            	<label class="form-label">Pekerjaan</label>
                            	<select name="pekerjaan" class="form-control" required>
                            		<option value="">--Pilih--</option>
                            		<option value="Belum Bekerja">Belum Bekerja</option>
                            		<option value="PNS">PNS</option>
                            		<option value="Militer">Militer</option>
                            		<option value="Polisi">Polisi</option>
                            		<option value="Dokter">Dokter</option>
                            		<option value="Akademisi">Akademisi</option>
                            		<option value="Karyawan Swasta">Karyawan Swasta</option>
                            		<option value="Wirausaha">Wirausaha</option>
                            	 </select>
                            </div>
                            <div class="form-group">
                            	<label class="form-label">Hubungan</label>
                            	<select name="hubungan" class="form-control">
                            		<option value="">--Pilih--</option>
                            		<option value="Suami/Istri">Suami/Istri</option>
                            		<option value="Anak">Anak</option>
                            		<option value="Saudara">Saudara</option>
                            	</select>
                            </div>
                            <div class="form-group">
                            	<label class="form-label">Foto</label>
                            	<input type="file" name="foto" class="form-control">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect">SIMPAN</button>
                           
                        </div>
                    </div>
                </div>
            </div>

            </form>

<form action="<?php echo site_url('Warga/upload_ktp/');?>" method="post" enctype="multipart/form-data">
<div class="modal fade" id="ktp" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Upload / Lihat KTP</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="no_ktp" value="<?php echo $p['no_ktp'];?>">
                            <label class="form-label">Upload KTP</label>
                            <input type="file" name="ktp" class="form-control" required>

                            <hr>
                            <?php if($dok['foto_ktp'] == null){ ?>

                            <?php } else { ?>
                            <img src="<?php echo base_url('assets/upload/'.$p['no_ktp'].'/'.$dok['foto_ktp']);?>" style="width: 100%">
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect">Upload</button>
                           
                        </div>
                    </div>
                </div>
            </div>

            </form>

<form action="<?php echo site_url('Warga/upload_kk/');?>" method="post" enctype="multipart/form-data">
<div class="modal fade" id="kk" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Upload / Lihat KK</h4>
                        </div>
                        <div class="modal-body">
                        <input type="hidden" name="no_ktp" value="<?php echo $p['no_ktp'];?>">
                            <label class="form-label">Upload KK</label>
                            <input type="file" name="kk" class="form-control" required>

                            <hr>
                            <?php if($dok['foto_kk'] == null){ ?>

                            <?php } else { ?>
                            <img src="<?php echo base_url('assets/upload/'.$p['no_ktp'].'/'.$dok['foto_kk']);?>" style="width: 100%">
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect">Upload</button>
                           
                        </div>
                    </div>
                </div>
            </div>

            </form>
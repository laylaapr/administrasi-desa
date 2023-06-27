<form action="<?php echo site_url('Warga/update/');?>" method="post">
<div class="card">
	<input type="hidden" name="no_parent" value="<?php echo $p['no_ktp'];?>">
	<div class="header bg-blue">
		Edit Profil <?php echo $p['nama_lengkap'];?>
	</div>
	<div class="body">
		<table border="0" width="100%" class="table table-hover">
	<tr>
		<td width="15%">Nama Lengkap</td>
		<td width="1%">:</td>
		<td width="40%"><input type="text" name="nama_lengkap" value="<?php echo $p['nama_lengkap'];?>" class="form-control"></td>
	</tr>
	<tr>
		
		<td>Nomor KTP</td>
		<td>:</td>
		<td><input type="number" name="no_ktp" class="form-control" value="<?php echo $p['no_ktp'];?>"></td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td>
			<select name="sex" class="form-control">
				<?php if ($p['sex'] === 'Wanita'){ ?>
				<option selected="selected" value="Wanita">Wanita</option>
				<option value="Pria">Pria</option>
				<?php } ?>
			<?php if ($p['sex'] === 'Pria'){ ?>
				<option selected="selected" value="Pria">Pria</option>
				<option  value="Wanita">Wanita</option>
				
				<?php } else { ?>
					<option value="">--Pilih--</option>
					<option  value="Wanita">Wanita</option>
					<option value="Pria">Pria</option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Tanggal Lahir</td>
		<td>:</td>
		<td><input type="text" name="tgl_lahir" class="datepicker form-control" value="<?php echo date('Y-m-d', strtotime($p['tgl_lahir']));?>" class="form-control"></td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>:</td>
		<td>
			<select name="agama" required class="form-control">
                            		<option value="<?php echo $p['agama'];?>" selected="selected"><?php echo $p['agama'];?></option>
                            		<option value="Islam">Islam</option>
                            		<option value="Hindu">Hindu</option>
                            		<option value="Budha">Budha</option>
                            		<option value="Protestan">Protestan</option>
                            		<option value="Katolik">Katolik</option>
                            		<option value="Konghucu">Konghucu</option>
                            	</select>
		</td>
	</tr>
	<tr>
		<td>Pendidikan</td>
		<td>:</td>
		<td>
			<select name="pendidikan" class="form-control" required>
                            		<option value="<?php echo $p['pendidikan'];?>"><?php echo $p['pendidikan'];?></option>
                            		<option value="SD">SD</option>
                            		<option value="SMP">SMP</option>
                            		<option value="SMA">SMA/SMK</option>
                            		<option value="S1">S1</option>
                            		<option value="S2">S2</option>
                            		<option value="S3">S3</option>
                            	</select>

		</td>
	</tr>
	<tr>
		<td>Pekerjaan</td>
		<td>:</td>
		<td>
			<select name="pekerjaan" class="form-control" required>
                            		<option value="<?php echo $p['pekerjaan'];?>"><?php echo $p['pekerjaan'];?></option>
                            		<option value="PNS">PNS</option>
                            		<option value="Militer">Militer</option>
                            		<option value="Polisi">Polisi</option>
                            		<option value="Dokter">Dokter</option>
                            		<option value="Akademisi">Akademisi</option>
                            		<option value="Karyawan Swasta">Karyawan Swasta</option>
                            		<option value="Wirausaha">Wirausaha</option>
                            	 </select>

		</td>
	</tr>
	<tr>
		<td>Nomor Rumah</td>
		<td>:</td>
		<td><input type="text" name="no_rumah" class="form-control" value="<?php echo $p['no_rumah'];?>"></td>
	</tr>
	<tr>
		<td>Nomor Kontak</td>
		<td>:</td>
		<td><input type="text" name="no_kontak" class="form-control" value="<?php echo $p['no_kontak'];?>"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td><input type="text" name="email_warga" class="form-control" value="<?php echo $p['email_warga'];?>"></td>
	</tr>
</table>
	</div>
	<div class="footer">
		<button type="submit" class="btn bg-orange form-control waves-effect">UPDATE</button>
	</div>
</div>
</form>
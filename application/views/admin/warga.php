
<form action="<?php echo site_url('Admin/tambah_warga');?>" method="post" enctype="multipart/form-data">
<div class="card">
	<div class="header bg-blue">Tambah Warga</div>
	<div class="body">
		<div class="form-group form-float">
                            	<div class="form-line">
                            		<input type="number" name="no_ktp" class="form-control" required>
                            		<label class="form-label">No KTP</label>
                            	</div>
                            </div>
                            <div class="form-group form-float">
                            	<div class="form-line">
                            		<input type="text" name="nama_lengkap" class="form-control" required>
                            		<label class="form-label">Nama Lengkap</label>
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
                            			<input type="text" name="tgl_lahir" class="datepicker form-control"  placeholder="Format : thn-bln-tgl Ex: 2000-03-30">
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
                            <div class="form-group">
                                <label class="form-label">Desa</label>
                                <select class="form-control" name="rt" required>
                                    <option value="">--Pilih--</option>
                                    <?php foreach($r as $a){ ?>
                                    <option value="<?php echo $a->id_rt;?>"><?php echo $a->nama_rt;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group form-float">
                            	<div class="form-line">
                            		<input type="text" name="no_rumah" class="form-control" required>
                            		<label class="form-label">Nomor Rumah</label>
                            	</div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" name="no_kontak" class="form-control" required>
                                    <label class="form-label">Nomor Kontak</label>
                                </div>
                            </div>
                            <div class="form-group">
                            	<label class="form-label">Pendidikan Terakhir</label>
                            	<select name="pendidikan" class="form-control" required>
                            		<option value="">--Pilih--</option>
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
                            		<option value="PNS">PNS</option>
                            		<option value="Militer">Militer</option>
                            		<option value="Polisi">Polisi</option>
                            		<option value="Dokter">Dokter</option>
                            		<option value="Akademisi">Akademisi</option>
                            		<option value="Karyawan Swasta">Karyawan Swasta</option>
                            		<option value="Wirausaha">Wirausaha</option>
									<option value="Wirausaha">Lainnya</option>
                            	 </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Upload Ktp</label>
                                <input type="file" name="foto_ktp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Upload KK</label>
                                <input type="file" name="foto_kk" class="form-control">
                            </div>
                            <br>
                            <br>
                            <button type="submit" class="btn btn-primary form-control">Simpan</button>
	</div>
</div>
</form>
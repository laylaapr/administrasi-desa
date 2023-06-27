
<div class="card">
	<div class="header">
		<h2>DAFTAR WARGA <?php echo $rt['nama_rt'];?> (<?php echo $jml;?> WARGA TERDAFTAR)</h2>
		<a data-toggle="modal" data-target="#tambah" class="btn btn-primary">Tambah Warga</a>
		</div>
	<div class="body">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover dataTable js-exportable">
				<thead>
					<th width="3px">No</th>
					<th>Nama Lengkap</th>
					<th>No. Rumah</th>
					<th>Detail</th>
				</thead>
				<tbody>
					<?php $no=0; foreach($w as $a):$no++ ;?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $a->nama_lengkap;?> <?php if($a->role != 'warga'){echo "<label class='label bg-green'>".strtoupper($a->role)."</label>";}?></td>
						<td><?php echo $a->no_rumah;?></td>
						<td><?php if($this->session->userdata('role')!='Ketua'){} else{ ?><a href="<?php echo site_url('Warga/profil/'.$a->no_ktp);?>" class="btn bg-green waves-effect"><i class="material-icons">visibility</i></a><?php if($a->role =='Ketua' or $a->role == 'Bendahara' or $a->role =='Sekretaris'){ ?>
                            

                         <?php }} ?></td>
                            
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<form action="<?php echo site_url('Panel_rt/tambah_warga/');?>" method="post" enctype="multipart/form-data">
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Tambah Warga</h4>
                        </div>
                        <div class="modal-body">
                        	<input type="hidden" name="rt" value="<?php echo $id;?>">
                            <div class="form-group form-float">
                            	<div class="form-line">
                            		<input type="text" name="no_ktp" class="form-control" required>
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
                            	<div class="form-line">
                            		<input type="password" name="password" class="form-control" required>
                            		<label class="form-label">Password</label>
                            	</div>
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
                            <div class="form-group form-float">
                            	<div class="form-line">
                            		<input type="text" name="no_rumah" class="form-control" required>
                            		<label class="form-label">Nomor Rumah</label>
                            	</div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="no_kontak" class="form-control" required>
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
                            


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect">SIMPAN</button>
                           
                        </div>
                    </div>
                </div>
            </div>
</form>
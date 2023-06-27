<div class="card">
	<div class="body">
		<form action="<?php echo site_url('Panel_rt/terbitkan_surat/');?>" method="post">
			<input type="hidden" name="id_surat" value="<?php echo $id;?>">
			<input type="hidden" name="ktp_warga" value="<?php echo $k['no_ktp'];?>">
			<input type="hidden" name="no_urut" value="<?php echo $no_surat;?>">
		<div class="container"  style="width: 595px;height: 842px; ">
			<center>
				<div class="col-md-2"><img src="<?php echo logo();?>" width="87px" height="100px"></div>
				<div class="col-md-10">
					<h3>PEMERINTAH KABUPATEN SAMPANG </h3>
					<h4>KECAMATAN PANGARENGAN</h4>
				<h5><b>DESA GULBUNG</b></h5>
				Kantor : Jl. Raya Gulbung  - Sampang
				<hr style="line-height: 3px; border-color: black">
				<h4><u>SURAT KETERANGAN</u></h4>
				No. <input type="text" name="no_surat" value="<?php echo '474/'.$no_surat.'/'.bulan_romawi().'.'.date('Y');?>" style="width: 70%">
				</div>
				
			</center><br><br>
				<p style="text-align: justify">Yang bertanda tangan dibawah ini <b>Kepala Desa Gulbung Kecamatan Pangarengan Kabupaten Sampang </b>dengan ini menerangkan bahwa :</p>
				<center>
			<table width="70%">
				<tr>
					<td width="25%">Nama</td>
					<td width="5%">:</td>
					<td><?php echo $k['nama_lengkap'];?></td>
				</tr>
				<tr>
					<td >Tgl. Lahir</td>
					<td >:</td>
					<td><?php echo $k['tgl_lahir'];?></td>
				</tr>
				<tr>
					<td >Jenis Kelamin</td>
					<td >:</td>
					<td><?php echo $k['sex'];?></td>
				</tr>
				<tr>
					<td >Pekerjaan</td>
					<td >:</td>
					<td><?php echo $k['pekerjaan'];?></td>
				</tr>
				<tr>
					<td >Agama</td>
					<td >:</td>
					<td><?php echo $k['agama'];?></td>
				</tr>
				<tr>
					<td >Alamat</td>
					<td >:</td>
					<td>Desa Gulbung</td>
				</tr>
			</table>
			</center><br><br>
			<p style="text-align: justify">
				Orang tersebut diatas, adalah <b>benar-benar warga kami dan berdomisili di Desa Gulbung Kecamatan Pangarengan Kabupaten Sampang. </b>Surat Keterangan ini dibuat sebagai kelengkapan pengurusan <b><?php echo $k['keperluan'];?></b>.
			</p>
			<br>
			<p style="text-align: justify">
				Demikian surat keterangan ini kami buat, untuk dapat dipergunakan sebagaimana mestinya.
			</p>
			<br>
			<br>
			<br>
			<p style="text-align: right">
				<?php echo "Sampang, ".date('Y-m-d');?><br>
				<b>Kepala Desa Gulbung</b>
				<br>
				<br>
				<br>
				<br>
				<u><?php echo $ketua['nama_lengkap'];?></u>
			</p>
		</div>
	</div>
	<button class="btn btn-primary form-control" type="submit">Terbitkan</button>
	</form>
</div>

<ul class="list">
                    <li class="header">MENU WARGA</li>
                    <li><a href="<?php echo site_url('Auth/LogOut/');?>">
                        <i class="material-icons">input</i>
                        <span>Log Out</span>
                    </a></li>
                    <li class="active">
                        <a href="<?php echo site_url('Home');?>">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Home/status_pengajuan/');?>">
                            <i class="material-icons">mail</i>
                            <span>Status Pengajuan Surat</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Warga/profil/'.$this->session->userdata('no_ktp'));?>">
                            <i class="material-icons">person</i>
                            <span>Profil</span>
                        </a>
                    </li>
                   
                   
                    <li>
                        <a href="<?php echo site_url('Home/update_password');?>">
                            <i class="material-icons">lock</i>
                            <span>Update Password</span>
                        </a>
                    </li>
                    <?php if($this->session->userdata('role')=='Ketua') { ?>
                    <li class="header">MENU KEPALA DESA</li>
                    
                    <li>
                        <a href="<?php echo site_url('Panel_rt/rt/'.get_rt_by_ktp($this->session->userdata('no_ktp')));?>">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Panel_rt/warga_rt/'.get_rt_by_ktp($this->session->userdata('no_ktp')));?>">
                            <i class="material-icons">person</i>
                            <span>Daftar Warga</span>
                        </a>
                    </li>
                   
                    <li>
                        <a href="<?php echo site_url('Panel_rt/statistik/'.get_rt_by_ktp($this->session->userdata('no_ktp')));?>">
                            <i class="material-icons">assessment </i>
                            <span>Statistik Warga</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Panel_rt/surat/'.get_rt_by_ktp($this->session->userdata('no_ktp')));?>">
                            <i class="material-icons">mail</i>
                            <span>Surat Warga</span>
                        </a>
                    </li>
                   
                    
                    <?php } else if($this->session->userdata('role')=='Sekretaris'){ ?>

                    <li class="header">MENU PENGURUS DESA</li>
                    
                    <li>
                        <a href="<?php echo site_url('Panel_rt/rt/'.get_rt_by_ktp($this->session->userdata('no_ktp')));?>">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Panel_rt/warga_rt/'.get_rt_by_ktp($this->session->userdata('no_ktp')));?>">
                            <i class="material-icons">person</i>
                            <span>Daftar Warga</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('Panel_rt/statistik/'.get_rt_by_ktp($this->session->userdata('no_ktp')));?>">
                            <i class="material-icons">assessment </i>
                            <span>Statistik Warga</span>
                        </a>
                    </li>
                    
                    <?php } else if($this->session->userdata('role')=='rw'){ ?>

                    
                    <li>
                        <a href="<?php echo site_url('RW/statistik');?>">
                            <i class="material-icons">person</i>
                            <span>Statistik Warga</span>
                        </a>
                    </li>
                    
                    
                    <?php } else if($this->session->userdata('role')=='admin'){ ?>

                    <li class="header">MENU ADMIN</li>
                    
                    <li>
                        <a href="<?php echo site_url('Admin');?>">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    
                    <?php } 

                     else { };?>
                    
                    
                    
                    
                </ul>
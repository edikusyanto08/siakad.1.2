
<!-- Small boxes (Stat box) -->
<div class="row">
<?php 
if (!$this->ion_auth->logged_in()){
    $user ='';
    $user_groups='';
}else{
    $users = $this->ion_auth->user()->row();
    $user_groups = $this->ion_auth->get_users_groups($users->id)->result();
    foreach ($user_groups as $value) {
    
    if($value->name=="admin"){
        $user=$this->ion_auth->user_a()->row_array();
        $nama=$user['nama'];
        $id=$users->username;
        $img="res/foto/guru/".$user['foto'];
    ?>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header ">
              <h3 class="box-title">Profil Pengguna</h3>
              <a style="height:100%;padding:9px 10px;" class="btn btn-sm btn-primary btn-flat pull-right" href="<?= site_url('me') ?>"><span class="fa fa-envelope-o"></span>&nbsp;Ganti Email</a>
              <a style="height:100%;padding:9px 10px;" class="btn btn-sm btn-primary btn-flat pull-right" href="<?= site_url('change_password') ?>"><span class="fa  fa-lock"></span>&nbsp;Ganti Password</a>
            </div><!-- /.box-header -->
          </div>
           <!-- profil singkat -->
            <div class="col-lg-4 col-xs-12">
              <table class="table table-border profil-dashboard">
                <tr>
                  <td width="45%" rowspan="3">
                    <img class="img-circle center-block" style="width:120px;height:130px;border:8px solid #E4E7E8;" src="<?php echo base_url(); ?><?php echo $img; ?>"/>
                  </td>
                  <td width="65%">
                    NIP</br>
                    <?= $id ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Nama</br>
                    <?= $nama ?></td>
                </tr>
                <tr>
                  <td>
                    Grup Pengguna</br>
                    <?php
                        foreach ($user_groups as $value) {
                            echo ucwords(str_replace('_', ' ', $value->name)).' ';
                        }
                    ?>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-lg-8 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="<?php echo site_url('options/ta') ?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#932ab6;font-size:14px;">
                          <i class="fa"><?=$tahun['THN']?></i>Tahun Ajaran
                        </a>
                        <a href="<?php echo site_url('options/ta') ?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#932ab6;font-size:14px;">
                          <i class="fa">
                            <?php if($semester=='1'){
                                echo "1 (Ganjil)";
                            }else{
                                echo "2 (Genap)";
                            }

                            ?>
                        </i>Semester
                        </a>
                        <a href="" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#00A2E9;font-size:14px;">
                          <span class="badge bg-light-blue" style="font-size:14px;">
                            <?=$siswa?>
                          </span>
                          <i class="fa fa-female fa-male" style="display:inline-block"></i>
                          <i class="fa fa-female fa-female" style="display:inline-block"></i>
                          <div class="clearfix"></div>
                          Jumlah Siswa Aktif
                        </a>
                        <a href="" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#00a65a;font-size:14px;">
                          <span class="badge bg-green" style="font-size:14px;">
                            <?=$pengguna?>
                          </span>
                          <i class="fa fa-users"></i>User Aktif
                        </a>
                        <a href="" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#ff851b;font-size:14px;">
                          <span class="badge bg-orange" style="font-size:14px;">
                            <?=$gurukaryawan?>
                          </span>
                          <i class="fa fa-users"></i>Guru &amp; Karyawan Aktif
                        </a>
                    </div>
                  </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Statistik Data Siswa</h3>
                        <label>Siswa Laki-laki : <?=$cowok?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($cowokp,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($cowokp,2)?>%">
                            <i class="fa fa-female fa-male"></i> <?=number_format($cowokp,2)?>%
                          </div>
                        </div>

                        <label>Siswa Perempuan : <?=$cewek?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($cewekp,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($cewekp,2)?>%">
                            <i class="fa fa-female fa-female"></i> <?=number_format($cewekp,2)?>%
                          </div>
                        </div>
                    </div>
                    <a href="<?php echo site_url('siswa') ?>" class="small-box-footer bg-light-blue">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Statistik Data Pengguna</h3>
                        <label>Pengguna Guru/Karyawan : <?=$penggunag?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($penggunagp,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($penggunagp,2)?>%">
                            <?=number_format($penggunagp,2)?>%
                          </div>
                        </div>

                        <label>Pengguna Siswa : <?=$penggunas?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($penggunasp,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($penggunasp,2)?>%">
                            <?=number_format($penggunasp,2)?>%
                          </div>
                        </div>
                    </div>
                    <a href="<?php echo site_url('auth/users') ?>" class="small-box-footer bg-green">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Statistik Data Guru &amp Karyawan</h3>
                        <label>Guru : <?=$guru?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($gurup,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($gurup,2)?>%">
                            <?=number_format($gurup,2)?>%
                          </div>
                        </div>

                        <label>Karyawan : <?=$karyawan?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($karyawanp,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($karyawanp,2)?>%">
                            <?=number_format($karyawanp,2)?>%
                          </div>
                        </div>
                    </div>
                    <a href="<?php echo site_url('guru_karyawan') ?>" class="small-box-footer bg-orange">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-12 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Data Pembagian Kelas</h3>
                        <?php
                        if(!empty($kelas)){
                        foreach ($kelas as $value) {?>
                           <a href="<?=site_url('bagikelas/detail/'.$value['ID'].'')?>" class="btn btn-lg btn-app bg-white" style="color:#00A2E9;font-size:14px;">
                              <span class="badge bg-light-blue" style="font-size:14px;">
                                <?=$value['JML']?>
                              </span>
                              <h3> <?=$value['kelas']?></h3>
                            </a> 
                        <?php }
                        }else{
                            echo "Belum ada pembagian kelas";
                        }
                        ?>
                        
                    </div>
                </div>
            </div><!-- ./col -->
    <?php }elseif(($value->name=="guru") || ($value->name=="Guru_BK") || ($value->name=="kepala_sekolah")) {
        $user=$this->ion_auth->user_a()->row_array();
        $nama=$user['nama'];
        $id=$users->username;
        $img="res/foto/guru/".$user['foto'];
    ?>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header ">
              <h3 class="box-title">Profil Pengguna</h3>
              <a style="height:100%;padding:9px 10px;" class="btn btn-sm btn-primary btn-flat pull-right" href="<?= site_url('me') ?>"><span class="fa fa-envelope-o"></span>&nbsp;Ganti Email</a>
              <a style="height:100%;padding:9px 10px;" class="btn btn-sm btn-primary btn-flat pull-right" href="<?= site_url('change_password') ?>"><span class="fa  fa-lock"></span>&nbsp;Ganti Password</a>
            </div><!-- /.box-header -->
          </div>
           <!-- profil singkat -->
            <div class="col-lg-4 col-xs-12">
              <table class="table table-border profil-dashboard">
                <tr>
                  <td width="45%" rowspan="3">
                    <img class="img-circle center-block" style="width:120px;height:130px;border:8px solid #E4E7E8;" src="<?php echo base_url(); ?><?php echo $img; ?>"/>
                  </td>
                  <td width="65%">
                    NIP</br>
                    <?= $id ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Nama</br>
                    <?= $nama ?></td>
                </tr>
                <tr>
                  <td>
                    Grup Pengguna</br>
                    <?php
                        foreach ($user_groups as $value) {
                            echo ucwords(str_replace('_', ' ', $value->name)).' | ';
                        }
                    ?>
                  </td>
                </tr>
              </table>
            </div>

            <div class="col-lg-8 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="<?php echo site_url('options/ta') ?>" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#932ab6;font-size:14px;">
                          <i class="fa"><?=$tahun['THN']?></i>Tahun Ajaran
                        </a>
                        <a href="<?php echo site_url('options/ta') ?>" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#932ab6;font-size:14px;">
                          <i class="fa">
                            <?php if($semester=='1'){
                                echo "1 (Ganjil)";
                            }else{
                                echo "2 (Genap)";
                            }

                            ?>
                        </i>Semester
                        </a>
                        <a href="" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#00A2E9;font-size:14px;">
                          <span class="badge bg-light-blue" style="font-size:14px;">
                            <?=$siswa?>
                          </span>
                          <i class="fa fa-female fa-male" style="display:inline-block"></i>
                          <i class="fa fa-female fa-female" style="display:inline-block"></i>
                          <div class="clearfix"></div>
                          Jumlah Siswa Aktif
                        </a>
                        <a href="" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#ff851b;font-size:14px;">
                          <span class="badge bg-orange" style="font-size:14px;">
                            <?=$gurukaryawan?>
                          </span>
                          <i class="fa fa-users"></i>Guru &amp; Karyawan Aktif
                        </a>
                        <a href="" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#00A65A ;font-size:14px;">
                          <span class="badge bg-green" style="font-size:14px;">
                            <?php
                            if(!empty($jml_mengajar)){
                                echo $jml_mengajar;
                            }else{
                                echo "0";
                            }
                            ?>
                          </span>
                          <i class="fa fa-comments"></i>Mengajar Mapel
                        </a>
                        <a href="" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#00A65A ;font-size:14px;">
                          <span class="badge bg-green" style="font-size:14px;">
                            <?php
                            if(!empty($jml_mengajare)){
                                echo $jml_mengajare;
                            }else{
                                echo "0";
                            }
                            ?>
                          </span>
                          <i class="fa fa-trophy"></i>Mengajar Eskul
                        </a>
                        <?php if($value->name=="Wali_Kelas") {?>
                        <a href="<?=site_url('raport')?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#00A65A ;font-size:14px;">
                            <i class="fa"><?=$walikelas['kelas']?></i>Wali Kelas
                        </a>
                        <?php } ?>
                        <?php if($value->name=="Guru_BK"){?>
                        <a href="<?=site_url('presensi')?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#00A2E9;font-size:14px;">
                          
                          <i class="fa  fa-check-square-o"></i>
                          <div class="clearfix"></div>
                          Input Presensi
                        </a>
                        <a href="<?=site_url('pelanggaransiswa')?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#F56954;font-size:14px;">
                          
                          <i class="fa  fa-warning"></i>
                          <div class="clearfix"></div>
                          Pelanggaran Siswa
                        </a>
                        <?php } ?>
                        <?php if($value->name=="kepala_sekolah") {?>
                        <a href="<?=site_url('mengajar')?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#00A2E9;font-size:14px;">
                          
                          <i class="fa  fa-comments"></i>
                          <div class="clearfix"></div>
                          Data Mengajar
                        </a>
                        <?php } ?>
                    </div>
                  </div>
            </div>
            <div class="clearfix"></div>
            <?php if($value->name=="Guru_BK"){?>
            <div class="col-lg-12 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>5 Point Pelanggaran Tertinggi</h3>
                        <table class="table table-border">
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>NAMA</th>
                                <th>Jml Pelanggaran</th>
                                <th>Total Point</th>
                                <th></th>
                            </tr>
                            <?php
                            if (!empty($points)) {
                                $i = 1;
                                foreach ($points as $row) {
                                    ?>
                                    <tr>
                                        <td width="3%" align="center"><?= $i++ ?></td>
                                        <td> <?= $row['NIS'] ?></td>
                                        <td> <?= $row['nama'] ?></td>
                                        <td> <?= $row['JML'] ?></td>
                                        <td>
                                        <?php 
                                            $jml=$row['POINT'];
                                            if ($jml>100 && $jml<120) {
                                                echo '<span class="badge bg-yellow">'.$jml.'</span>';
                                            }elseif ($jml>120) {
                                                echo '<span class="badge bg-red">'.$jml.'</span>';
                                            }else{
                                                echo '<span class="badge bg-green">'.$jml.'</span>';
                                            }

                                        ?>
                                        </td>
                                        <td>
                                            <span class="pull-right">
                                                <?= anchor('pelanggaransiswa/detail/' . $row['NIS'] . '', 'Detail', 'class="label label-info" title="Detail Pelanggaran Siswa"') ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" align="center">Belum Ada Data</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div><!-- ./col -->
             <?php } ?>
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Statistik Data Siswa</h3>
                        <label>Siswa Laki-laki : <?=$cowok?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($cowokp,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($cowokp,2)?>%">
                            <i class="fa fa-female fa-male"></i> <?=number_format($cowokp,2)?>%
                          </div>
                        </div>

                        <label>Siswa Perempuan : <?=$cewek?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($cewekp,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($cewekp,2)?>%">
                            <i class="fa fa-female fa-female"></i> <?=number_format($cewekp,2)?>%
                          </div>
                        </div>
                    </div>
                    <a href="<?php echo site_url('siswa') ?>" class="small-box-footer bg-light-blue">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Statistik Data Guru &amp Karyawan</h3>
                        <label>Guru : <?=$guru?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($gurup,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($gurup,2)?>%">
                            <?=number_format($gurup,2)?>%
                          </div>
                        </div>

                        <label>Karyawan : <?=$karyawan?></label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?=number_format($karyawanp,2)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=number_format($karyawanp,2)?>%">
                            <?=number_format($karyawanp,2)?>%
                          </div>
                        </div>
                    </div>
                    <a href="<?php echo site_url('guru_karyawan') ?>" class="small-box-footer bg-orange">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Data Mengajar Ekstrakurikuler</h3>
                        <?php
                        if(!empty($mengajare)){
                        foreach ($mengajare as $value) {?>
                           <a href="<?=site_url('catataneskul/add/'.$value['ID'].'')?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#00A65A;font-size:14px;">
                              
                              <i class="fa fa-trophy"></i><?=substr($value['ESKUL'], 0,15)?>
                            </a> 
                        <?php }
                        }else{
                            echo "Belum ada data mengajar Ekstrakurikuler";
                        }
                        ?>
                        
                    </div>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-8 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Data Mengajar Mata Pelajaran</h3>
                        <?php
                        if(!empty($mengajar)){
                        foreach ($mengajar as $value) {?>
                           <a href="<?=site_url('nilai/detail/'.$value['ID'].'')?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#00A65A;font-size:14px;">
                              <h3 style="margin-bottom:0px;"> <?=$value['kelas']?></h3>
                              <h5 style="margin-top:0px;"><?=substr($value['mapel'], 0,20)?></h5>
                            </a> 
                        <?php }
                        }else{
                            echo "Belum ada data mengajar mapel";
                        }
                        ?>
                        
                    </div>
                </div>
            </div><!-- ./col -->

<?php }elseif($value->name=="Siswa"){
        $user=$this->ion_auth->user_b()->row_array();
        $nama=$user['nama'];
        $nisn=$user['nisn'];
        $id=$users->username;
        $img="res/foto/siswa/".$user['foto'];
    ?>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header ">
              <h3 class="box-title">Profil Pengguna</h3>
              <a style="height:100%;padding:9px 10px;" class="btn btn-sm btn-primary btn-flat pull-right" href="<?= site_url('me') ?>"><span class="fa fa-envelope-o"></span>&nbsp;Ganti Email</a>
              <a style="height:100%;padding:9px 10px;" class="btn btn-sm btn-primary btn-flat pull-right" href="<?= site_url('change_password') ?>"><span class="fa  fa-lock"></span>&nbsp;Ganti Password</a>
            </div><!-- /.box-header -->
          </div>
           <!-- profil singkat -->
            <div class="col-lg-4 col-xs-12">
              <table class="table table-border profil-dashboard">
                <tr>
                  <td width="45%" rowspan="3">
                    <img class="img-circle center-block" style="width:120px;height:130px;border:8px solid #E4E7E8;" src="<?php echo base_url(); ?><?php echo $img; ?>"/>
                  </td>
                  <td width="65%">
                    NIS/NISN</br>
                    <?= $id.'/'.$nisn?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Nama</br>
                    <?= $nama ?></td>
                </tr>
                <tr>
                  <td>
                    Grup Pengguna</br>
                    <?php
                        foreach ($user_groups as $value) {
                            echo ucwords(str_replace('_', ' ', $value->name)).' | ';
                        }
                    ?>
                  </td>
                </tr>
              </table>
            </div>

            <div class="col-lg-8 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="<?php echo site_url('options/ta') ?>" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#932ab6;font-size:14px;">
                          <i class="fa"><?=$tahun['THN']?></i>Tahun Ajaran
                        </a>
                        <a href="<?php echo site_url('options/ta') ?>" class="btn btn-lg btn-app bg-white disabled" style="width:22%;color:#932ab6;font-size:14px;">
                          <i class="fa">
                            <?php if($semester=='1'){
                                echo "1 (Ganjil)";
                            }else{
                                echo "2 (Genap)";
                            }

                            ?>
                        </i>Semester
                        </a>
                        <a href="<?= site_url('pelanggaransiswa/detail/'.$id.'')?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#f56954;font-size:14px;">
                          <span class="badge bg-red" style="font-size:14px;">
                            <?php if(!empty($point['POINT'])){
                                echo $point['POINT'];
                            }else{
                                echo "0";
                              }?>
                          </span>
                          <i class="fa fa-warning"></i>Point Pelanggaran
                        </a>

                        <a href="<?= site_url('presensi/detail/'.$id.'')?>" class="btn btn-lg btn-app bg-white" style="width:22%;color:#00A2E9;font-size:14px;">
                          <span class="badge bg-light-blue" style="font-size:14px;"><?=$absen['JML']?></span>
                          <i class="fa fa-check-square"></i>Ketidakhadiran
                        </a>
                        
                    </div>
                  </div>
            </div>
            <div class="clearfix"></div>
            
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Data Ekstrakurikuler</h3>
                        <table class="table table-border">
                            <tr>
                                <th>Nama Eskul</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        <?php
                        if(!empty($eskul)){
                        foreach ($eskul as $value) {?>
                            <tr>
                                <td><?=$value['nama']?></td>
                                <td><?=$value['THN']?></td>
                            </tr>
                        <?php }
                        }else{
                            echo'<tr><td colspan=2>Belum ada data Ekstrakurikuler</td></tr>';
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner bg-white">
                        <h3>Riwayat Kelas</h3>
                        <table class="table table-border">
                            <tr>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Lihat Raport</th>
                            </tr>
                        <?php
                        if(!empty($riwayatkelas)){
                        foreach ($riwayatkelas as $value) {?>
                            <tr>
                                <td><?=$value['kelas']?></td>
                                <td><?=$value['tahun']?></td>
                                <td>
                                  <span class="pull-left">
                                          <?= anchor('profilsiswa/cetakraport/' . $value['NIS'] . '/1/'.$value['thn'].'', 'Semester 1', 'class="label label-info" title="Raport semester 1"') ?>
                                          <?= anchor('profilsiswa/cetakraport/' . $value['NIS'] . '/2/'.$value['thn'].'', 'Semester 2', 'class="label label-info" title="Raport semester 2"') ?>
                                  </span>
                                </td>
                            </tr>
                        <?php }
                        }else{
                            echo'<tr><td colspan=2>Belum ada data Ekstrakurikuler</td></tr>';
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div><!-- ./col -->
   <?php }else{ ?>
           
   <?php }    
}
}
?>
    
   
</div><!-- /.row -->
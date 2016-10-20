<?php 
if (!$this->ion_auth->logged_in()){
    $user ='';
    $user_groups='';
}else{
    $users = $this->ion_auth->user()->row();
    $user_groups = $this->ion_auth->get_users_groups($users->id)->result();
}?>
<script>
    $(document).ready(function() {
        $('#tartikel').DataTable(
        {
            "sSearch": "Pencarian:" ,
            "ordering": false,
            "paging": false,
            "info": false,
            "lengthMenu": [[10, 50, -1], [10, 50, "Semua"]],
            "sPaginationType": "full_numbers",
            "language": {
            "lengthMenu": "Menampilkan _MENU_ Baris per halaman",
            "zeroRecords": "Tidak menemukan pencarian yang anda maksud",
            "info": "Halaman _PAGE_ dari _PAGES_ |Total _MAX_ data",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate": {
              "next": "<i class='fa fa-forward'></i>",
              "previous": "<i class='fa fa-backward'></i>",
              "first": "<i class='fa fa-fast-backward'></i>",
              "last": "<i class='fa fa-fast-forward'></i>"
            }
           }
        
        });
        
    } );
</script>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Detail Pelanggaran Siswa</h3>
                <?php
                foreach ($user_groups as $value) {
                    if($value->name=="Guru_BK"){?>
                    <a style="height:100%;padding:9px 10px;" class="btn btn-sm btn-primary btn-flat pull-right" href="<?= site_url('pelanggaransiswa/add/'.$siswa['NIS']) ?>"><span class="fa fa-plus-square"></span>&nbsp;Tambah Pelanggaran Siswa</a>
                <?php }} ?>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive" style="width:100%;">
                <table class="table table-borderless" style="width:100%;">
                    <tr>
                        <td width="10%">NIS</td>
                        <td width="2%">:</td>
                        <td width="20%"><?=$siswa['NIS'];?></td>
                        <td width="150px" rowspan="2">
                            <?php
                                $jml=$siswa['POINT'];
                                if ($jml>100 && $jml<120) {
                                    echo '<h3 class="pull-right btn bg-yellow btn-flat btn-lg" style="margin-top:0">Total Point : '.$jml.'</h3>';
                                }elseif ($jml>120) {
                                    echo '<h3 class="pull-right btn bg-red btn-flat btn-lg" style="margin-top:0">Total Point : '.$jml.'</h3>';
                                }else{
                                    echo '<h3 class="pull-right btn bg-green btn-flat btn-lg" style="margin-top:0">Total Point : '.$jml.'</h3>';
                                }
                            ?>
                               
                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?=$siswa['nama'];?></td>
                    </tr>
                   
                </table>
                <table id="tartikel" class="table table-bordered table-hover table-condensed" >
                        <thead>
                            <tr>
                                <th  width="5%" align="center">No</th>
                                <th width="15%">Tanggal Pelanggaran</th>
                                <th width="35%">Jenis Pelanggaran</th>
                                <th width="5%">Point</th>
                                <th width="25%">Keterangan</th>
                                <?php
                                foreach ($user_groups as $value) {
                                    if($value->name=="Guru_BK"){?>
                                    <th width="12%">Aksi</th>
                                <?php }} ?>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (!empty($list)) {
                        $i = 1;
                        foreach ($list as $row) {
                            ?>
                            <tr>
                                <?php $no=$i++; ?>
                                <td align="center"><?= $no ?></td>
                                <td> <?= tgl($row['TGL']) ?></td>
                                <td> <?= $row['NAMA'] ?></td>
                                <td> <?= $row['point'] ?></td>
                                <td><?= $row['ket'] ?></td>
                                <?php foreach ($user_groups as $value) {
                                    if($value->name=="Guru_BK"){?>
                                     <td>
                                        <span class="pull-right">
                                            <?= anchor('pelanggaransiswa/edit/' . $row['ID'] . '', 'Edit', 'class="label label-success" title="Edit Pelanggaran Siswa"') ?>
                                            <?= anchor('pelanggaransiswa/delete/' . $row['ID'] . '', 'Hapus', 'class="label label-danger" title="Hapus Pelanggaran Siswa" onClick="return confirm(\'Yakin ingin menghapus peanggaran siswa?\');"') ?>
                                        </span>
                                    </td>
                                <?php }} ?>
                               
                            </tr>
                            <?php
                        }

                    } else {
                        ?>
                        <tr>
                            <td colspan="7" align="center">Belum Ada Data</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>                            
                </table>
               
            </div>
        </div><!-- /.box -->                            
    </div>
</div>


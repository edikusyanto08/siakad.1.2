<script>
    $(document).ready(function() {
        $('#tartikel').DataTable(
        {
            "sSearch": "Pencarian:" ,
            "ordering": false,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
            "sPaginationType": "full_numbers",
            "language": {
            "lengthMenu": "Menampilkan _MENU_ Baris per halaman",
            "zeroRecords": "Tidak menemukan pencarian yang anda maksud",
            "info": "Halaman _PAGE_ dari _PAGES_",
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
        <div class="box">
            <div class="box-header">
                <span class="box-title">Daftar Kelas</span>
                
            </div><!-- /.box-header -->
            <div class="box-body table-responsive" style="width:55%;">
                <?php echo $notif; ?>
               
                <table id="tartikel" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="3%">No</th>
                            <th>Kelas</th>
                            <th width="150px">Jenjang/Tingkat</th>
                            <th width="100px">Jumlah Siswa</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($list)) {
                        $i = 1;
                        foreach ($list as $row) {
                            ?>
                            <tr>
                                <td width="3%" align="center"><?= $i++ ?></td>
                                <td> <?= $row['kelas'] ?></td>
                                <td> <?= $row['jenjang'] ?></td>
                                <td> <?= $row['JML'] ?></td>
                                <td>
                                    <span class="pull-right">
                                        <?= anchor('presensi/create/' . $row['ID'] . '', 'Buat Presensi', 'class="label label-success" title="Buat Presensi"') ?>
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
                    </tbody>							
                </table>
            </div>
            <div class="box-footer clearfix">
                <!-- <?php echo $pagination; ?> -->
            </div>
        </div><!-- /.box -->                            
    </div>
</div>
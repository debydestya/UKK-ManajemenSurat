<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <?php 

                    $notif = $this->session->flashdata('notif');

                    if ($notif != NULL) {
                        echo '<div class = "alert alert-danger">'.$notif.'</div>';
                    }

                ?>
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#" class="btn btn-success btn-sm print" data-toggle="modal" data-target="#modal_add">
                                <span class="fa fa-plus"></span>
                                Tambah User
                            </a>
                            <button class="btn btn-primary print" onclick="printPage()"><i class="fa fa-print"></i> Print </button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Bagian</th>
                                        <th class="print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 0;
                                        foreach ($data_user as $user) 
                                        {
                                            echo '
                                                <tr>
                                                    <td>'.++$no.'</td>
                                                    <td>'.$user->nik.'</td>
                                                    <td>'.$user->nama_depan.' '.$user->nama_belakang.'</td>
                                                    <td>'.$user->nama_jabatan.'</td>
                                                    <td>'.$user->nama_bagian.'</td>
                                                    <td class="print">
                                                        <a href="#" class="btn btn-warning btn-sm print" data-toggle="modal" data-target="#modal_edit'.$user->id_pengguna.'">Edit</a>
                                                        <a href="'.base_url('index.php/admin/delete_user/'.$user->id_pengguna).'" class="btn btn-danger btn-sm print">Hapus</a>
                                                    </td>
                                                </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

<!-- Modal ADD -->

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url(); ?>index.php/user/add_user" method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_addLabel">Add New User</h4>
                </div>
                <div class="modal-body col-lg-12">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group" style="">
                        <label>Nama Depan</label>
                        <input type="text" name="nama_awal" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label>Nama Belakang</label>
                        <input type="text" name="nama_akhir" class="form-control">
                    </div>
                    <div>
                        <label>Jabatan</label>
                        <?php ?>
                        <select class="form-control" name="jabatan">
                            <option value=""> --Pilih Jabatan-- </option>
                            <?php 
                                foreach ($jabatan as $jab) {
                                    echo '
                                        <option value="'.$jab->id_jabatan.'"> '.$jab->nama_jabatan.' </option>
                                    ';
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label>Bagian</label>
                        <select class="form-control" name="bagian">
                            <option value="">--Pilih Bagian--</option>
                            <?php 
                                foreach ($bagian as $bag) {
                                    echo'
                                        <option value="'.$bag->id_bagian.'">'.$bag->nama_bagian.'</option>
                                    ';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" value="save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Modal Edit -->
<?php 

foreach ($data_user as $user) {
    echo '

<div class="modal fade" id="modal_edit'.$user->id_pengguna.'" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url(); ?>index.php/admin/add_user" method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_addLabel">Add New User</h4>
                </div>
                <div class="modal-body col-lg-12">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" value="'.$user->nik.'">
                    </div>
                    <div class="col-lg-6 form-group" style="">
                        <label>Nama Depan</label>
                        <input type="text" name="nama_awal" class="form-control" value="'.$user->nama_depan.'">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label>Nama Belakang</label>
                        <input type="text" name="nama_akhir" class="form-control" value="'.$user->nama_belakang.'">
                    </div>
                    <div>
                        <label>Jabatan</label>
                        <?php ?>
                        <select class="form-control" name="jabatan">
                            <option>--Pilih Jenis--</option>';
                                        foreach ($jabatan as $jenis) {
                                            echo'
                                                <option value="'.$jenis->id_jabatan.'" ';
                                                if ($jenis->id_jabatan==$user->id_jabatan) {
                                                    echo'selected';
                                                }
                                                 echo'>'.$jenis->nama_jabatan.'</option>
                                            ';
                                        }
                                    echo'
                                </select>
                    </div>
                    <div>
                        <label>Bagian</label>
                        <select class="form-control" name="bagian">
                            <option value="">--Pilih Bagian--</option>';
                                foreach ($bagian as $bagians) {
                                    echo '<option value="'.$bagians->id_bagian.'"';
                                    if ($bagians->id_bagian==$user->id_bagian) {
                                        echo 'selected';
                                    }
                                        echo '>'.$bagians->nama_bagian.'</option>';
                                }
                            echo '
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" value="save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

</div>
';
}
?>


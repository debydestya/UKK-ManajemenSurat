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
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                <span class="fa fa-plus"></span>
                                Tambah Surat
                            </button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Jenis Surat</th>
                                        <th>Pengirim</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Tanggal Terima</th>
                                        <th>Perihal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 0;
                                        foreach ($list_surat as $surat) 
                                        {
                                            echo '
                                                <tr>
                                                    <td>'.++$no.'</td>
                                                    <td>'.$surat->nomor_surat.'</td>
                                                    <td>'.$surat->jenis_surat.'</td>
                                                    <td>'.$surat->pengirim.'</td>
                                                    <td>'.$surat->tanggal_kirim.'</td>
                                                    <td>'.$surat->tanggal_penerima.'</td>
                                                    <td>'.$surat->perihal.'</td>
                                                    <td>
                                                        <a href="'.base_url('uploads/'.$surat->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat</a>
                                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Edit</button>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit'.$surat->id_surat_masuk.'">Edit</button>
                                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="">Disposisi</a>
                                                        <a href="'.base_url('index.php/surat/delete_surat/'.$surat->id_surat_masuk).'" class="btn btn-danger btn-sm">Hapus</a>
                                                    </td>
                                                </tr>

<div class="modal fade" id="modal_edit'.$surat->id_surat_masuk.'" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="'.base_url('index.php/surat/edit_surat/'.$surat->id_surat_masuk).'" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_addLabel">Tambah Surat Baru</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" name="nomorsurat" class="form-control" value="'.$surat->nomor_surat.'">
                    </div>
                    <div>
                        <label>Jenis Surat</label>
                        <select class="form-control" name="jenis"> ';
                                foreach ($jenis_surat as $jenis) {
                                    echo '<option value="'.$jenis->id_jenis_surat.'"';if($jenis->id_jenis_surat==$surat->id_jenis_surat){echo 'selected>';} echo ''.$jenis->jenis_surat.'</option>';
                                }
                            echo '
                        </select>
                    <div>
                        <label>Pengirim</label>
                        <input type="text" name="pengirim" class="form-control" value="'.$surat->pengirim.'">
                    </div>
                    <div>
                        <label>Tanggal Kirim</label>
                        <input type="date" name="tanggalkirim" class="form-control" value="'.$surat->tanggal_kirim.'">
                    </div>
                    <div>
                        <label>Tanggal Terima</label>
                        <input type="date" name="tanggalterima" class="form-control" value="'.$surat->tanggal_penerima.'">
                    </div>
                    <div>
                        <label>Perihal</label>
                        <input type="text" name="perihal" class="form-control" value="'.$surat->perihal.'">
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
            <form action="<?php echo base_url(); ?>index.php/surat/add_surat" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_addLabel">Tambah Surat Baru</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" name="nomorsurat" class="form-control" >
                    </div>
                    <div>
                        <label>Jenis Surat</label>
                        <select class="form-control" name="jenis">
                            <option value=""> --Pilih Jenis-- </option>
                            <?php 
                                foreach ($jenis_surat as $jenis_surat ) {
                                    echo '
                                        <option value="'.$jenis_surat->id_jenis_surat.'"> '.$jenis_surat->jenis_surat.' </option>
                                    ';
                                }
                            ?>
                        </select>
                    <div>
                        <label>Pengirim</label>
                        <input type="text" name="pengirim" class="form-control">
                    </div>
                    <div>
                        <label>Tanggal Kirim</label>
                        <input type="date" name="tanggalkirim" class="form-control">
                    </div>
                    <div>
                        <label>Tanggal Terima</label>
                        <input type="date" name="tanggalterima" class="form-control">
                    </div>
                    <div>
                        <label>Perihal</label>
                        <input type="text" name="perihal" class="form-control">
                    </div>
                    <div>
                        <label>File (.pdf)</label>
                        <input type="file" name="file_surat">
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

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                        </div>
                                        <div class="modal-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
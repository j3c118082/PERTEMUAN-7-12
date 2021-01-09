<section class="my-4">
        <div class="container">
            <h2> Data Mahasiswa </h2>

            <?php if(!empty($session)) { ?>

                <div class="alert alert-<?php echo $session['status'] ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                    <?php echo $session['message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <?php }

                if(!empty($isLogin))
                { 

            ?>

                <p>
                    <a href="<?php echo site_url('Mahasiswa/add');?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>Tambah
                    </a>
                </p>

            <?php 
        
                } 
                
            ?>

            <table class="table table-striped table-bordered" id="cancel">
                <thead class="thead-light">
                    <tr>
                        
                        <?php 
                            if (!empty($isLogin)) { 
                        ?>
                            <th> Aksi </th>
                        <?php 
                            } 
                        ?>
                        
                        <th> Nama Mahasiswa </th>
                        <th> Nomor Induk Mahasiswa </th>
                        <th> Agama </th>
                        <th> Jenis Kelamin </th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($dataMahasiswa as $row) : ?> 

                    <tr>
                        <?php 
                            if (!empty($isLogin)) { 
                        ?>

                        <th>
                            <a href="<?php echo site_url('Mahasiswa/edit/'.$row->nim); ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil"></i>Ubah
                            </a>
                            <a href="<?php echo site_url('Mahasiswa/delete/'.$row->nim); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?');">
                                <i class="fa fa-trash"></i>Hapus
                            </a>
                        </th>

                        <?php 
                            } 
                        ?>
                        
                        <td><?php echo $row->nama_mahasiswa; ?></td>
                        <td><?php echo $row->nim; ?></td>
                        <td><?php echo $row->agama; ?></td>
                        <td><?php echo $row->jenis_kelamin; ?></td>
                    </tr>

                    <?php 
                        endforeach; 
                    
                        if (empty($dataMahasiswa)) {
                    ?>

                    <tr>
                        <td colspan="5" class="text-center">Tidak Ada Data.</td>
                    </tr>

                    <?php 
                        } 
                    ?>
                </tbody>

            </table>
        </div>
</section>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-envelope"></i> Data Surat Keluar</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Sekretaris</li>
          <li class="breadcrumb-item active"><a href="#">Data Surat</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <h4 style="text-align: center;"><i class="fa fa-envelope"></i> Data Surat Keluar</h4>
              <hr>
               <?php 
          $notif = $this->session->flashdata('notif');
          if(!empty($notif)){
            echo '<div class="alert alert-success">';
            echo $notif;
            echo '</div>';
          }
          ?>
              <div>
                  <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"> 
                  <i class="fa fa-plus"></i> Tambah Surat 
                  </button>
                  </div>
              <table class="table table-hover table-bordered" id="sampleTable">
                 
                <thead>
                  <tr>
                    <th>NO</th>
                    <th class="hidden-phone" style="width: 10px"><i class="fa fa-file-o"></i> No. Surat</th>
                    <th><i class="fa fa-bookmark"></i> Tujuan</th>
                    <th><i class="fa fa-calendar-o"></i> Tgl Kirim</th>
                    <th style="width: 15px"><i class="fa fa-question-circle"></i> Perihal</th>
                    <th><i class="fa fa-edit"></i> Aksi </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   $no = 0;
                   foreach ($data_surat_keluar as $surat_keluar) {
                     echo'
                     <tr>
                    <td>'.++$no.'</td>
                    <td>'.$surat_keluar->nomor_surat.'</td>
                    <td>'.$surat_keluar->tujuan.'</td>
                    <td>'.$surat_keluar->tgl_kirim.'</td>
                    <td>'.$surat_keluar->perihal.'</td>
                    <td>
                    <a href="'.base_url('uploads/.$surat_keluar->file_surat').'" class="btn btn-info btn-sm" target="_blank">Lihat </a>

                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_ubah" onclick="prepare_update_surat('.$surat_keluar->id_surat.')">Ubah </a>

                     <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_ubah_surat" onclick="prepare_ubah_surat('.$surat_keluar->id_surat.')">Ubah Surat </a>

                      <a href="'.base_url('index.php/surat/disposisi/'.$surat_keluar->id_surat).'" class="btn btn-primary btn-sm">Disppsisi </a>

                       <a href="'.base_url('index.php/surat/hapus_surat_keluar/'.$surat_keluar->id_surat).'" class="btn btn-danger btn-sm">Hapus </a>



                    </td>


                     </tr>

                     ';

                   }


                  ?>
                
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addlabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url('index.php/surat/tambah_surat_keluar'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_addlabel"> Tambah Surat Keluar </h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nomor Surat</label>
            <input type="text" name="no_surat" class="form-control">
          </div>
          <div class="form-group">
            <label>Tanggal Kirim</label>
            <input type="date" name="tgl_kirim" class="form-control">
          </div>

          <div class="form-group">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control">
          </div>

          <div class="form-group">
            <label>Perihal</label>
            <input type="text" name="perihal" class="form-control">
          </div>

          <div class="form-group">
            <label>Unggah Surat (*pdf) </label>
            <input type="file" name="file_surat" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
          <input type="submit" name="submit" class="btn btn-primary" value="Simpan"> 
        </div>
      </form>
    </div>
  </div>
  </div>  

  <div class="modal fade" id="modal_ubah" tabindex="-1" role="dialog" aria-labelledby="modal_addlabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url('index.php/surat/ubah_surat_keluar'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_addlabel"> Ubah Surat Masuk </h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_id_surat" id="edit_id_surat">
          <div class="form-group">
            <label>Nomor Surat</label>
            <input type="text" name="edit_no_surat" id="edit_no_surat" class="form-control">
          </div>
          <div class="form-group">
            <label>Tanggal Kirim</label>
            <input type="date" name="edit_tgl_kirim" id="edit_tgl_kirim" class="form-control">
          </div>

          <div class="form-group">
            <label>Tujuan</label>
            <input type="text" name="edit_tujuan" id="edit_tujuan" class="form-control">
          </div>

          <div class="form-group">
            <label>Perihal</label>
            <input type="text" name="edit_perihal" id="edit_perihal" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
          <input type="submit" name="submit" class="btn btn-primary" value="Simpan"> 
        </div>
      </form>
    </div>
  </div>
  </div>    


  <div class="modal fade" id="modal_ubah_surat" tabindex="-1" role="dialog" aria-labelledby="modal_addlabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url('index.php/surat/ubah_file_surat_keluar'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_addlabel"> Ubah Surat Masuk </h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_surat" id="id_edit_file">       
          <div class="form-group">
            <label>Unggah Surat (*pdf) </label>
            <input type="file" name="edit_file_surat"  class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
          <input type="submit" name="submit" class="btn btn-primary" value="Simpan"> 
        </div>
      </form>
    </div>
  </div>
  </div>    
    </main>


<script type="text/javascript">
   function prepare_ubah_surat(id){
          $('#id_edit_file').val(id);
          $('#modal_ubah_surat').modal('show');
        }


   function prepare_update_surat(id_surat)
        {
            $('#edit_file_surat').empty();
            $('#edit_id_surat').empty();
            $('#edit_no_surat').empty();
            $('#edit_tgl_kirim').empty();
            $('#edit_tujuan').empty();
            $('#edit_perihal').empty();

            $.getJSON('<?php echo base_url(); ?>index.php/surat/get_surat_masuk_by_id/'+id_surat, function(data){
                $('#edit_file_surat').val(data.id_surat);
                $('#edit_id_surat').val(data.id_surat);
                $('#edit_no_surat').val(data.nomor_surat);
                $('#edit_tgl_kirim').val(data.tgl_kirim);
                $('#edit_tujuan').val(data.penerima);
                $('#edit_perihal').val(data.perihal);
            });
        }
</script>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-envelope"></i> Data Disposisi</h1>
         
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
              <h4 style="text-align: center;"><i class="fa fa-envelope"></i> Data Disposisi</h4>
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
                  </div>
              <table class="table table-hover table-bordered" id="sampleTable">
                 
                <thead>
                   <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"> 
                <i class="fa fa-plus"></i> Tambah Disposisi 
                </button>  | No. Surat : <?php echo $data_surat->nomor_surat;?> 

                  <tr>
                    <th>NO</th>
                    <th class="hidden-phone"><i class="fa fa-file-o"></i>Tujuan Unit</th>
                    <th><i class="fa fa-bookmark"></i>Tujuan Pegawai</th>
                    <th><i class="fa fa-calendar-o"></i>TGL DISPOSISI</th>
                    <th><i class="fa fa-question-circle"></i> KETERANGAN</th>
                    <TH></TH>
                    <th><i class="fa fa-edit"></i> Aksi </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   $no = 0;
                   foreach ($data_disposisi as $disposisi) {
                     echo'
                     <tr>
                    <td>'.++$no.'</td>
                    <td>'.$disposisi->nama_jabatan.'</td>
                    <td>'.$disposisi->nama.'</td>
                    <td>'.$disposisi->tgl_disposisi.'</td>
                    <td>'.$disposisi->keterangan.'</td>

                    ';

                    if($disposisi->id_pegawai_pengirim == $this->session->userdata('id_pegawai')){
                      echo '<td><label class="label label-success">Disposisi keluar</label></td>';
                    }

                    echo'
                    <td>
                       <a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm btn-block">Lihat Surat</a>

                    <a href="'.base_url('index.php/surat/hapus_disposisi_keluar/'.$this->uri->segment(3).'/'.$disposisi->id_disposisi).'" class="btn btn-danger btn-sm btn-block">Hapus</a>

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
      <form action="<?php echo base_url('index.php/surat/tambah_disposisi/'.$this->uri->segment(3)) ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_addlabel"> Tambah Disposisi Surat</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Tujuan Unit</label>
            <select class="form-control" name="tujuan_unit" onchange="get_pegawai_by_jabatan(this.value)">
              <option value="">-- Pilih Tujuan Unit -- </option>
              <?php
                foreach ($drop_down_jabatan as $jabatan){
                  if($jabatan->id_jabatan != $this->session->userdata('id_jabatan') && $jabatan->id_jabatan > $this->session->userdata('id_jabatan')){
                    echo'
                    <option value="'.$jabatan->id_jabatan.'">'.$jabatan->nama_jabatan.'</option>
                    ';
                  }
                }
              ?>


            </select>
            
        </div>

         <div class="form-group">
            <label>Tujuan Pegawai</label>
            <select type="date" name="tujuan_pegawai" id="tujuan_pegawai" class="form-control">
              <option value="">-- Pilih Nama Pegawai --</option>
            </select>
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" row="10">
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
   function get_pegawai_by_jabatan(id_jabatan){
    $('#tujuan_pegawai').empty();
    $.getJSON('<?php echo base_url() ?>index.php/surat/get_pegawai_by_jabatan/'+id_jabatan, function(data) {
      $.each(data, function(index,value){
        $('#tujuan_pegawai').append('<option value="'+value.id_pegawai+'">'+value.nama+'</option>');
      })
        /*optional stuff to do after success */
    });
   }
</script>
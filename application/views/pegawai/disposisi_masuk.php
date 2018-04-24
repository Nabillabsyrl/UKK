
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
                  <tr>
                    <th>NO</th>
                    <th class="hidden-phone" style="width: 10px"><i class="fa fa-file-o"></i>Unit Pengirim</th>
                    <th><i class="fa fa-bookmark"></i> Nama Pengirim</th>
                    <th><i class="fa fa-calendar-o"></i>TGL DISPOSISI</th>
                    <th style="width: 15px"><i class="fa fa-question-circle"></i> KETERANGAN</th>
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

                    if($disposisi->id_pegawai_penerima == $this->session->userdata('id_pegawai')){
                      echo '<td><label class="btn btn-success">Disposisi Masuk</label></td>';
                    }

                    echo'
                    <td>
                       <a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm btn-block">Lihat Surat</a>

                    <a href="'.base_url('index.php/surat/disposisi_keluar/'.$disposisi->id_surat).'" class="btn btn-primary btn-sm btn-block">Tambah Disposisi</a>

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
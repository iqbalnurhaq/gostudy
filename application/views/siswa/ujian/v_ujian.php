
<div class="content">
  <div class="container-fluid">

<div class="row">
  
</div>
<div class="row">
  <div class="col-md-12">
  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Ujian</h4>
            <p class="card-category">New employees on 15th September, 2016</p>
            
      </div>
      <div class="card-body table-responsive">
        <table id="example1" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama Ujian</th>
                <th>Tanggal Dibuat</th>
                <th>Aktif</th>
                <th>Deadline</th>
                <th>Durasi</th>
                <th>Jumlah Soal</th>
                <th>Kerjakan</th>
                <th>Hasil</th>
              
            </tr>
          </thead>
          <tbody>
                
          </tbody>
          <tfoot>
              <tr>
              <th>No</th>
                <th>Nama Ujian</th>
                <th>Tanggal Dibuat</th>
                <th>Aktif</th>
                <th>Deadline</th>
                <th>Durasi</th>
                <th>Jumlah Soal</th>
                <th>Kerjakan</th>
                <th>Hasil</th>
            </tr>
          </tfoot>
        </table>  
      </div>
    </div>
  </div>
</div>



  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

      <?php $this->load->view('guru/footer'); ?>



<script>

$(document).ready(function() {




    var no =1;
    $('#example').DataTable();
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tabel = $('#example1').DataTable({

      "ajax":
      {
        "dataSrc": "data_ujian",
        "url": "http://localhost/gostudy/siswa/S_ujian/ambil_data_ujian", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nama_ujian" }, // Tampilkan nis
        { "data": "tgl_dibuat"},
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = row.tgl_aktif + ' || ' + row.wkt_aktif;

            return html
          }
        },
         { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = row.tgl_akhir + ' || ' + row.wkt_akhir;

            return html
          }
        },
         { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = row.durasi + ' menit ';

            return html
          }
        },
        { "data": "jml_soal"},
      
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '<a class="btn btn-warning btn-sm" href="<?php echo site_url('siswa/S_ujian/kerjakan/')?>'+ row.kode_ujian +'"> Kerjakan </a> ';

            return html
          }
        },
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '<a class="btn btn-success btn-sm" href="<?php echo site_url('siswa/S_ujian/hasil_ujian/')?>'+ row.kode_ujian +'"> Hasil </a> ';

            return html
          }
        },
       

      ],
    });
    
}); 




</script>

<?php 
if($this->session->flashdata('pesan')){
  if ($this->session->flashdata('pesan') == 'sukses') { ?>
    <script>
      $.notify({
            icon: "done",
            message: "Data berhasil ditambahkan."
  
        },{
            type: 'success',
            timer: 400,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
    </script>  
  <?php 
  }else if($this->session->flashdata('pesan') == 'error'){ ?>
    <script>
    $.notify({
          icon: " ",
         message: "<?php echo $this->session->flashdata('message') ?>"
  
      },{
          type: 'danger',
          timer: 400,
          placement: {
              from: 'top',
              align: 'center'
          }
      });
  </script>  
  <?php }
  
  
}

?>  










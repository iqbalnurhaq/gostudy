


<div class="content">
  <div class="container-fluid">

<div class="row">
 
</div>
<div class="row">
  <div class="col-md-12">
  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Nilai Siswa</h4>
            
      </div>
      <div class="card-body table-responsive">
        <table id="example1" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Nama Kelas</th>
                <th>Aksi Cetak Raport</th>
                
            </tr>
          </thead>
          <tbody>
              
          </tbody>
          <tfoot>
              <tr>
             
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Nama Kelas</th>
                 <th>Aksi Cetak Raport</th>
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
    $('#date_time_mask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tabel = $('#example1').DataTable({

      "ajax":
      {
        "dataSrc": "data_siswa",
        "url": "http://localhost/gostudy/guru_usr_clx/G_cetak/data_siswa", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nis" }, // Tampilkan nis
        { "data": "nama_siswa" }, // Tampilkan nis
        { "data": "nama_kelas" }, // Tampilkan nis
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            html = '';
           
      
              html += '<a style="color: white" class="btn btn-primary btn-sm" href="<?php echo site_url('guru_usr_clx/G_cetak/aksi_cetak/') ?>'+ row.kode_siswa+' "> Cetak </a> ';
            
            return html
          }
        },

      ],
    });

      
}); 




// function aksiClear(kode_nilai, nama){
//   var namaGuru = nama;
//   Swal.fire({
//   title: "Apakah kamu ingin mecentak raport " + namaGuru + "!",
//   text: "Pastikan semua nilai terisi sebelum melakukan cetak raport!!",
//   type: 'warning',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Ya, Cetak!'
//   }).then((result) => {
//     if (result.value) {
//       $.ajax({
//         url : "http://localhost/gostudy/guru_usr_clx/G_cetak/aksi_cetak",
//         method: 'POST',
//         dataType: 'json',
//         data: {kode_nilai : kode_nilai},
//         contentType: 'application/x-www-form-urlencoded',
//         success: function(data){
//           Swal.fire('Success!', 'Berhasil Membersihkan.', 'success');
//           setTimeout(function(){
//              window.location.href = "<?php echo base_url('guru_usr_clx/G_nilai'); ?>";
//           }, 1100);

//         },
//         error: function( errorThrown ){
//           console.log( errorThrown);

//         }

//       });

//     }
//   });

// }




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
          icon: "done",
          message: "something went wrong"
  
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










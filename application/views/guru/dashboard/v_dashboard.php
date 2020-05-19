

<div class="content">
  <div class="container-fluid">


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
        "dataSrc": "dataGuru",
        "url": "http://localhost/gostudy/go_ciclx_usradmin/A_guru/data_guru", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nip" }, // Tampilkan nis
        { "data": "nama_guru" },  // Tampilkan nama
        { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
            var html = ""
            if(row.kode_mapel == null){ // Jika jenis kelaminnya 1
              html = '<button class="btn btn-primary btn-xs" onClick="aksiTmbMapel(\'' + row.kode_guru + '\' )"> Pilih <i class="material-icons">report</i> </button>' // Set laki-laki
            }else{ // Jika bukan 1
              html = '<button class="btn btn-success btn-xs" onClick="aksiTmbMapel(\'' + row.kode_guru + '\' )">  ' +  row.nama_mapel +'   </button>'
            }   
            return html; // Tampilkan jenis kelaminnya
          }
        },
       
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi

            
            html = '<button class="btn btn-warning btn-xs" onClick="aksiBanned(\'' + row.kode_guru + '\' , \'' + row.nama_guru + '\')"> Banned <i class="material-icons">report</i> </button> <button class="btn btn-danger btn-xs" onClick="aksiHapus(\'' + row.kode_guru + '\' , \'' + row.nama_guru + '\')"> Hapus <i class="material-icons">delete_forever</i> </button>';

            return html
          }
        },
      ],
    });

    tabel2 = $('#example2').DataTable({

        "ajax":
        {
          "dataSrc": "dataGuru",
          "url": "http://localhost/gostudy/go_ciclx_usradmin/A_guru/data_guru_ban", // URL file untuk proses select datanya
          "type": "GET"
        },

        // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
        "columns": [
          { "render": function ( data, type, row ) { // Tampilkan kolom aksi
              var html  = no++;
              return html
            }
          },
          { "data": "nip" }, // Tampilkan nis
          { "data": "nama_guru" },  // Tampilkan nama
          { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
              var html1 = ""
              if(row.kode_mapel == null){ // Jika jenis kelaminnya 1
                html1 += 'Belum ditentukan' // Set laki-laki
              }else{ // Jika bukan 1
                html1 += row.nama_mapel; 
              }
              return html1; // Tampilkan jenis kelaminnya
            }
          },
        
          { "render": function ( data, type, row ) { // Tampilkan kolom aksi

              
              html = '<button class="btn btn-primary btn-xs" onClick="aksiAktif(\'' + row.kode_guru + '\' , \'' + row.nama_guru + '\')"> Aktifkan <i class="material-icons">report</i> </button> ';

              return html
            }
          },
        ],
        });
    
}); 

function aksiHapus(data, nama){
  var id = data;
  var namaGuru = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus Guru " + namaGuru + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/hapus_guru",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_guru'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}


function aksiBanned(data, nama){
  var id = data;
  var namaGuru = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin membekukan Guru " + namaGuru + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/ban_guru",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil membekukan.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_guru'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}


function aksiAktif(data, nama){
  var id = data;
  var namaGuru = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin mengaktifkan Guru " + namaGuru + "?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/aktifkan_guru",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil membekukan.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_guru'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}

async function aksiPilih(data, kode_guru){
  const { value: fruit } = await Swal.fire({
  title: 'Select field validation',
  input: 'select',
  inputOptions: data,
  inputPlaceholder: 'Select a fruit',
  showCancelButton: true,
  inputValidator: (value) => {
    return new Promise((resolve) => {
      resolve()
    })
  }
})

if (fruit) {
  aksi_tambah_pengampu(fruit, kode_guru)
}
}

function aksiTmbMapel(kode_guru){
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_mapel/data_mapel",
        method: 'GET',
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          aksiPilih(data.dataMapel, kode_guru);
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });
}


function aksi_tambah_pengampu(kode_mapel, kode_guru){
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/tambah_pengampu",
        method: 'POST',
        data : {kode_mapel:kode_mapel, kode_guru:kode_guru}, 
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });
}

</script>

<?php 

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
}

?>




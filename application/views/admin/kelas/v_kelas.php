
<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-12">
    <button class="btn btn-primary pull-right" onClick="tambah_kelas()">Tambah Kelas</button>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Kelas</h4>
            <p class="card-category">New employees on 15th September, 2016</p>
      </div>
      <div class="card-body table-responsive">
        <table id="example1" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama kelas</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
                
          </tbody>
          <tfoot>
              <tr>
                <th>No</th>
                <th>Nama kelas</th>
                <th>Aksi</th>
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

      <?php $this->load->view('admin/footer'); ?>



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
        "dataSrc": "datakelas",
        "url": "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/load_data_kelas", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nama_kelas" }, // Tampilkan nis  
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi

            
            html = '<button class="btn btn-primary btn-sm" onClick="next_kelas(\'' + row.kode_kelas + '\' , \'' + row.nama_kelas + '\')"> Lihat  </button> <button class="btn btn-warning btn-sm" onClick="edit_kelas(\'' + row.kode_kelas + '\' , \'' + row.nama_kelas + '\')"> Edit </button> <button class="btn btn-danger btn-sm" onClick="aksiHapus(\'' + row.kode_kelas + '\' , \'' + row.nama_kelas + '\')"> Hapus </button>';

            return html
          }
        },
      ],
    });
    
}); 

function aksiHapus(data, nama){
  var id = data;
  var namakelas = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus kelas " + namakelas + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/hapus_kelas",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}


async function aksiPilih(data){
  const { value: fruit } = await Swal.fire({
  title: 'Select field validation',
  input: 'select',
  inputOptions: data,
  inputPlaceholder: 'Pilih kelas',
  showCancelButton: true,
  inputValidator: (value) => {
    return new Promise((resolve) => {
      resolve()
    })
  }
})

if (fruit) {
  Swal.fire(`You selected: ${fruit}`)
  
}
}

function aksi_tambah_kelas(data){
    $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/tmb_kelas",
        method: 'POST',
        dataType: 'json',
        data: {nama_kelas : data},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
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
          setTimeout(function(){
            window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas'); ?>";
          }, 1000);
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

    });
}

async function tambah_kelas(){
    const { value: text } = await Swal.fire({
        input: 'text',
        inputPlaceholder: 'Masukkan nama kelas',
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
            return 'Tidak boleh kosong!'
            }
        }
    })

    if (text) {
      aksi_tambah_kelas(text)
    }
}


async function edit_kelas(kode_kelas, nama_kelas){
    const { value: text } = await Swal.fire({
        input: 'text',
        inputValue: nama_kelas,
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
            return 'Tidak boleh kosong!'
            }
        }
    })

    if (kode_kelas, text) {
      aksi_edit_kelas(kode_kelas, text)
    }
}

function aksi_edit_kelas(kode_kelas, nama_kelas){
  $.ajax({
    url : "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/edit_kelas",
    method: 'POST',
    dataType: 'json',
    data: {kode_kelas : kode_kelas, nama_kelas : nama_kelas},
    contentType: 'application/x-www-form-urlencoded',
    success: function(data){
      $.notify({
        icon: "done",
        message: "Data berhasil dirubah."
        },{
            type: 'success',
            timer: 400,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
        setTimeout(function(){
          window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas'); ?>";
        }, 1000);
    },
    error: function( errorThrown ){
      console.log( errorThrown);

    }

  });
}

function next_kelas(kode_kelas, nama_kelas){
    localStorage.setItem('kode_kelas', kode_kelas);
    localStorage.setItem('nama_kelas', nama_kelas);
    window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas/nextAksi'); ?>"; 
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



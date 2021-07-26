
<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-12">
    <button class="btn btn-primary pull-right" onClick="tambah_kelas()">Tambah Kode</button>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Kelas</h4>
            
      </div>
      <div class="card-body table-responsive">
        <table id="example1" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
                
          </tbody>
          <tfoot>
              <tr>
                <th>No</th>
                <th>Kode</th>
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
        "url": "http://localhost/gostudy/go_ciclx_usradmin/A_cetak/load_data", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "kode" }, // Tampilkan nis  
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi

            
            html = '<button class="btn btn-danger btn-sm" onClick="aksiHapus( '+ row.id + ')"> Hapus </button>';

            return html
          }
        },
      ],
    });
    
}); 

function aksiHapus(data){
  var id = data;
  
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus kode ini?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_cetak/hapus",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_cetak'); ?>";
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
  inputPlaceholder: 'Pilih Kode',
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
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_cetak/tmb_kelas",
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
            window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_cetak'); ?>";
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
        inputPlaceholder: 'Masukkan kode',
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



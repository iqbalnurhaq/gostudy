

<div class="content">
  <div class="container-fluid">


    

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Input Nilai (<?php echo $nama_nilai; ?>)</h4>
            
      </div>
      <div class="card-body table-responsive">
        <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: <?php echo $progress ?>%;" aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $progress ?>%</div>
        </div>
       <table id="example1" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Input</th>
            </tr>
          </thead>
          <tbody>
         
          </tbody>
        
        </table>  
      </div>
    </div>
    <?php 
          if ($progress == 100) { ?>
            <a class="btn btn-info pull-right" href="<?php echo site_url('guru_usr_clx/G_nilai/export_nilai_fix/').$kode_nilai ?>"> Download Nilai </a>
            
          <?php } else { ?>
            <a class="btn btn-info pull-right disabled" href="#"> Download Nilai </a>
          <?php } ?>
         
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
        "dataSrc": "nilai_siswa",
        "url": "http://localhost/gostudy/guru_usr_clx/G_nilai/nilai_siswa", // URL file untuk proses select datanya
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
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi

           if(row.nilai == null){ // Jika jenis kelaminnya 1
              html = '<button class="btn btn-danger btn-sm" onClick="aksiInput(\'' + row.kode_siswa + '\', \'' + row.nama_siswa + '\' )"> Input Nilai </button> ';
            }else{ // Jika bukan 1
              html = '<button class="btn btn-primary btn-sm" onClick="aksiInputEdit(\'' + row.kode_siswa + '\', \'' + row.nama_siswa + '\', \'' + row.nilai + '\')"> '+ row.nilai +' </button> ';
            }   
            

            return html
          }
        },

      ],
    });

}); 


async function aksiInput(kode_siswa, nama_siswa){
          const { value: formValues } = Swal.fire({

      title: nama_siswa,
      html: '<label style="float: left">Nilai</label>' +
    '<input type="number" class="form-control" name="nilai" pattern="[0-9]+" id="swal-input1" min=0 max=100>',
      focusConfirm: false,
      preConfirm: () => {
        
        var nilai = document.getElementById('swal-input1').value;
        if(nilai < 0){
          console.log("err")
        }else if(nilai > 100){
          console.log("err")
        }else{
          input_nilai(nilai, kode_siswa);
        }
      }
    })
    
// if (formValues) {
//   Swal.fire(JSON.stringify(formValues))
// }
}
async function aksiInputEdit(kode_siswa, nama_siswa, nilai){
          const { value: formValues } = Swal.fire({

      title: nama_siswa,
      html: '<label style="float: left">Nilai</label>' +
    '<input type="number" class="form-control" name="nilai" pattern="[0-9]+" id="swal-input1" min=0 max=100 value='+ nilai +'>',
      focusConfirm: false,
      preConfirm: () => {
        
        var nilai = document.getElementById('swal-input1').value;
        if(nilai < 0){
          console.log("err")
        }else if(nilai > 100){
          console.log("err")
        }else{
          input_nilai(nilai, kode_siswa);
        }
      }
    })
    
// if (formValues) {
//   Swal.fire(JSON.stringify(formValues))
// }
}



function input_nilai(nilai, kode_siswa){
  $.ajax({
      url : "http://localhost/gostudy/guru_usr_clx/G_nilai/input_nilai",
      method: 'POST',
      dataType: 'json',
      data: {nilai:nilai, kode_siswa:kode_siswa},
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
        console.log(data)
        Swal.fire('Berhasil!', 'Berhasil Menambahkan', 'success');
        setTimeout(function(){
            window.location.href = "<?php echo base_url('guru_usr_clx/G_nilai/link_nilai/'); ?>" + data.kode_nilai;
        }, 1100);

      },
      error: function( errorThrown ){
        console.log( errorThrown);

      }

    });
}




// function inputNilaiModal(kode_siswa){
//     $.ajax({
//         url : "http://localhost/guru_usr_clx/G_nilai/data_nilai",
//         method: 'POST',
//         dataType: 'json',
//         data: {kode_siswa : kode_siswa},
//         contentType: 'application/x-www-form-urlencoded',
//         success: function(data){
//             console.log(data)
//         },
//         error: function( errorThrown ){
//           console.log( errorThrown);

//         }

//       });
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










<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Daftar Guru <button type="submit" class="btn btn-warning pull-right">Tambah Guru</button></h4>
            <p class="card-category">Menu manajemen data guru</p>
            
          </div>
          <div class="card-body">


          <table id="example" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Mengampu</th>
                <th>Aksi</th>
                
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
        <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Mengampu</th>
                <th>Aksi</th>
                
            </tr>
        </tfoot>
    </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

      <?php $this->load->view('admin/footer'); ?>

<script>

$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
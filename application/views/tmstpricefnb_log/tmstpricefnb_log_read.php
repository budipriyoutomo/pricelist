

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper"> 
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Tmstpricefnb_log 
        <small>Read Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tmstpricefnb_log </li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
	      <div class="row">
        <div class="col-xs-12">
        

          <div class="box">
            <div class="box-header">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
	
        
        <table class="table">
	    <tr><td>Iditem</td><td><?php echo $iditem; ?></td></tr>
	    <tr><td>Convert</td><td><?php echo $convert; ?></td></tr>
	    <tr><td>User</td><td><?php echo $user; ?></td></tr>
	    <tr><td>Aksi</td><td><?php echo $aksi; ?></td></tr>
	    <tr><td>Daterecord</td><td><?php echo $daterecord; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tmstpricefnb_log') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>

	</div>
            <!-- /.box-body -->    
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->        
	  </div>
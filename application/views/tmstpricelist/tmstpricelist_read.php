

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper"> 
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Tmstpricelist 
        <small>Read Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tmstpricelist </li>
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
	    <tr><td>Packaging</td><td><?php echo $packaging; ?></td></tr>
	    <tr><td>Uom</td><td><?php echo $uom; ?></td></tr>
	    <tr><td>Size</td><td><?php echo $size; ?></td></tr>
	    <tr><td>Price</td><td><?php echo $price; ?></td></tr>
	    <tr><td>Source</td><td><?php echo $source; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tmstpricelist') ?>" class="btn btn-default">Cancel</a></td></tr>
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
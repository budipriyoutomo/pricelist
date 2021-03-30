

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper"> 
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Tmstpricefnb_log 
        <small>Update/Create Data</small>
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
	
		
        
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Iditem <?php echo form_error('iditem') ?></label>
            <input type="text" class="form-control" name="iditem" id="iditem" placeholder="Iditem" value="<?php echo $iditem; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Convert <?php echo form_error('convert') ?></label>
            <input type="text" class="form-control" name="convert" id="convert" placeholder="Convert" value="<?php echo $convert; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">User <?php echo form_error('user') ?></label>
            <input type="text" class="form-control" name="user" id="user" placeholder="User" value="<?php echo $user; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Aksi <?php echo form_error('aksi') ?></label>
            <input type="text" class="form-control" name="aksi" id="aksi" placeholder="Aksi" value="<?php echo $aksi; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Daterecord <?php echo form_error('daterecord') ?></label>
            <input type="text" class="form-control" name="daterecord" id="daterecord" placeholder="Daterecord" value="<?php echo $daterecord; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tmstpricefnb_log') ?>" class="btn btn-default">Cancel</a>
	</form>
    
	
			</div>
            <!-- /.box-body -->    
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  </div>
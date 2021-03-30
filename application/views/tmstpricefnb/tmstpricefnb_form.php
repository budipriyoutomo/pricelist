

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Convertion FnB
        <small>Update/Create Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Convertion FnB </li>
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
          <label for="smallint">Item<?php echo form_error('iditem') ?></label>
          <select class='form-control select2' style='width: 100%;' name='iditem' id='iditem'  onchange="getdetail('this')">
              <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
            <?php
                        foreach ($iditem as $item) {
                ?>

                  <option value="<?php echo $item->id; ?>" ><?php echo $item->code ." | ".$item->desc  ?></option>

                            <?php
                        }
              ?>
          </select>
        </div>

	      <div class="form-group">
        <label for="smallint">Conversion Type<?php echo form_error('convert') ?></label>
        <select class='form-control select2' style='width: 100%;' name='convert' id='convert'  onchange="getdetail('this')">
            <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
          <?php
                      foreach ($convert as $con) {
              ?>

                <option value="<?php echo $con->id; ?>" ><?php echo $con->uombefore ." To ".$con->uomafter ." ". $con->conversion ?></option>

                          <?php
                      }
            ?>
        </select>
      </div>


	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('tmstpricefnb') ?>" class="btn btn-default">Cancel</a>
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



  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Conversion
        <small>Update/Create Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Conversion </li>
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
          <label for="varchar">Conversion From<?php echo form_error('Uombefore') ?></label>
          <select class='form-control select2' style='width: 100%;' name='uombefore' id='uombefore' onchange="getdetail('this')">
              <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
            <?php
                        foreach ($uombefore as $uombef) {
                ?>

                  <option value="<?php echo $uombef->id; ?>" ><?php echo $uombef->uom ?></option>

                            <?php
                        }
              ?>
          </select>
        </div>
        <div class="form-group">
        <label for="varchar">Conversion To <?php echo form_error('Uomafter') ?></label>
        <select class='form-control select2' style='width: 100%;' name='uomafter' id='uomafter' onchange="getdetail('this')">
            <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
          <?php
                      foreach ($uomafter as $uomaf) {
              ?>

                <option value="<?php echo $uomaf->id; ?>" ><?php echo $uomaf->uom ?></option>

                          <?php
                      }
            ?>
        </select>
      </div>
	    <div class="form-group">
            <label for="float">Conversion <?php echo form_error('conversion') ?></label>
            <input type="text" class="form-control" name="conversion" id="conversion" placeholder="Conversion" value="<?php echo $conversion; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('tmstconversion') ?>" class="btn btn-default">Cancel</a>
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



  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Tmstpricelist
        <small>Update/Create Data</small>
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



        <form action="<?php echo $action; ?>" method="post">
          <div class="form-group">
          <label for="varchar">Item <?php echo form_error('iditem') ?></label>
          <select class='form-control select2' style='width: 100%;' name='iditem' id='iditem' onchange="getdetail('this')">
              <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
            <?php
                        foreach ($iditem as $item) {
                ?>

                  <option value="<?php echo $item->id; ?>" ><?php echo $item->code ." | ".  $item->desc ?></option>

                            <?php
                        }
              ?>
          </select>
        </div>

        <div class="form-group">
        <label for="varchar">Packaging<?php echo form_error('packaging') ?></label>
        <select class='form-control select2' style='width: 100%;' name='packaging' id='packaging' onchange="getdetail('this')">
            <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
          <?php
                      foreach ($packaging as $pack) {
              ?>

                <option value="<?php echo $pack->id; ?>" ><?php echo $pack->packaging ?></option>

                          <?php
                      }
            ?>
        </select>
      </div>

        <div class="form-group">
        <label for="varchar">Unit Of Measure<?php echo form_error('uom') ?></label>
        <select class='form-control select2' style='width: 100%;' name='uom' id='uom'  onchange="getdetail('this')">
            <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
          <?php
                      foreach ($uom as $uom1) {
              ?>

                <option value="<?php echo $uom1->id; ?>" ><?php echo $uom1->uom ?></option>

                          <?php
                      }
            ?>
        </select>
      </div>

	    <div class="form-group">
            <label for="float">Size <?php echo form_error('size') ?></label>
            <input type="text" class="form-control" name="size" id="size" placeholder="Size" value="<?php echo $size; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Price <?php echo form_error('price') ?></label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" />
        </div>
        <div class="form-group">
        <label for="varchar">Source<?php echo form_error('source') ?></label>
        <select class='form-control select2' style='width: 100%;' name='source' id='source' onchange="getdetail('this')">
            <option selected ="selected" value="<?php echo 0; ?>" ><?php echo "" ?></option>
          <?php
                      foreach ($source as $src) {
              ?>

                <option value="<?php echo $src->id; ?>" ><?php echo $src->source ?></option>

                          <?php
                      }
            ?>
        </select>
      </div>

	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('tmstpricelist') ?>" class="btn btn-default">Cancel</a>
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

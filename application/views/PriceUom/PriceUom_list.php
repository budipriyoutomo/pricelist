

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Price By UoM
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Price By UoM </li>
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

        <div class="row" style="margin-bottom: 10px">

        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>

		    <th>Code</th>
		    <th>Desc</th>
        <th>UoM</th>
		    <th>Price UoM</th>

                </tr>
            </thead>

        </table>
		<div class="row" style="margin-bottom: 10px">

            <div class="col-md-6">


		<?php echo anchor(site_url('priceuom/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('priceuom/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-info btn-sm"'); ?>
	    </div>
</div>


			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

		</section>
		</div>

        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "PriceUom/json", "type": "POST"},
                    columns: [
                        {"data": "code"},{"data": "desc"},{"data": "uomafter"},{"data": "priceuom"}

                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>

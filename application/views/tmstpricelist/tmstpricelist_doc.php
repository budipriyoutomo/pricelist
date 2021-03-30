<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tmstpricelist List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Iditem</th>
		<th>Packaging</th>
		<th>Uom</th>
		<th>Size</th>
		<th>Price</th>
		<th>Source</th>
		
            </tr><?php
            foreach ($tmstpricelist_data as $tmstpricelist)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tmstpricelist->iditem ?></td>
		      <td><?php echo $tmstpricelist->packaging ?></td>
		      <td><?php echo $tmstpricelist->uom ?></td>
		      <td><?php echo $tmstpricelist->size ?></td>
		      <td><?php echo $tmstpricelist->price ?></td>
		      <td><?php echo $tmstpricelist->source ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
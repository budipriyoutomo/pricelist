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
        <h2>Tmstpricefnb List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Iditem</th>
		<th>Convert</th>
		
            </tr><?php
            foreach ($tmstpricefnb_data as $tmstpricefnb)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tmstpricefnb->iditem ?></td>
		      <td><?php echo $tmstpricefnb->convert ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
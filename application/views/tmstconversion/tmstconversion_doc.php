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
        <h2>Tmstconversion List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Uombefore</th>
		<th>Uomafter</th>
		<th>Conversion</th>
		
            </tr><?php
            foreach ($tmstconversion_data as $tmstconversion)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tmstconversion->uombefore ?></td>
		      <td><?php echo $tmstconversion->uomafter ?></td>
		      <td><?php echo $tmstconversion->conversion ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
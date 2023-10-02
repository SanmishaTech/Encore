<?php
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            @page {
                margin: 30px 35px;
                footer: html_myFooter;
            }
            body {
                font-family:  serif;
                font-size: 14px;
            }
            h3 {
                text-align: center;
                margin-bottom: 0;
            }
            table{
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            tr:nth-child(even) {
                background-color: #dddddd;
            }
            p {
                margin-top: 5px;
                margin-bottom: 5px;
            }
            .tr{
                border:none;
            }
            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
            }           
        </style>
    </head>
    <body>
        <htmlpagefooter name="myFooter">            
    	</htmlpagefooter>
        <br> <br> <br>
        <div>
            <h2 align="center"><strong> Invoice </strong></h2>
        </div>	
		<br>
        <table style="border:none;">
            <tr style="border:none;">
                <th>Invoice No: </th>
                <td style="text-align:left"><?php echo e($invoice->invoice_no); ?></td>
            </tr>
            <tr style="border:none;">
                <th>Invoice Date: </th>
                <td style="text-align:left"><?php echo e($invoice->invoice_date); ?></td>
            </tr>
            <tr style="border:none;">
                <th>Client Name: </th>
                <td style="text-align:left"><?php echo e($invoice->client->client_name); ?></td>
            </tr>
        </table>
        <br>
        <div>
            <h2 align="center"><strong> Services </strong></h2>
        </div>
        <table width="100%" cellpadding="5">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <?php $__currentLoopData = $invoice->InvoiceDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tbody>
                <tr>
                    <td><?php echo e($detail->service_id); ?></td>
                    <td><?php echo e($detail->cost); ?></td>
                </tr>                
            </tbody>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
                <tr>
                    <th colspan="2">Total Cost: </th>
                    <td><?php echo e($invoice->total_cost); ?></td>
                </tr>  
                <tr>
                    <th colspan="2">Discount Amount: </th>
                    <td><?php echo e($invoice->dis_amt); ?></td>
                </tr>
                <tr>
                    <th colspan="2">Igst Amount (10%): </th>
                    <td><?php echo e($invoice->igst_amt); ?></td>
                </tr>  
                <tr>
                    <th colspan="2">Total Amount: </th>
                    <td><?php echo e($invoice->total_amt); ?></td>
                </tr>
            </tfoot>   
        </table>
        <br>
        <div class="footer">
            <hr>
             <p style="text-align:right"> <?php echo Carbon::now(); ?></p>
        </div>
    </body>
</html><?php /**PATH C:\Users\HP\Project\TeamPulse\resources\views/invoices/print.blade.php ENDPATH**/ ?>
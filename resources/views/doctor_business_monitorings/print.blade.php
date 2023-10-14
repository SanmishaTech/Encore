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
        <div class="table-responsive">
            <htmlpagefooter name="myFooter">            
            </htmlpagefooter>
            <br> <br> <br>
            <div>
                <h2 align="center"><strong> Grant Approval Format (GAF) - Report</strong></h2>
            </div>
            <br>
            <table>
                <thead >
                    <tr>
                        <th>ME HQ: </th>
                        <th>ABM HQ: </th>
                        <th>RBM HQ: </th>
                        <th>Doctor Name: </th>
                        <th>Speciality: </th>
                        <th>Location: </th>
                        <th>Date: </th>
                        <th>Month: </th>
                        <th>Amount: </th>
                    </tr>
                </thead>
                <tbody>
                        @if(!empty($doctor_business_monitorings))
                        @foreach($doctor_business_monitorings as $doctor_business_monitoring)                           
                            <tr>
                                <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->name }}</td>           
                                <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->AreaManager->name }}</td>
                                <td>{{ @$doctor_business_monitoring->GrantApproval->Manager->ZonalManager->name }}</td>
                                <td>{{ @$doctor_business_monitoring->GrantApproval->Doctor->doctor_name }}</td>
                                <td>{{ @$doctor_business_monitoring->GrantApproval->Doctor->speciality }}</td>
                                <td>{{ @$doctor_business_monitoring->GrantApproval->Doctor->type }}</td>
                                <td>{{ @$doctor_business_monitoring->date }}</td>
                                <td>{{ @$doctor_business_monitoring->month }}</td>
                                <td>{{ @$doctor_business_monitoring->amount }}</td>
                            </tr>
                        @endforeach
                        @endif
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>NRV</th>
                        <th>M Exp in Vol</th>
                        <th>M + 1 Exp in Vol</th>
                        <th>M + 2 Exp in Vol</th>
                        <th>M + 3 Exp in Vol</th>
                        <th>M + 4 Exp in Vol</th>
                        <th>M + 5 Exp in Vol</th>
                        <th>M + 6 Exp in Vol</th>
                        <th>Total M to M + 6 Exp Vol</th>
                        <th>Total M to M + 6 Exp Val</th>
                        <th>Scheme %</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($doctor_business_monitoring['ProductDetails']))
                        
                        @foreach($doctor_business_monitoring['ProductDetails'] as $id=>$detail)   
                                       
                            <tr>
                                <td>{{ @$detail->product_id }}</td>           
                                <td>{{ @$detail->nrv }}</td>
                                <td>{{ @$detail->avg_business_units}}</td>
                                <td>{{ @$detail->avg_business_value }}</td>
                                <td>{{ @$detail->exp_vol }}</td>
                                <td>{{ @$detail->exp_vol_1 }}</td>
                                <td>{{ @$detail->exp_vol_2 }}</td>
                                <td>{{ @$detail->exp_vol_3 }}</td>
                                <td>{{ @$detail->exp_vol_4 }}</td>
                                <td>{{ @$detail->exp_vol_5 }}</td>
                                <td>{{ @$detail->exp_vol_6 }}</td>
                                <td>{{ @$detail->total_exp_vol }}</td>
                                <td>{{ @$detail->total_exp_val }}</td>
                                <td>{{ @$detail->scheme }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="footer">
                <hr>
                <p style="text-align:right"> <?php echo Carbon::now(); ?></p>
            </div>
        </div>
        
    </body>
</html>
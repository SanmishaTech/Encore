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
                        <th>MPL No: </th>
                        <th>Location: </th>
                        <th>Email: </th>
                        <th>Activity: </th>
                        <th>Date: </th>
                        <th>Month: </th>
                        <th>Amount: </th>
                    </tr>
                </thead>
                <tbody>
                        @if(!empty($grant_approval))
                        @foreach($grant_approval as $detail)                           
                            <tr>
                                <td>{{ ucfirst(@$detail->Manager->name) }}</td>
                                <td>{{ ucfirst(@$detail->Manager->AreaManager->name) }}</td>
                                <td>{{ ucfirst(@$detail->Manager->ZonalManager->name) }}</td>
                                <td>{{ ucfirst(@$detail->Doctor->doctor_name) }}</td>
                                <td>{{ @$detail->doctor->speciality }}</td>
                                <td>{{ @$detail->doctor->mpl_no }}</td>                
                                <td>{{ @$detail->doctor->type }}</td>
                                <td>{{ @$detail->email }}</td>
                                <td>{{ ucfirst(@$detail->Activity->name) }}</td>
                                <td>{{ @$detail->date_of_issue }}</td>
                                <td>{{ @$detail->proposal_month }}</td>
                                <td>{{ @$detail->proposal_amount }}</td>
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
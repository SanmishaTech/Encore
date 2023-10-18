<?php
use Carbon\Carbon;
?>

    <table>
        <thead >
            <tr>
                <th colspan="21" style="font-weight: bold; text-align: center;">Core Doctor Business Monitoring (CDBM)</th>
            </tr>
            <tr>
                <th>ME HQ </th>
                <th>ABM HQ </th>
                <th>RBM HQ </th>
                <th>Doctor Name </th>
                <th>Speciality </th>
                <th>Location </th>
                <th>Date </th>
                <th>Month </th>
                <th>Amount </th>
                <th>Product</th>
                <th>NRV</th>
                <th>M Exp in Vol</th>
                <th>M1 Exp in Vol</th>
                <th>M2 Exp in Vol</th>
                <th>M3 Exp in Vol</th>
                <th>M4 Exp in Vol</th>
                <th>M5 Exp in Vol</th>
                <th>M6 Exp in Vol</th>
                <th>Total Exp Vol</th>
                <th>Total Exp Val</th>
                <th>Scheme</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($print))
            @foreach($print as $detail)                           
                <tr>
                    <td>{{ @$detail->DoctorBusinessMonitoring->GrantApproval->Manager->name }}</td>           
                    <td>{{ @$detail->DoctorBusinessMonitoring->GrantApproval->Manager->AreaManager->name }}</td>
                    <td>{{ @$detail->DoctorBusinessMonitoring->GrantApproval->Manager->ZonalManager->name }}</td>
                    <td>{{ @$detail->DoctorBusinessMonitoring->GrantApproval->Doctor->doctor_name }}</td>
                    <td>{{ @$detail->DoctorBusinessMonitoring->GrantApproval->Doctor->speciality }}</td>
                    <td>{{ @$detail->DoctorBusinessMonitoring->GrantApproval->Doctor->type }}</td>
                    <td>{{ @$detail->DoctorBusinessMonitoring->date }}</td>
                    <td>{{ @$detail->DoctorBusinessMonitoring->month }}</td>
                    <td>{{ @$detail->DoctorBusinessMonitoring->amount }}</td>
                    <td>{{ @$detail->Product->name }}</td>           
                    <td>{{ @$detail->Product->nrv }}</td>
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
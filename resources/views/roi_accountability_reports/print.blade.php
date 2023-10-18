<?php
use Carbon\Carbon;
?>
<table>
    	
    <thead >
        <tr>
            <th colspan="15" style="font-weight: bold; text-align: center;">ROI Accountability Report (RAR)</th>
        </tr>
        <tr>
            <th>ME HQ</th>
            <th>ABM HQ</th>
            <th>RBM HQ</th>
            <th>Doctor Name</th>
            <th>Speciality</th>
            <th>Location</th>
            <th>Date</th>
            <th>Proposal Month</th>
            <th>Amount</th>
            <th>Product</th>
            <th>NRV</th>
            <th>Month</th>
            <th>Exp Vol</th>
            <th>Exp Val</th>
            <th>Scheme</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($print))
        @foreach($print as $detail)                           
            <tr>
                <td>{{ @$detail->RoiAccountabilityReport->GrantApproval->Manager->name }}</td>           
                <td>{{ @$detail->RoiAccountabilityReport->GrantApproval->Manager->AreaManager->name }}</td>
                <td>{{ @$detail->RoiAccountabilityReport->GrantApproval->Manager->ZonalManager->name }}</td>
                <td>{{ @$detail->RoiAccountabilityReport->GrantApproval->Doctor->doctor_name }}</td>
                <td>{{ @$detail->RoiAccountabilityReport->GrantApproval->Doctor->speciality }}</td>
                <td>{{ @$detail->RoiAccountabilityReport->GrantApproval->Doctor->type }}</td>
                <td>{{ @$detail->RoiAccountabilityReport->rar_date }}</td>
                <td>{{ @$detail->RoiAccountabilityReport->proposal_month }}</td>
                <td>{{ @$detail->RoiAccountabilityReport->amount }}</td>
                <td>{{ @$detail->Product->name }}</td>           
                <td>{{ @$detail->Product->nrv }}</td>
                <td>{{ @$detail->month }}</td>
                <td>{{ @$detail->exp_vol }}</td>
                <td>{{ @$detail->exp_val }}</td>
                <td>{{ @$detail->scheme }}</td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
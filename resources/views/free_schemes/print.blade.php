<?php
use Carbon\Carbon;
?>

    <table>
        <thead >
            <tr>
                <th colspan="12" style="font-weight: bold; text-align: center;">Free Schemes - Report</th>
            </tr>
            <tr>
                <th>ME HQ: </th>
                <th>ABM HQ: </th>
                <th>RBM HQ: </th>
                <th>Doctor Name: </th>
                <th>Stockist: </th>
                <th>Chemist: </th>
                <th>Speciality: </th>
                <th>Doctor Type: </th>
                <th>Location: </th>
                <th>Product: </th>
                <th>NRV: </th>
                <th>Quantity: </th>
                <th>Free: </th>
                <th>Date: </th>
                <th>Month: </th>
                <th>Amount: </th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($print))
            @foreach($print as $detail)                           
            <tr>
                <td>{{ @$detail->FreeScheme->Manager->name }}</td>
                <td>{{ @$detail->FreeScheme->Manager->AreaManager->name }}</td>
                <td>{{ @$detail->FreeScheme->Manager->ZonalManager->name }}</td>
                <td>{{ ucfirst(@$detail->FreeScheme->Doctor->doctor_name) }}</td>
                <td>{{ @$detail->FreeScheme->Stockist->stockist }}</td>
                <td>{{ @$detail->FreeScheme->Chemist->chemist }}</td>
                <td>{{ @$detail->FreeScheme->doctor->speciality }}</td>
                <td>{{ @$detail->FreeScheme->doctor->type }}</td>
                <td>{{ @$detail->FreeScheme->location }}</td>                
                <td>{{ @$detail->Product->name }}</td>      
                <td>{{ @$detail->nrv }}</td>      
                <td>{{ @$detail->qty }}</td>                
                <td>{{ @$detail->free }}</td>                          
                <td>{{ @$detail->FreeScheme->proposal_date }}</td>
                <td>{{ @$detail->FreeScheme->proposal_month }}</td>
                <td>{{ @$detail->FreeScheme->amount }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
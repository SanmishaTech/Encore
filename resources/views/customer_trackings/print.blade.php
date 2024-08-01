<?php
use Carbon\Carbon;
?>

    <table>
        <thead >
            <tr>
                <th colspan="12" style="font-weight: bold; text-align: center;">Customer Tracking - Report</th>
            </tr>
            <tr>
                <th>ME HQ: </th>
                <th>ABM HQ: </th>
                <th>ZBM HQ: </th>
                <th>Doctor: </th>
                <th>Date: </th>
                <th>Month: </th>
                <th>Primary: </th>
                <th>Secondary: </th>
                <th>Doctor: </th>
                <th>Speciality: </th>
                <th>Location: </th>
                <th>Product: </th>
                <th>NRV: </th>
                <th>Quantity: </th>
                <th>Amount: </th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($print))
            @foreach($print as $detail)                           
            <tr>
                <td>{{ @$detail->CustomerTracking->Manager->name }}</td>
                <td>{{ @$detail->CustomerTracking->Manager->AreaManager->name }}</td>
                <td>{{ @$detail->CustomerTracking->Manager->ZonalManager->name }}</td>
                <td>{{ @$detail->Doctor->doctor_name }}</td>
                <td>{{ @$detail->CustomerTracking->proposal_date }}</td>
                <td>{{ @$detail->CustomerTracking->proposal_month }}</td>
                <td>{{ @$detail->CustomerTracking->primary }}</td>
                <td>{{ @$detail->CustomerTracking->secondary }}</td>
                <td>{{ ucfirst(@$detail->Doctor->doctor_name) }}</td>
                <td>{{ ucfirst(@$detail->Doctor->speciality) }}</td>
                <td>{{ ucfirst(@$detail->location) }}</td>
                <td>{{ ucfirst(@$detail->Product->name) }}</td>
                <td>{{ ucfirst(@$detail->nrv) }}</td>
                <td>{{ ucfirst(@$detail->qty) }}</td>
                <td>{{ @$detail->CustomerTracking->amount }}</td>

                {{-- <td>{{ @$detail->CustomerTracking->doctor->speciality }}</td>
                <td>{{ @$detail->FreeScheme->doctor->type }}</td>
                <td>{{ @$detail->FreeScheme->location }}</td>                
                <td>{{ @$detail->CustomerTracking->amount }}</td> --}}
                {{--  --}}
                {{-- <td>{{ @$detail->nrv }}</td>      
                <td>{{ @$detail->qty }}</td>                
                <td>{{ @$detail->free }}</td>                          
                <td>{{ @$detail->FreeScheme->proposal_date }}</td>
                <td>{{ @$detail->FreeScheme->proposal_month }}</td>
                <td>{{ @$detail->FreeScheme->amount }}</td> --}}
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .container {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        margin-bottom: 20px;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        border-top: 1px solid #ddd;
        text-align: left;
    }
    .notes {
        margin-top: 20px;
        font-style: italic;
    }
    .total {
        font-weight: bold;
        text-align: right;
        margin-top: 10px;
    }
</style>
</head>
<body>

<div class="container">

<h2>Core Doctor Business Monitoring Details</h2>

<table>
    <tbody>
        <tr>
            <th>Marketing Executive:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->GrantApproval->Manager->name }}</td>
        </tr>
        <tr>
            <th>Area Manager:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->GrantApproval->Manager->AreaManager->name }}</td>
        </tr>
        <tr>
            <th>Zonal Manager:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->GrantApproval->Manager->ZonalManager->name }}</td>
        </tr>
        <tr>
            <th>Doctor:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->GrantApproval->Doctor->doctor_name }}</td>
        </tr>
        <tr>
            <th>Speciality:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->GrantApproval->Doctor->speciality }}</td>
        </tr>
        <tr>
            <th>Location:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->GrantApproval->Doctor->type }}</td>
        </tr>
        <tr>
            <th>Date:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->date }}</td>
        </tr>
        <tr>
            <th>Proposal Month:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->month }}</td>
        </tr>
        <tr>
            <th>Amount:</th>
            <td>{{ @$print[0]->DoctorBusinessMonitoring->amount }}</td>
        </tr>
    </tbody>
</table>


<table>
    <thead>
        <tr>
            <th>Products:</th>
            <th>NRV:</th>
            <th>M Exp in Vol</th>
            <th>M1 Exp in Vol</th>
            <th>M2 Exp in Vol</th>
            <th>M3 Exp in Vol</th>
            <th>M4 Exp in Vol</th>
            <th>M5 Exp in Vol</th>
            <th>M6 Exp in Vol</th>
            <th>Total Exp Vol</th>
            <th>Total Exp Val</th>
            <th>Scheme %</th>
        </tr>
        <tbody>
            @if(!empty($print))
            @foreach($print as $detail)    
            <tr>
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
                <td>{{ @$detail->scheme }}%</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </thead>
</table>     

<p class="total">Total Amount: ₹{{ @$print[0]->DoctorBusinessMonitoring->amount }}</p>

</div>

</body>
</html>

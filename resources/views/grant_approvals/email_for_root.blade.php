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

<h2>Grant Approval Details</h2>

<table>
    <tbody>
        <tr>
            <th>Code:</th>
            <td>{{ @$print[0]->code }}</td>
        </tr>
        <tr>
            <th>Marketing Executive:</th>
            <td>{{ @$print[0]->Manager->name }}</td>
        </tr>
        <tr>
            <th>Area Manager:</th>
            <td>{{ @$print[0]->Manager->AreaManager->name }}</td>
        </tr>
        <tr>
            <th>Zonal Manager:</th>
            <td>{{ @$print[0]->Manager->ZonalManager->name }}</td>
        </tr>
        <tr>
            <th>Doctor:</th>
            <td>{{ @$print[0]->Doctor->doctor_name }}</td>
        </tr>
        <tr>
            <th>Speciality:</th>
            <td>{{ @$print[0]->doctor->speciality }}</td>
        </tr>
        <tr>
            <th>MPL Number:</th>
            <td>{{ @$print[0]->doctor->mpl_no }}</td>
        </tr>
        <tr>
            <th>Doctor Type:</th>
            <td>{{ @$print[0]->doctor->type }}</td>
        </tr>
        <tr>
            <th>City:</th>
            <td>{{ @$print[0]->doctor->city }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ @$print[0]->email }}</td>
        </tr>
        <tr>
            <th>Contact Number:</th>
            <td>{{ @$print[0]->contact_no }}</td>
        </tr>
        <tr>
            <th>Activity:</th>
            <td>{{ @$print[0]->Activity->name }}</td>
        </tr>
        <tr>
            <th>Date:</th>
            <td>{{ @$print[0]->date_of_issue }}</td>
        </tr>
        <tr>
            <th>Proposal Month:</th>
            <td>{{ @$print[0]->proposal_month }}</td>
        </tr>
        <tr>
            <th>Proposal Amount:</th>
            <td>{{ @$print[0]->proposal_amount }}</td>
        </tr>
        <tr>
            <th>Approval Amount:</th>
            <td>{{ @$print[0]->approval_amount }}</td>
        </tr>
        <tr>
            <th>Remark:</th>
            <td>{{ @$print[0]->remark }}</td>
        </tr>
    </tbody>
</table>



</div>

</body>
</html>

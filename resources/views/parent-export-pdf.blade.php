<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parents DataTable</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        . {
            margin: 0;
            padding: 10;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1em;
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            text-align: left;
        }

        th,
        td {
            padding: 12px 15px;
        }

        thead tr {
            color: #282525;
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 5%;
            text-align: center;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 20%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 25%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 15%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 5%;
            text-align: center;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 10%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 10%;
        }

        th:nth-child(8),
        td:nth-child(8) {
            margin-left: 2px;
            width: 5%;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="text-center font-weight-bold mx-3">Parent Data Table</h1>
    <table id="myTable" class="table table-stripped" width="100%" style="table-layout:fixed;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Age</th>
                <th>Class</th>
                <th>Job</th>
                <th>Child</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($parents as $parent)
                <tr>
                    <td>{{ $parent->id }}</td>
                    <td>{{ $parent->name }}</td>
                    <td>{{ $parent->email }}</td>
                    <td>{{ $parent->birth }}</td>
                    <td>{{ $parent->age() }}</td>
                    <td>{{ $parent->classification }}</td>
                    <td>{{ $parent->job }}</td>
                    <td>{{ count($parent->children) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Children</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/v/bs4/dt-2.1.3/datatables.min.css" rel="stylesheet">
</head>

<body>
    <div class="container p-5">
        <table id="myTable" class="table table-stripped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/v/bs4/dt-2.1.3/datatables.min.js"></script>

    <script>
        var childId = @json($id);
        var url = '{{ route('getDataChild', ':id') }}'
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: url.replace(':id', childId),
                columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'first_name',
                    name: 'first_name'
                }, {
                    data: 'last_name',
                    name: 'last_name'
                }]
            });
        });
    </script>
</body>

</html>

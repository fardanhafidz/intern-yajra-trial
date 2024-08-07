<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parents DataTable</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/v/bs4/dt-2.1.3/datatables.min.css" rel="stylesheet">
</head>

<body>
    <div class="container p-5">
        <div class="col-2 category-filter mb-3 d-flex justify-content-between">
            <div class="d-flex flex-row">
                <select id="filterByJob" style="width: 200px" class="form-control">
                    <option selected disabled value="">Filter by Job</option>
                    @foreach ($jobs as $job)
                        <option value="{{ $job }}">{{ $job }}</option>
                    @endforeach
                </select>
                <select id="filterByClass" style="width: 200px" class="form-control">
                    <option selected disabled value="">Filter by Class</option>
                    <option value="Bayi">Bayi</option>
                    <option value="Balita">Balita</option>
                    <option value="Anak-anak">Anak-anak</option>
                    <option value="Remaja">Remaja</option>
                    <option value="Dewasa Muda">Dewasa Muda</option>
                    <option value="Dewasa">Dewasa</option>
                    <option value="Lansia">Lansia</option>
                </select>
                <button id="formChanged" class="btn btn-primary">Filter</button>
            </div>
            <div class="d-flex flex-row">
                <button id="exportPdf" class="btn btn-secondary mx-1">PDF</button>
                <button id="exportExcel" class="btn btn-secondary mx-1">Excel</button>
            </div>

        </div>
        <table id="myTable" class="table table-stripped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>Class</th>
                    <th>Job</th>
                    <th>Child</th>
                    <th>Action</th>
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

    <script></script>
    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('data') }}',
                    data: function(d) {
                        d.filterByJob = $('#filterByJob').val()
                        d.filterByClass = $('#filterByClass').val()
                    }
                },
                columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'image',
                    name: 'image'
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'email',
                    name: 'email'
                }, {
                    data: 'birth',
                    name: 'birth'
                }, {
                    data: 'age',
                    name: 'age'
                }, {
                    data: 'class',
                    name: 'class'
                }, {
                    data: 'job',
                    name: 'job'
                }, {
                    data: 'child',
                    name: 'child'
                }, {
                    data: 'action',
                    name: 'action'
                }]
            });
            $('#formChanged').click('submit', function() {
                table.draw();
            });
            $('#exportPdf').click(function(e) {
                e.preventDefault();
                var filterByJob = $('#filterByJob').val() ?? '';
                var filterByClass = $('#filterByClass').val() ?? '';
                var url = '{{ route('exportPdf') }}?filterByJob=' + filterByJob + '&filterByClass=' +
                    filterByClass;

                window.location.href = url;
            });
        });
    </script>
</body>

</html>

@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Report List DonorShopper')

<!-- Styles -->
@section('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <style>
    </style>
@stop

<!-- Content -->
@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @enderror
    <!--Total Numbers-->
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Donor/Shopper</h3>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Number of
                                    User</span></div>
                            <div id="totalUser" class="text-dark fw-bold h5 mb-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Number of
                                    User (This Month)</span></div>
                            <div id="totalUsermonth" class="text-dark fw-bold h5 mb-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-info py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Total Number of User
                                    (This Year)</span></div>
                            <div class="row g-0 align-items-center">
                                <div class="col-auto">
                                    <div id="totalUseryear" class="text-dark fw-bold h5 mb-0 me-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Chart-->
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary fw-bold m-0">Monthly Graph</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="monthlyGraph" height="320"
                            style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary fw-bold m-0">Annually Graph</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="annuallyGraph" height="320"
                            style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!--DataList of Donor/Shopper-->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary">Donor/Shopper</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover table-bordered pt-3 display" id="listUsertable" style="">
                    <thead class="thead-light">
                        <tr>
                            <th>ID No.</th>
                            <th>Email</th>
                            <th>Full Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

<!-- Scripts -->
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js">
    </script>
    <script>
        //Datatables
        $(document).ready(function() {
            $('table.display').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script type="module">
    //Initialize Firebase
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
    import { getDatabase, ref, onValue } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-database.js';
    import { setImage } from './js/firebasehelper.js';
    const firebaseConfig = {
        apiKey: "AIzaSyDrQnBzhOFfjrIqmOUabkt14wvx-LVnzug",
        authDomain: "sharity-f983e.firebaseapp.com",
        databaseURL: "https://sharity-f983e-default-rtdb.firebaseio.com",
        projectId: "sharity-f983e",
        storageBucket: "sharity-f983e.appspot.com",
        messagingSenderId: "599803730946",
        appId: "1:599803730946:web:e7ebe55992577653831b1b",
        measurementId: "G-2NTKV2NYYB"
    };

        const app = initializeApp(firebaseConfig);
        const database = getDatabase(app);

        //Read Charities
        const user = ref(database, 'User/DonorShopper/');

        onValue(user, (snapshot) => {
            //Data
            const data = snapshot.val();

            //List Table
            var listUsertable = $('#listUsertable').DataTable();
            listUsertable.clear().draw();

            var totalUsers=0, totalmonth=0, totalyear=0;
            var date = new Date();
            var dateMonth = date.getMonth();
            var dateYear = date.getFullYear();

            for (var key in data) {
                //List Table
                if(data[key]['status'] != 'Pending'){
                    listUsertable.row.add([
                        data[key]['id'],
                        data[key]['email'],
                        data[key]['firstName']+[' ']+data[key]['lastName'],
                        data[key]['status']
                    ]).node().id = data[key]['id'];
                    listUsertable.draw(false);

                    totalUsers++;
                }
                document.getElementById("totalUser").innerHTML = totalUsers;

                 //Get Monthly
                var listedDate = new Date(data[key]['dor']);
                var newlistedMonth = listedDate.getMonth();
                var newlistedYear = listedDate.getFullYear();

                if(data[key]['status'] != 'Pending' && dateMonth == newlistedMonth){
                    totalmonth++;
                }
                document.getElementById("totalUsermonth").innerHTML = totalmonth;

                if(data[key]['status'] != 'Pending' && dateYear == newlistedYear){
                    totalyear++;
                }
                document.getElementById("totalUseryear").innerHTML = totalyear;
            }

            //Monthly Graph Condition
            var janMonth=0, febMonth=0,marMonth=0,aprMonth=0,mayMonth=0,junMonth=0,julMonth=0,augMonth=0,septMonth=0,octMonth=0,novMonth=0,decMonth=0;
            for(var key in data)
            {
                var dateMonth = new Date(data[key]['dor']);
                var newdateMonth = dateMonth.getMonth()+1;

                    switch(newdateMonth)
                    {
                        case 1:
                            janMonth++;
                            break;
                        case 2:
                            febMonth++;
                            break;
                        case 3:
                            marMonth++;
                            break;
                        case 4:
                            aprMonth++;
                            break;
                        case 5:
                            mayMonth++;
                            break;
                        case 6:
                            junMonth++;
                            break;
                        case 7:
                            julMonth++;
                            break;
                        case 8:
                            augMonth++;
                            break;
                        case 9:
                            septMonth++;
                            break;
                        case 10:
                            octMonth++;
                            break;
                        case 11:
                            novMonth++;
                            break;
                        default:
                            decMonth++;
                            break
                    }
            }

            //Monthly Graph
            const barchart = document.getElementById('monthlyGraph').getContext('2d');
            const monthlyGraph = new Chart(barchart, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Number of User',
                        data: [janMonth, febMonth, marMonth, aprMonth, mayMonth, junMonth, julMonth,augMonth,septMonth,octMonth,novMonth,decMonth],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            //Annually
            var year2022=0, year2023=0,year2024=0,year2025=0,year2026=0;
            for(var key in data)
            {
                var dateYear = new Date(data[key]['dor']);
                var newdateYear = dateYear.getFullYear();

                    switch(newdateYear)
                    {
                        case 2022:
                            year2022++;
                            break;
                        case 2023:
                            year2023++;
                            break;
                        case 2024:
                            year2024++;
                            break;
                        case 2025:
                            year2025++;
                            break;
                        case 2026:
                            year2026++;
                            break;
                        default:
                            break;
                    }
            }
            const linechart = document.getElementById('annuallyGraph').getContext('2d');
            const annuallyGraph = new Chart(linechart, {
                type: 'line',
                data: {
                    labels: ['2022', '2023', '2024', '2025', '2026'],
                    datasets: [{
                        label: 'Number of User',
                        data: [year2022, year2023, year2024, year2025, year2026],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>
@stop

@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Report Sales')

<!-- Styles -->
@section('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
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
            <h3 class="text-dark mb-0">Sales</h3>
        </div>

        <!--Overview-->
        <div class="d-sm-flex p-2">
            <h5 class="text-dark mb-0">Overview</h5>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Number of Orders:</span></div>
                                <div id="totalnumOrder" class="totalnumOrder text-dark fw-bold h5 mb-0"></div>
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
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Number of Listed Items:</span></div>
                                <div id="totalnumProducts" class="totalnumProducts text-dark fw-bold h5 mb-0"></div>
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
                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Total Number of Sold Items</span></div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div id="totalnumSoldProducts" class="totalnumSoldProductstext-dark fw-bold h5 mb-0 me-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Earnings-->
        <div class="d-sm-flex p-2">
            <h5 class="text-dark mb-0">Overview Profits</h5>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Profits:</span></div>
                                <div id="totalProfit" class="totalProfit text-dark fw-bold h5 mb-0"></div>
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
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Profits (This Month)</span></div>
                                <div id="totalprofitmonth" class="totalprofitmonth text-dark fw-bold h5 mb-0"></div>
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
                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Total Profits(This Year)</span></div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div id="totalprofityear" class="totalprofityear text-dark fw-bold h5 mb-0"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Chart-->
        <div class="row p-2">
            <div class="col-lg-6 col-xl-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">Monthly Profit Graph</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="monthlyGraph" height="320" style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">Annually Profit Graph</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="annuallyGraph" height="320" style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                    </div>
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


    <script>
        $(document).ready(function() {
            $('table.display').DataTable();
        });
    </script>

    <!--Tables-->
    <script type="module">
        //Initialize Firebase
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
        import { getDatabase, ref, onValue } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-database.js';
        import { setImage, setLink } from './js/firebasehelper.js';
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

        //Read Purchases
        const purchases = ref(database, 'Purchases/');

        onValue(purchases, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Totals
            var totalpurchase = 0, total=0, totalProfitMonth=0, totalProfitYear=0;
            var date = new Date();
            var newdateMonth = date.getMonth();
            var newdateYear = date.getFullYear();


            for(var key in data)
            {
                if(data[key]['status'] == 'Complete'){
                    totalpurchase++;
                    total=total+data[key]['total'];
                }
                document.getElementById("totalnumOrder").innerHTML = totalpurchase;
                document.getElementById("totalProfit").innerHTML = total;

                var purchaseDate = new Date(data[key]['purchaseAt']);
                var newpurchaseMonth = purchaseDate.getMonth();
                var newpurchaseYear = purchaseDate.getFullYear();

                if(data[key]['status'] == 'Complete' && newdateMonth == newpurchaseMonth){
                    totalProfitMonth=totalProfitMonth+data[key]['total'];
                }
                document.getElementById("totalprofitmonth").innerHTML = totalProfitMonth;

                if(data[key]['status'] == 'Complete' && newdateYear == newpurchaseYear){
                    totalProfitYear=totalProfitYear+data[key]['total'];
                }
                document.getElementById("totalprofityear").innerHTML = totalProfitYear;
            }

            //Monthly Graph Condition
            var janMonth=0, febMonth=0,marMonth=0,aprMonth=0,mayMonth=0,junMonth=0,julMonth=0,augMonth=0,septMonth=0,octMonth=0,novMonth=0,decMonth=0;
            for(var key in data)
            {
                var dateMonth = new Date(data[key]['listedAt']);
                var newdateMonth = dateMonth.getMonth();
                var newYear = dateMonth.getFullYear();

                if(data[key]['status'] == 'Complete' && newYear == '2023'){

                    switch(newdateMonth)
                    {
                        case 1:
                            janMonth=janMonth+data[key]['total'];
                            break;
                        case 2:
                            febMonth=febMonth+data[key]['total'];
                            break;
                        case 3:
                            marMonth=marMonth+data[key]['total'];
                            break;
                        case 4:
                            aprMonth=aprMonth+data[key]['total'];
                            break;
                        case 5:
                            mayMonth=mayMonth+data[key]['total'];
                            break;
                        case 6:
                            junMonth=junMonth+data[key]['total'];
                            break;
                        case 7:
                            julMonth=julMonth+data[key]['total'];
                            break;
                        case 8:
                            augMonth=augMonth+data[key]['total'];
                            break;
                        case 9:
                            septMonth=septMonth+data[key]['total'];
                            break;
                        case 10:
                            octMonth=octMonth+data[key]['total'];
                            break;
                        case 11:
                            novMonth=novMonth+data[key]['total'];
                            break;
                        default:
                            decMonth=decMonth+data[key]['total'];
                            break
                    }
                }
            }

            //Monthly Graph
            const barchart = document.getElementById('monthlyGraph').getContext('2d');
            const monthlyGraph = new Chart(barchart, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Total Profit',
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
                var dateYear = new Date(data[key]['purchaseAt']);
                var newdateYear = dateYear.getFullYear();

                if(data[key]['status'] == 'Complete'){

                    switch(newdateYear)
                    {
                        case 2022:
                            year2022=year2022+data[key]['total'];
                            break;
                        case 2023:
                            year2023=year2023+data[key]['total'];
                            break;
                        case 2024:
                            year2024=year2024+data[key]['total'];
                            break;
                        case 2025:
                            year2025=year2025+data[key]['total'];
                            break;
                        case 2026:
                            year2026=year2026+data[key]['total'];
                            break;
                        default:
                            break;
                    }
                }
            }

            const linechart = document.getElementById('annuallyGraph').getContext('2d');
            const annuallyGraph = new Chart(linechart, {
                type: 'line',
                data: {
                    labels: ['2022', '2023', '2024', '2025', '2026'],
                    datasets: [{
                        label: 'Total Profit',
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

        //Read Products
        const products = ref(database, 'Products/');
        onValue(products, (snapshot) => {

            const data = snapshot.val();

            var totalProducts = 0, totalSoldProducts = 0;

            for(var key in data)
            {
                if(data[key]['status'] == 'Listed'){
                    totalProducts++;
                }
                document.getElementById("totalnumProducts").innerHTML = totalProducts;

                if(data[key]['status'] == 'Sold'){
                    totalSoldProducts++
                }
                document.getElementById("totalnumSoldProducts").innerHTML = totalSoldProducts;

            }

        });
    </script>







@stop

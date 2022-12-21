@extends('layouts.index')

<!-- Page Title -->
@section('title', 'Report History')

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
            <h3 class="text-dark mb-0">History</h3>
        </div>

        <!--Overview-->
        <div class="d-sm-flex p-2">
            <h5 class="text-dark mb-0">Overview</h5>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-xl-6 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Number of Donated Clothes:</span></div>
                                <div class="text-dark fw-bold h5 mb-0" id="totaldonations"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Number of Items:</span></div>
                                <div class="text-dark fw-bold h5 mb-0" id="totalitems"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Pie Graph-->
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">Donor/Shopper Sex</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="usersex" height="320"
                                style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">Charity Category</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="charitycategory" height="320"
                                style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">Products Category</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="productscategory" height="320"
                                style="display: block; width: 572px; height: 320px;" width="572"></canvas></div>
                    </div>
                </div>
            </div>
        </div>

        <!--DataList of Orders-->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-hover table-bordered pt-3 display" id="listPurchase" style="">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Purchased by</th>
                                <th>Number of Product</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--DataList of Donor/Shopper-->
        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Donations</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive " id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-hover table-bordered pt-3 display" id="listDonations" style="">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Donated By</th>
                                <th>Donated To</th>
                                <th>No. Of Items</th>
                                <th>Status</th>
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
        const annuallyGraph = new Chart(
        document.getElementById('annuallyGraph'),
        config
        );
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

    <!--Tables-->
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
        //Read Purchase
        const purchase = ref(database, 'Purchases/');
        onValue(purchase, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Pending Table
            var listPurchase = $('#listPurchase').DataTable();
            listPurchase.clear().draw();

            for (var key in data) {
                //Pending Table
                if(data[key]['status'] == 'Complete'){
                    listPurchase.row.add([
                        data[key]['id'],
                        data[key]['purchaseBy'],
                        data[key]['noOfProduct'],
                        data[key]['total'],
                        data[key]['status'],
                    ]).node().id = data[key]['id'];
                    listPurchase.draw(false);
                }
            }
        });

        //Donations
        const donations = ref(database, 'Donations/');
        onValue(donations, (snapshot) => {
            //Data
            const data = snapshot.val();

            //Pending Table
            var listDonations = $('#listDonations').DataTable();
            listDonations.clear().draw();

            for (var key in data) {
                //Pending Table
                if(data[key]['status'] != 'Pending'){
                    listDonations.row.add([
                        data[key]['id'],
                        data[key]['donatedBy'],
                        data[key]['donatedTo'],
                        data[key]['noOfItem'],
                        data[key]['status'],
                    ]).node().id = data[key]['id'];
                    listDonations.draw(false);
                }
            }

            //Total Number of Donated Clothes
            var temp=0;
            for(var key in data)
            {
                if(data[key]['status'] == 'Complete')
                {
                    var item = data[key]['noOfItem'];
                    temp = item+temp;
                }
                document.getElementById("totaldonations").innerHTML = temp;
            }
        });

        //Users
        const user = ref(database, 'User/DonorShopper/');
        onValue(user, (snapshot) => {

            const data = snapshot.val();

            //User Sex Chart
            var numMale=0, numFemale=0;
            for(var key in data)
            {
                if(data[key]['sex'] == 'Male')
                {
                    numMale++;
                }
                else if(data[key]['sex'] == 'Female')
                {
                    numFemale++;
                }

            }
            const piechart = document.getElementById('usersex').getContext('2d');
            const usersex = new Chart(piechart, {
                type: 'pie',
                data: {
                    labels: [
                        'Male',
                        'Female',
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [numMale, numFemale],
                        backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        });

        //Charity
        const charity = ref(database, 'Charities/');
        onValue(charity, (snapshot) => {

            const data = snapshot.val();

            //Charity Category Pie
            var animals=0, arts=0, comDev=0, education=0, environmental=0, health=0, human=0;
            for(var key in data)
            {
                var category = data[key]['charityDetails']['charityCategory'];

                if(data[key]['status'] == 'Listed'){
                    switch(category)
                    {
                        case 'Animals':
                            animals++;
                            break;
                        case 'Arts and Culture':
                            arts++;
                            break;
                        case 'Community Development':
                            comDev++;
                            break;
                        case 'Education':
                            education++;
                            break;
                        case 'Environmental':
                            environmental++;
                            break;
                        case 'Health':
                            health++;
                            break;
                        default:
                            human++;
                            break;

                    }
                }
            }
            const piechart = document.getElementById('charitycategory').getContext('2d');
            const charitycategory = new Chart(piechart, {
                type: 'pie',
                data: {
                    labels: [
                        'Animal',
                        'Arts and Culture',
                        'Community Development',
                        'Education',
                        'Environment',
                        'Health',
                        'Human',
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [animals, arts, comDev, education, environmental, health, human],
                        backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(66, 162, 122)',
                        'rgb(255,0,0)',
                        'rgb(0,255,255)',
                        'rgb(0,128,128)',
                        'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        });

        //Products
        const products = ref(database, 'Products/');
        onValue(products, (snapshot) => {

            const data = snapshot.val();

            var totalProducts = 0;
            for(var key in data)
            {
                if(data[key]['status'] == 'Sold' || data[key]['status'] == 'Listed'){
                    totalProducts++;
                }
                document.getElementById("totalitems").innerHTML = totalProducts;

            }
            //Charity Category Pie
            var jackets=0, shirts=0, pants=0;
            for(var key in data)
            {
                var newcategory = data[key]['category'];

                if(data[key]['status'] != 'Pending'){
                    switch(newcategory)
                    {
                        case 'Jacket and Hoodies':
                            jackets++;
                            break;
                        case 'Shirts and Blouses':
                            shirts++;
                            break;
                        default:
                            pants++;
                            break;
                    }
                }
            }
            const piechart = document.getElementById('productscategory').getContext('2d');
            const charitycategory = new Chart(piechart, {
                type: 'pie',
                data: {
                    labels: [
                        'Jacket and Hoodies',
                        'Shirts and Blouses',
                        'Pants and Jeans',
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [jackets, shirts, pants],
                        backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(66, 162, 122)',
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        });
    </script>
@stop


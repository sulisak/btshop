<style>
/* Table header & body text color */
#headerTable {
    color: white;
    font-size: 14px;
    background-color: #045aefff;
    /* dark background */
}

/* Table header background */
#headerTable thead tr {
    background-color: #045aefff;
}

/* Hover effect for table rows */
#headerTable tbody tr:hover {
    background-color: green;
    cursor: pointer;
}
</style>



<center>
    <div class="col-md-12 col-sm-12" ng-app="firstapp" ng-controller="Index">

        <div class="col-md-3"></div>
        <div class="col-md-6">

            <div class="panel panel-default">
                <div class="panel-body">
                    <center style="font-size:30px;color:blue;font-weight:bold;">
                        <?php echo $lang_cpf_1;?>
                    </center>
                </div>
            </div>

            <form class="form-inline" ng-submit="getlist(searchtext)">
                <div class="form-group">
                    <input type="text" ng-model="searchtext" class="form-control"
                        style="font-size:50px;width:300px;height:70px;" placeholder="ຄົ້ນຫາ..." />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-success" style="height:70px;" value="ຄົ້ນຫາ" />
                </div>
            </form>
            <br />

            <!-- <div class="panel panel-default">
                <div class="panel-body">

                    <h1 ng-if="list.length > 0">
                        <th color="green" style="font-size:70px;">ຊື່ສິນຄ້າ</th>: <span>{{list[0].product_name}}</span>
                        <font color="green" style="font-size:70px;">
                            <th>ລາຄາຂາຍຍ່ອຍ</th>{{list[0].product_price | number:2}}
                        </font>
                        <br />
                        <img ng-if="list[0].product_image" ng-src="<?php echo $base_url;?>/{{list[0].product_image}}">
                        <br />
                        {{list[0].product_code}}
                        <br />


                        <td>{{x.product_price | number:2}}</td>
                    </h1>

                    <h1 ng-if="list.length == 0" style="color:red;">
                        <?php echo $lang_cpf_2;?>
                    </h1>

                </div>
            </div> -->


            <div class="panel panel-default">
                <div class="panel-body" style="text-align: center;">

                    <!-- Show product info only if searchtext is not empty and list has items -->
                    <div ng-if="searchtext && list.length > 0">

                        <div style="font-size: 40px; color: darkorange; margin-bottom: 20px;">
                            ບາໂຄດ: {{list[0].product_code}}
                        </div>

                        <!-- Product Name -->
                        <div style="font-size: 50px; color: green; font-weight: bold; margin-bottom: 20px;">
                            ຊື່ສິນຄ້າ: {{list[0].product_name}}
                        </div>

                        <!-- Prices -->
                        <div style="font-size: 40px; color: darkorange; margin-bottom: 20px;">
                            ລາຄາຂາຍຍ່ອຍ: {{list[0].product_price | number:2}}
                            <span ng-if="list[0].product_wholesale_price > 0">
                                | ລາຄາຂາຍສົ່ງ: {{list[0].product_wholesale_price | number:2}}
                            </span>
                        </div>

                        <!-- Product Image -->
                        <div ng-if="list[0].product_image" style="margin-bottom: 20px;">
                            <img ng-src="<?php echo $base_url;?>/{{list[0].product_image}}"
                                alt="{{list[0].product_name}}"
                                style="max-width: 300px; height: auto; border-radius: 10px; box-shadow: 0 0 10px #999;">
                        </div>

                    </div>

                    <!-- Show "No products found" only if user typed something and list is empty -->
                    <div ng-if="searchtext && list.length == 0" style="color: red; font-size: 40px;">
                        <?php echo $lang_cpf_2;?>
                    </div>

                </div>
            </div>



            <div id="productlist" class="panel-body">
                <table ng-if="list.length > 0" id="headerTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ຊື່ສິນຄ້າ</th>
                            <th>ລາຄາຂາຍຍ່ອຍ</th>
                            <th>ລາຄາຂາຍສົ່ງ</th>
                            <th>ລາຍລະອຽດສິນຄ້າ</th>
                            <th>ປະເພດສິນຄ້າ</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in list">
                            <td>{{$index + 1}}</td>
                            <td>{{x.product_name}}</td>
                            <td>{{x.product_price | number:2}}</td>
                            <td>{{x.product_wholesale_price | number:2}}</td>
                            <td>{{x.product_des}}</td>
                            <td>{{x.product_category_name}}</td>

                        </tr>
                    </tbody>
                </table>

                <div ng-if="list.length == 0" style="color: white;">
                    No products found.
                </div>
            </div>


        </div>
    </div>
</center>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script> -->
<script>
var app = angular.module('firstapp', []);

app.controller('Index', function($scope, $http) {

    $scope.list = []; // initialize list
    $scope.searchtext = '';

    $scope.getlist = function(searchtext) {
        $scope.searchtext = searchtext || '';
        $http.post("Check_productlist_foranyone/get", {
                searchtext: $scope.searchtext
            })
            .then(function(response) {
                var data = response.data;
                console.log('Check_productlist_foranyone list:', data);
                $scope.list = data.list || [];
            }, function(error) {
                console.error("Failed to fetch product list:", error);
                $scope.list = [];
            });
    };

    // Load immediately on page load
    $scope.getlist('');
});
</script>
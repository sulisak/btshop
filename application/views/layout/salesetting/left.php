<style type="text/css">
.nav-pills>li.active>a,
.nav-pills>li.active>a:focus,
.nav-pills>li.active>a:hover {
    color: #fff;
    background-color: #f0ad4e;
}

a {
    color: #000000;
}
</style>
<div class="col-md-2 col-sm-3">


    <div class="panel panel-default">
        <div class="panel-body">


            <ul class="nav nav-pills nav-sidebar">


                <li style="width: 100%;" <?php if($tab === 'pay_type'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/pay_type"><span class="glyphicon glyphicon-cog"
                            aria-hidden="true"></span>
                        <?php echo $lang_lost_1;?></a></li>
                <!-- <li style="width: 100%;" <?php if($tab === 'ppsetting'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/ppsetting"><span class="glyphicon glyphicon-cog"
                            aria-hidden="true"></span>
                        prompay setting</a></li> -->

                <li style="width: 100%;" <?php if($tab === 'name_of_price'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/name_of_price"><span class="glyphicon glyphicon-cog"
                            aria-hidden="true"></span>
                        5 ລາຄາ </a></li>


                <li style="width: 100%;" <?php if($tab === 'exchangerate'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/exchangerate"><span class="glyphicon glyphicon-cog"
                            aria-hidden="true"></span>
                        ອັດຕາແລກປ່ຽນ</a></li>

                <li style="width: 100%;" <?php if($tab === 'discount'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/discount"><span class="glyphicon glyphicon-flash"
                            aria-hidden="true"></span>
                        <?=$lang_settingdiscount?> </a></li>

                <li style="width: 100%;" <?php if($tab === 'pricebycus'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/pricebycus"><span class="glyphicon glyphicon-cog"
                            aria-hidden="true"></span>
                        <?=$lang_settingpricecus?> </a></li>


                <li style="width: 100%;" <?php if($tab === 'pricebycusgroup'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/pricebycusgroup"><span
                            class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <?=$lang_settingpricecusgroup?> </a></li>

                <li style="width: 100%;" <?php if($tab === 'pricebystep'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/pricebystep"><span class="glyphicon glyphicon-cog"
                            aria-hidden="true"></span>
                        Step Price By QTY<br /> ລາຄາສິນຄ້າຕາມ ຈຳນວນທີ່ຊື້ </a></li>

                <li style="width: 100%;" <?php if($tab === 'numtoprice'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/numtoprice"><span class="glyphicon glyphicon-cog"
                            aria-hidden="true"></span>
                        Step Price Per QTY<br /> ທຸກໆ X ຊີ້ນ ຈະລາຄາ xxx </a></li>

                <li style="width: 100%;" <?php if($tab === 'product_point'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/product_point"><span
                            class="glyphicon glyphicon-flash" aria-hidden="true">
                        </span> <?php echo $lang_lost_4_1;?> </a></li>


                <li style="width: 100%;" <?php if($tab === 'round_setting'){ echo 'class="active"';} ?>><a
                        href="<?php echo $base_url; ?>/salesetting/round_setting"><span class="glyphicon glyphicon-cog"
                            aria-hidden="true"></span>
                        <?php echo $lang_lost_5;?> </a></li>



                <li style="width: 100%;" <?php if($tab === 'setting_etc'){ echo 'class="active"';} ?>>
                    <a href="<?php echo $base_url; ?>/salesetting/setting_etc">
                        <span class="glyphicon glyphicon-flash" aria-hidden="true">
                        </span> <?php echo $lang_lost_6;?></a>
                </li>


                <!-- <li style="width: 100%;" <?php if($tab === 'linenotify'){ echo 'class="active"';} ?>>
                    <a href="<?php echo $base_url; ?>/salesetting/linenotify">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        ແຈ້ງເຕື່ອນຜ່ານທາງ LINE Notify </a>
                </li> -->

                <a href="#" class="btn btn-warning" ng-click="Delsaleall()"
                    style="font-size:16px;font-weight:bold;width:200px;">
                    <span class="glyphicon glyphicon-remove" style="font-size:30px;"></span><br />
                    <?php echo $lang_db_18;?>
                </a>


                <a href="#" class="btn btn-danger" ng-click="Delall_product()"
                    style="font-size:16px;font-weight:bold;width:200px;">
                    <span class="glyphicon glyphicon-remove" style="font-size:30px;"></span><br />
                    <?php echo $lang_db_19;?>
                </a>


            </ul>




        </div>

    </div>


</div>


<div class="modal fade" id="Delsaleall">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $lang_db_41;?></h4>
            </div>
            <div class="modal-body">
                <center>


                    <h3><b><?php echo $lang_db_42;?></b></h3>
                    <font style="color:red;"><?php echo $lang_db_43;?></font>
                    <br />
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" id="dayfrom" name="dayfrom" ng-model="dayfrom" class="form-control"
                                placeholder="<?=$lang_fromday?>"> -
                        </div>
                        <div class="form-group">
                            <input type="text" id="dayto" name="dayto" ng-model="dayto" class="form-control"
                                placeholder="<?=$lang_today?>">
                        </div>
                    </form>
                    <br />
                    <a ng-if="dayfrom!='' && dayto!=''" ng-click="Delsalesomecheck()" class="btn btn-warning"
                        style="font-size: 16px;font-weight: bold; width: 200px;border-radius: 20px;">
                        <?php echo $lang_db_44;?>
                    </a>


                    <span ng-if="delsalesomenum =='0'">
                        <br />
                        <?php echo $lang_db_45;?> {{delsalesomenum}}
                        <?php echo $lang_db_46;?>
                        <?php echo $lang_db_47;?>
                    </span>


                    <span ng-if="delsalesomenum =='ok'" style="color:green;">
                        <br />
                        <?php echo $lang_db_48;?>
                    </span>







                    <span ng-if="delsalesomenum >'0' && delsalesomenum !='ok'" style="color:red;">
                        <br />
                        <?php echo $lang_db_49;?> {{delsalesomenum}} <?php echo $lang_db_46;?>
                        <br />
                        <a ng-click="Delsalesomeok()" ng-disabled="delsalesomeclick" class="btn btn-success"
                            style="font-size: 16px;font-weight: bold; width: 200px;border-radius: 20px;">
                            <?php echo $lang_db_50;?>
                        </a>
                        <br />
                        <img ng-if="delsalesomeclick" src="<?php echo $base_url;?>/pic/loading.gif">

                    </span>









                    <hr />
                    <h3><b><?php echo $lang_db_51;?></b></h3>
                    <font style="color:red;"><?php echo $lang_db_52;?></font>
                    <br />
                    <a href="<?php echo $base_url;?>/c2mhelper/delsaleall" class="btn btn-success"
                        style="font-size: 16px;font-weight: bold; width: 200px;border-radius: 20px;">
                        <?php echo $lang_db_50;?>
                    </a>

                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


<script>
var app = angular.module('firstapp', []);
app.controller('Index', function($scope, $http, $location) {




    $("#dayfrom").datetimepicker({
        timepicker: false,
        format: 'd-m-Y',
        lang: 'th' // แสดงภาษาไทย
        //yearOffset:543  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
        //inline:true

    });

    $("#dayto").datetimepicker({
        timepicker: false,
        format: 'd-m-Y',
        lang: 'th' // แสดงภาษาไทย
        //yearOffset:543  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
        //inline:true

    });

    $scope.dayfrom = '';
    $scope.dayto = '';






    $scope.delsalesomenum = '';
    $scope.Delsalesomecheck = function() {
        $http.post("<?php echo $base_url;?>/c2mhelper/Delsalesomecheck", {
            dayfrom: $scope.dayfrom,
            dayto: $scope.dayto
        }).success(function(data) {
            $scope.delsalesomenum = data;
        });

    };




    $scope.Delsalesomeok = function() {
        $scope.delsalesomeclick = true;
        $http.post("<?php echo $base_url;?>/c2mhelper/Delsalesomeok", {
            dayfrom: $scope.dayfrom,
            dayto: $scope.dayto
        }).success(function(data) {
            $scope.delsalesomenum = data;
            $scope.delsalesomeclick = false;
        });

    };





    $scope.Saletoday = function() {

        $http.get('Home/Saletoday')
            .then(function(response) {
                $scope.saletoday = response.data;

            });
    };
    $scope.Saletoday();




    $scope.Productsaletoday = function() {

        $http.get('Home/Productsaletoday')
            .then(function(response) {
                $scope.productsaletoday = response.data;

            });
    };
    $scope.Productsaletoday();


    $scope.Productoutofstock = function() {

        $http.get('Home/Productoutofstock')
            .then(function(response) {
                $scope.productoutofstock = response.data;

            });
    };

    $scope.Productoutofstock();

    // ==============================================
    $scope.get_product_value = function() {
        $http.get('Sale/product_value/Getstock', {}) // send empty object if no filters
            .then(function(response) {
                console.log("Getstock response:", response.data); // debug
                $scope.product_value_list = response.data;
            });
    };
    $scope.get_product_value();


    // ==============================================

    $scope.Productdateend = function() {

        $http.get('Home/Productdateend')
            .then(function(response) {
                $scope.productdateend = response.data;

            });
    };
    $scope.Productdateend();


    $scope.Productpawnenddate = function() {

        $http.get('Home/Productpawnenddate')
            .then(function(response) {
                $scope.productpawnenddate = response.data;

            });
    };
    $scope.Productpawnenddate();



    $scope.Product_orderprint = function() {

        $http.post("<?php echo $base_url;?>/purchase/buy/Product_orderprint", {}).success(function(data) {

            $scope.product_orderprint_list = data;
            if ($scope.product_orderprint_list.length > 0) {
                $('#Product_orderprint_modal').modal('show');
            }

        });

    };

    $scope.Product_orderprint();




    $scope.Product_num_min_noti = function() {

        $http.post("<?php echo $base_url;?>/warehouse/stock/Product_num_min_noti", {}).success(function(
            data) {

            $scope.product_num_min_noti_list = data;
            if ($scope.product_num_min_noti_list.length > 0) {
                $('#Product_num_min_noti_modal').modal('show');
            }

        });

    };

    $scope.Product_num_min_noti();



    $scope.C2m_bd_noti = function() {

        $http.get('<?php echo $base_url;?>/mycustomer/C2m_bd_noti')
            .then(function(response) {
                $scope.c2m_db_noti_list = response.data;
                if ($scope.c2m_db_noti_list.length > 0) {
                    $('#C2m_bd_noti_modal').modal('show');
                }


            });
    };
    $scope.C2m_bd_noti();





    $scope.Delsaleall = function() {

        $('#Delsaleall').modal('show');
    };



    $scope.Delall_product = function() {

        $('#Delall_product').modal('show');
    };




});
</script>
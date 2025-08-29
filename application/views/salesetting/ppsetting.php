<div class="col-md-10 col-sm-9" ng-app="firstapp" ng-controller="Index">

    <div class="panel panel-default col-md-12">
        <div class="panel-body">
            <h4><b>Prom pay setting</b></h4>
            <br />

            <div class="form-group">
                Prom pay account number or ID
                <input type="text" ng-model="ppid" class="form-control" placeholder="Prom pay account number or ID"
                    style="width:300px;">
            </div>




            <div class="form-group">
                Prom pay name
                <input type="text" ng-model="ppname" class="form-control"
                    placeholder="ชื่อบัญชี พร้อมเพย์ เช่น ร้านร่ำรวย" style="width:300px;">
            </div>
            <hr />


            <button class="btn btn-success" ng-click="Saveall()">save</button>

        </div>
    </div>

</div>


<script>
var app = angular.module('firstapp', []);
app.controller('Index', function($scope, $http, $location) {


    $scope.getall = function() {
        $http.get('ppsetting/Get')
            .then(function(response) {
                if (response.data.list.length > 0) {
                    $scope.ppid = response.data.list[0].ppid;
                    $scope.ppname = response.data.list[0].ppname;
                }
            });
    };

    $scope.Saveall = function() {
        $http.post("ppsetting/Update", {
            ppid: $scope.ppid,
            ppname: $scope.ppname
        }).then(function(response) {
            if (response.data.success) {
                toastr.success('Saved successfully');
            } else {
                toastr.error('Save failed');
            }
        });
    };

    $scope.getall();



});
</script>
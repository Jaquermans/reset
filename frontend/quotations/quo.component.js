function newQuotation($rootScope,$scope,$timeout){
    $scope.getAllData = function getAllData(){
        console.log('hola de nuevo');
    }
}

app.component("new",{
    templateUrl:"./quotations/new.html",
    controller: newQuotation
});

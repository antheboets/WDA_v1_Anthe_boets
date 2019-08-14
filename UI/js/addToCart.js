$(document).ready(function() {

    //https://stackoverflow.com/questions/19655189/javascript-click-event-listener-on-class
    var classname = document.getElementsByClassName("buyBtn");



    if(isLogedIn()){
        for (var i = 0; i < classname.length; i++) {
            classname[i].addEventListener('click', function () {
                $('#mLogin').modal({
                    backdrop: 'static'
                });
            });
        }
    }
    else{
        for (var i = 0; i < classname.length; i++) {
            classname[i].addEventListener('click', e => {


                let data = {
                    "productId" : e.currentTarget.parentElement.id,
                    "amount" : "1"
                };


                $.ajax({
                    async: true,
                    crossDomain: true,
                    method: "POST",
                    url:  url+ "Logic/addProductToCart.php",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    data: JSON.stringify(data),
                    dataType: 'json',

                    success: function(data){
                        console.log(data);
                    },
                    error: function(data){
                        console.log(data)
                    }
                });




            }, false);
        }
    }


});
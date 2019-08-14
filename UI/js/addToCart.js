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

                let error = false;
                if(document.getElementById('buyAmount') != null){
                    if(!isInt(document.getElementById('buyAmount').value)){
                        error = true;
                        document.getElementById('IBuyAmount').innerText = "must be a number";
                    }


                    if(!error){

                        let amount = 1;

                        let data = {
                            "productId" : e.currentTarget.parentElement.id,
                            "amount" : amount
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

                    }
                }





            }, false);
        }
    }


});
$(document).ready(function() {

    document.getElementById('searchForm').addEventListener('submit', e => {
        e.preventDefault();
        let valueDataList = document.getElementById('search').value;
        let productId;
        let foundId = false;
        let options = document.getElementById('searchList').childNodes;
        for(let i =0; i < options.length; i++){
            if(options[i].value === valueDataList){
                foundId = true;
                productId = options[i].attributes[1].value;
            }
        }
        if(!foundId){
            e.preventDefault();
        }
        document.getElementById('searchForm').action = "http://dtsl.ehb.be/~anthe.boets/eShop/UI/pages/details.php?id=" + productId;
    });

    document.getElementById('search').addEventListener('input', function () {
         //console.log( document.getElementById('search').value);

        let data = {
            "name" :  document.getElementById('search').value
        };

        $.ajax({
            async: true,
            crossDomain: true,
            method: "POST",
            url: url+ "Logic/getProductName.php",
            headers: {
                "Content-Type": "application/json"
            },
            data: JSON.stringify(data),
            dataType: 'json',

            success: function(data){
                //console.log(data)
                document.getElementById('searchList').innerHTML = "";
                for(let i = 0; i <data.length;i++){
                    $('#searchList').append("<option value='"+ data[i].name+"' productId='"+data[i].id +"'>");
                }

            },
            error: function(data){
                //console.log(data)
            }
        });


    });


});
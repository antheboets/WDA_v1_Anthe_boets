$(document).ready(function() {

    document.getElementById("replyClearBtn").addEventListener("click", function () {
        document.getElementById("replyInfo").style.display = "none";
        document.getElementById("replyName").value = "Name: ";
        document.getElementById("replyText").value = "Text: ";
        document.getElementById("replyId").value = 0;
    });



    var classname = document.getElementsByClassName("replyBtn");



    if(isLogedIn()){
        for (var i = 0; i < classname.length; i++) {
            classname[i].addEventListener('click', function () {
                $('#mLogin').modal({
                    backdrop: 'static'
                });
            });
        }
    }
    else {
        for (var i = 0; i < classname.length; i++) {
            classname[i].addEventListener('click', e => {
                document.getElementById("replyInfo").style.display = "";
                document.getElementById("replyName").innerText =  e.currentTarget.parentElement.childNodes[0].innerText;
                document.getElementById("replyText").innerText = "Text: " +   e.currentTarget.parentElement.parentElement.childNodes[1].childNodes[0].innerText;
                document.getElementById("replyId").value = e.currentTarget.parentElement.parentElement.parentElement.id;
            });
        }
    }


    document.getElementById("ratingForm").addEventListener('submit', e => {

        if(isLogedIn()){
            e.preventDefault();
            $('#mLogin').modal({
                backdrop: 'static'
            });
        }
        else{
            document.getElementById('urlRating').value = window.location.href;
        }
 });

    document.getElementById("commentForm").addEventListener('submit', e => {

        if(isLogedIn()){
            e.preventDefault();
            $('#mLogin').modal({
                backdrop: 'static'
            });
        }
        else{
            document.getElementById('urlComment').value = window.location.href;
        }

    });
});



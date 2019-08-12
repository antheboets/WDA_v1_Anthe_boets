$(document).ready(function() {
    //https://github.com/taniarascia/upload
    const form = document.getElementById('ProductForm');

    form.addEventListener('submit', e => {
        let error = false;
        document.getElementById("EName").innerText = "";
        document.getElementById("EDescription").innerText = "";
        document.getElementById("EImage").innerText = "";
        document.getElementById("ECategory").innerText = "";
        document.getElementById("EPrice").innerText = "";

        document.getElementById("IPrice").value = document.getElementById("IPrice").value.replace(",",".");

        if(document.getElementById("IName").value === ""){
            error = true;
            document.getElementById("EName").innerText = "Can't be empty";
        }
        if(document.getElementById("IDescription").value === ""){
            error = true;
            document.getElementById("EDescription").innerText = "Can't be empty";
        }
        if(document.getElementById("IImage").value === ""){
            error = true;
            document.getElementById("EImage").innerText = "Can't be empty";
        }
        if(document.getElementById("ICategory").value === ""){
            error = true;
            document.getElementById("ECategory").innerText = "Can't be empty";
        }
        if(document.getElementById("IPrice").value === ""){
            error = true;
            document.getElementById("EPrice").innerText = "Can't be empty";
        }
        if(!$.isNumeric(document.getElementById("IPrice").value)){
            error = true;
            document.getElementById("EPrice").innerText = "Has to be a number";
        }
        if(document.getElementById("IPrice").value < 0){
            error = true;
            document.getElementById("EPrice").innerText = "Must be positive";
        }
        if(error){
            e.preventDefault();
        }
        else
        {
            const files = document.querySelector('[type=file]').files;
            const formData = new FormData();

            for (let i = 0; i < files.length; i++) {
                let file = files[i];

                formData.append('files[]', file);
            }
        }
    });
});

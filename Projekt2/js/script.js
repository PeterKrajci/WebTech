$(document).ready(function(){
 
    // handle 'read one' button click
    $("#formDatum").on("submit", function(e){
        e.preventDefault();
        // product ID will be here
        var day=document.getElementById("dateDay").value;
        var month=document.getElementById("dateMonth").value;
        var state=document.getElementById("countryDatum").value;

        $.ajax({
            type: "GET",
            url: "https://wt84.fei.stuba.sk/Xcv6/searchnamedays.php?date=2021-" + month + "-" + day + "&state=" + state,
            success: function(data) {
                let i=0;
                console.log(data['records']);
                document.getElementById("res1").innerHTML="";
                while(typeof data['records'][i]!="undefined"){
                    document.getElementById("res1").innerHTML+=data['records'][i].name+"<br>";
                    i++;
                    console.log(i);
                }
                
                
            },
            error: function(xhr, resp, text){
                // on error, tell the user sign up failed
                if(xhr.responseJSON.message=="No names found."){
                    $('#res1').html("<div class='alert alert-danger'>No names found.</div>");
                }
                
            }
        });
    });
    $( "#dateClear" ).click(function() {
        document.getElementById("res1").innerHTML="";
    });


    //datum z menin a statu
    $("#formNameState").on("submit", function(e){
        e.preventDefault();
        // product ID will be here
        var name=document.getElementById("name").value;
        
        var state=document.getElementById("countryDatum2").value;

        $.ajax({
            type: "GET",
            url: "https://wt84.fei.stuba.sk/Xcv6/retdate.php?name=" + name + "&state=" + state,
            success: function(data) {
                let i=0;
                document.getElementById("res2").innerHTML="";
                while(typeof data['records'][i]!="undefined"){
                    console.log(data['records'][i]['day']);
                    
                
                    document.getElementById("res2").innerHTML+=data['records'][i]['day']+"-"+ data['records'][i]['month'] + "-" +data['records'][i]['year'] + "<br>";
                    i++;
                }
                
                
                
                
                
            },
            error: function(xhr, resp, text){
                // on error, tell the user sign up failed
                if(xhr.responseJSON.message=="Nothing found for this name and state!"){
                    $('#res2').html("<div class='alert alert-danger'>Nothing found for this name and state!</div>");
                }
                
            }
        });
    });

    $( "#clear2" ).click(function() {
        document.getElementById("res2").innerHTML="";
    });

    //zobrazenie sk/cz sviatkov
    $("#form3").on("submit", function(e){
        e.preventDefault();
        
        var state=document.getElementById("countryDatum3").value;
        let i=0;
        if(state=="Slovensko"){
            $.ajax({
                type: "GET",
                url: "https://wt84.fei.stuba.sk/Xcv6/skholidays.php",
                success: function(data) {
                    
                    document.getElementById("res3").innerHTML="";
                    while(typeof data['records'][i]!="undefined"){
                        document.getElementById("res3").innerHTML+=data['records'][i].day + "-" + data['records'][i].day + "-" + data['records'][i].year+"     "+ data['records'][i].value +"<br>";
                        i++;
                        console.log(i);
                        console.log(data['records'][0]['value']);
                    }
                    
                    
                    
                    
                    
                }
            });

        }
        else{
            $.ajax({
                type: "GET",
                url: "https://wt84.fei.stuba.sk/Xcv6/czholidays.php",
                success: function(data) {
                    
                    document.getElementById("res3").innerHTML="";
                    while(typeof data['records'][i]!="undefined"){
                        document.getElementById("res3").innerHTML+=data['records'][i].day + "-" + data['records'][i].day + "-" + data['records'][i].year+"     "+ data['records'][i].value +"<br>";
                        i++;
                        console.log(i);
                        console.log(data['records'][0]['value']);
                    }
                    
                    
                    
                    
                    
                }

            });
        }


    });

    $( "#clear3" ).click(function() {
        document.getElementById("res3").innerHTML="";
    });


    $("#form4").on("submit", function(e){
        e.preventDefault();
        
        var state=document.getElementById("countryDatum4").value;
        let i=0;
        $.ajax({
            type: "GET",
            url: "https://wt84.fei.stuba.sk/Xcv6/skmemdays.php",
            success: function(data) {
                
                document.getElementById("res4").innerHTML="";
                while(typeof data['records'][i]!="undefined"){
                    document.getElementById("res4").innerHTML+=data['records'][i].day + "-" + data['records'][i].day + "-" + data['records'][i].year+"     "+ data['records'][i].value +"<br>";
                    i++;
                    console.log(i);
                    console.log(data['records'][0]['value']);
                }
                
                
                
                
                
            }
        });

        
    });

    $( "#clear4" ).click(function() {
        document.getElementById("res4").innerHTML="";
    });


    $("#form5").on("submit", function(e){
        e.preventDefault();
        // get form data
        var form_data=JSON.stringify($(this).serializeObject());
        $.ajax({
            url: "https://wt84.fei.stuba.sk/Xcv6/addmemday.php",
            type : "POST",
            data : form_data,
            dataType: 'text',
            success: function(result) {
                // product was created, go back to products list
                $('#res5').html("<div class='alert alert-success'>Record created!</div>");
                
            },
            error: function(xhr, resp, text) {
                // show error to console
                console.log(xhr.responseText);
                $('#res5').html("<div class='alert alert-danger'>Something went wrong!</div>");
            }
        });

        
    });

 
});







<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="mystyle.css">
    <title>Document</title>
  </head>
  <body>
    <h1 class="text-center">Zadanie č.6</h1>
    <div class="container border border-primary">

      <div id="this" class="row">
        <div class="col-md-4">
            <h2>Nájdi meniny z dátumu</h2>

            
            <p class="text-light bg-dark">Z formuláru sa získa deň a mesiac, z ktorých sa získa ID dňa a krajina. Vrátený JSON vidno na linku zobrazenom
            po stlačení tlačidla Zobraz</p>

            
            <form id = "formDatum">

                <div class="row">

                    <div class="col">
                        <label for="dateDay">Deň: </label><br>
                        <input type="number" id="dateDay" name="dateDay" value="1" min="1" max = "31">
                    </div>

                    <div class="col">
                        <label for="dateMonth">Mesiac:</label><br>
                        <input type="number" id="dateMonth" name="dateMonth" value="1" min="1" max = "12">
                    </div>

                </div>

                <label for="countryDatum">Krajina: </label><br>
                <select name="countryDatum" id="countryDatum" form="formDatum">
                    <option value="Slovensko">Slovensko</option>
                    <option value="Česká republika">Česká republika</option>
                    <option value="Maďarsko">Maďarsko</option>
                    <option value="Poľsko">Poľsko</option>
                    <option value="Rakúsko">Rakúsko</option>
                </select>
                <div class="row">
                    <button id = "dateSubm" class = "btn btn-dark m-3">Zobraz</button>
                </div>

                
            </form> 
            <div class="row">
                <button id ="dateClear" class = "btn btn-dark m-3">Vyčisti</button>
            </div>
            <div>
                <p id ="res1"></p>
            </div>

        

            


        
        </div>

        <div class="col-md-4">
            <h2>Nájdi dátum z mena a štátu</h2>

                
            <p class="text-light bg-dark">Z formuláru sa získa meno a krajina, server vráti dátum.</p>
            <form id = "formNameState">

                <div class="row">

                    <div class="col">
                        <label for="name">Meno: </label><br>
                        <input type="text" id="name" name="name" >
                    </div>

                    <div class="col">
                        <label for="countryDatum2">Krajina: </label><br>
                        <select name="countryDatum2" id="countryDatum2" form="formNameState">
                            <option value="Slovensko">Slovensko</option>
                            <option value="Česká republika">Česká republika</option>
                            <option value="Maďarsko">Maďarsko</option>
                            <option value="Poľsko">Poľsko</option>
                            <option value="Rakúsko">Rakúsko</option>
                        </select>
                    </div>

                </div>

                <div class="row">
                    <button id = "subm2" class = "btn btn-dark m-3">Zobraz</button>
                </div>

                
            </form> 
            <div class="row">
                <button id ="clear2" class = "btn btn-dark m-3">Vyčisti</button>
            </div>

            <div>
                <p id ="res2"></p>
            </div>
        </div>

        <div class="col-md-4">
            <h2>Zobraz všetky sk/cz sviatky</h2>

                
            <p class="text-light bg-dark">Z formuláru sa získa krajina, vráti zoznam všetkých sviatkov vo vybranej krajine.</p> 
            <form id = "form3">


                <label for="countryDatum3">Krajina: </label><br>
                <select name="countryDatum3" id="countryDatum3" form="form3">
                    <option value="Slovensko">Slovensko</option>
                    <option value="Česká republika">Česká republika</option>
                </select>
                <div class="row">
                    <button id = "subm3" class = "btn btn-dark m-3">Zobraz</button>
                </div>

                
            </form> 
            <div class="row">
                <button id ="clear3" class = "btn btn-dark m-3">Vyčisti</button>
            </div>
            <div>
                <p id ="res3"></p>
            </div>
        </div>

        <div class="col-md-4">
            <h2>Zobraz všetky pamätné dni na Slovensku</h2>

                    
            <p class="text-light bg-dark">Z formuláru sa získa krajina, vráti zoznam všetkých pamätných dní vo vybranej krajine (len SK).</p> 
            <form id = "form4">


                <label for="countryDatum4">Krajina: </label><br>
                <select name="countryDatum4" id="countryDatum4" form="form4">
                    <option value="Slovensko">Slovensko</option>
                </select>
                <div class="row">
                    <button id = "subm4" class = "btn btn-dark m-3">Zobraz</button>
                </div>

                
            </form> 
            <div class="row">
                <button id ="clear4" class = "btn btn-dark m-3">Vyčisti</button>
            </div>
            <div>
                <p id ="res4"></p>
            </div>
        </div>

        <div class="col-md-4">
            <h2>Pridaj nové meno</h2>

            <p class="text-light bg-dark">POST, URI /meniny</p>
            <p class="text-light bg-dark">Údaje z formuláru pošle na server, kde sa uložia do databázy</p>

            <form  id = "form5" method='post'>

                <div class="row">

                    <div class="col">
                        <label for="name2">Meno: </label><br>
                        <input type="text" id="name2" name="name2"><br>
                    </div>

                    <div class="col">
                        <label for="day2">Deň: </label><br>
                        <input type="number" id="day2" name="day2" value="1" min="1" max = "31">
                    </div>

                    <div class="col">
                        <label for="month2">Mesiac:</label><br>
                        <input type="number" id="month2" name="month2" value="1" min="1" max = "12">
                    </div>

                    <div class="col">
                        <label for="countryAddName5">Krajina: </label><br>
                        <select name="countryAddName5" id="countryAddName5" form="form5">
                            <option value="Slovensko">Slovensko</option>
                        </select>
                    </div>

                </div>

                <button id = "submitAddName" class = "btn btn-dark m-3">Pridaj</button>

                
            </form> 

            

            <div>
                <p id ="res5"></p>
            </div>

      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/jQuery.serializeObject-master/jquery.serializeObject.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
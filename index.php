<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Alex' Xięgarnia </title>
    <link href="css/style.css" rel="stylesheet">
    
        
  </head>
  <body>
    
  
    <div class="formBox"> 
        <h3> Witaj w swojej E-Xięgarni! </h3>
        <form action="" method="POST"> 
            <fieldset> 
                <div class="form">
                    <div>
                        <input id="author" name="author" type="text" placeholder="Wpisz autora">
                    </div>
                    <div>
                        <input id="name" name="name" type="text" placeholder="Wpisz tytuł">
                    </div>
                    <div>
                        <input id="description" name="desctiption" type="text" placeholder="Wpisz opis">
                    </div>
                    <div> 
                        <input id="sendBtn" name="sendbtn" type="submit" value="Zapisz księgę!">
                    </div>
                </div>                
            </fieldset>
        </form>
        
        <h3> Tutaj jest lista wszystkich Twoich książek: </h3>
        <div class="container">
            <ol id="booksList">
                
            </ol>
            
        </div>
        
    </div>
  
      
        <script src="jquery-3.1.1.js"></script>
    
        <script src="xiegarnia.js"></script>
  </body>
</html>
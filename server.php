<?php

	$servername = "localhost";
	$username = "db_user";
	$password = "Jelszo1";
	$db = "borondicomputer";

    $conn = new mysqli($servername, $username, $password, $db);
	$conn->set_charset("utf8");



    if($_REQUEST["m"])
    {
        if($_REQUEST["m"] == "sz")
        {
            $sql = "SELECT * FROM categories";
            $eredmeny;
            $str;

            $eredmeny=$conn->query($sql);

            $str= '<div class="card-group">';

        while($rekord = $eredmeny->fetch_assoc())
        {
            $html = '<!DOCTYPE html>
            <html lang="hu">
            <head>
                <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
                <link rel="stylesheet" href="Main_Window.css">
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel = "icon" href ="Logos, wallpapers/Bar_PC_Logo.png" type = "image/x-icon">
                
                <title>BöröndiComputer - '. $rekord["categname"].'</title>
            
            </head> 
            <body onload="loadItems()">
            <body>
            <header id="insert" class="p-3 bg-dark text-white">
            </header>
                
            <!--Middle of the page, the computer ads are here-->
            
            <div class="middleRowDiv" >
                <p id="category">'.$rekord["categname"] .'</p>
            <hr>

                <div id="categories">

                </div>
            </div>
            <script src="scripts.js"></script>
            </body>
            </html>';



            //Creates the categories to the main page <<<
            $str .= '
            <div class="col">
            <a class="adClick" href=" '. $rekord["categname"] .'.html ">
            <div class="card h-100" style="width: 16rem;">
            <img style="height: max(250px); "  src=" '.$rekord["imgsrc"] .' " class="card-img-top" alt="...">
            <div class="card-body">
            
              <h5 class="card-title">  
              <p class="title">'. $rekord["categname"] .'</p>
              </h5>
               
            </div>
            </div>
            </a>
            </div>';
            //>>>

            //Creates the files if they doesn't exist from the categories
            $myFile=$rekord["categname"] .'.html';
            $fh = fopen($myFile, 'a+') 
            or exit("<font color='red'>Please Create a directory name:3dpage");
            
            if(!file_exists($myFile))
            {
                $f="";
                fwrite($fh, $f);
            }
            if(filesize($rekord["categname"] .'.html') == 0)
            {
                fwrite($fh, $html);  
            }
        }
        $str .= "</div>";
        echo $str;
       }




       elseif($_REQUEST["m"] == "r"){
        $name = $_REQUEST["name"];
        $image = $_REQUEST["image"];
        $sql = "INSERT INTO categories (categname,imgsrc) VALUES('".$name."','" . $image . "')";
		
		if($conn->query($sql) === TRUE){
			echo "Feltöltve!";
		}
        else
        {
			echo $conn->error;
		}
       }

       elseif($_REQUEST["m"] == "i")
       {
        $categ = $_REQUEST["categ"];
        $sql = 'SELECT * FROM items WHERE category = "'. $categ .'"';
        
        $eredmeny;
        $str='<div class="card-group">'; 
        $eredmeny = $conn->query($sql);

        while($rekord = $eredmeny->fetch_assoc()){
        $str.= ' 
        <div class="col">
        <div class="card h-100" style="width: 15rem;">
        <img src=" '. $rekord["imagesrc"]  .'" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'. $rekord["name"] .'</h5>
          <p class="card-text">'. $rekord["description"]  .'</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Ár: '.$rekord["price"] .'Ft </small>
          <a href="'.$rekord["itemlink"].'"><button class="itemButton"> Vásárlás  </button></a>
        </div>
        </div>
        </div>';}

        $str.="</div>";
        echo $str;
        
       }
    }
    
?>
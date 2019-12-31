<?php
include_once 'server.php';


function getHead($current){
echo"

	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	

	<title>$current</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"title\" content=\"VenetoTour\" />
    <meta name=\"description\" content=\"Tour in veneto\" />
    <meta name=\"keywords\" content=\"Tour, veneto, gite, padova, vicenza, venezia, treviso, rovigo, verona, belluno\" />
    <meta name=\"language\" content=\"it\" />
    <meta name=\"author\" content=\"Rizzo Ilaria, Romito Sara, Vasile Tusa, Salviato Alberto\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale = 1.0\" />

	<link rel=\"stylesheet\"  href=\"stileila.css\"/ >


	<link rel=\"icon\" 
      type=\"image/png\" 
      href=\"img/favicon.png\">
	
";
}function getFooter(){echo"

    <footer>
        <div class=\"container\">     
            <div>&copy; 2019 <span lang=\"it\">Veneto Eventi </span>Torre Archimede, Via Trieste, 63, 35121 Padova PD (<span lang=\"it\">Italia</span>)
            </div>
            <div> email: venetoeventi@gmail.com </div>
            <div> tel: +39 123456789 </div>

            <div class=\"torna-su\">   
            <a class=\"scritta-torna-su\" href=\"#\">TORNA SU</a>
            </div>
        </div>  
    </footer>

</html>";
}
function getMenu1($current){
    echo "<body>
    <header id=\"header-section\"><div id=\"menu-log-linea\"><div id=\"menu-log\">

                
                
            ";
            if((isset($_SESSION['usernameU']))or(isset($_SESSION['usernameA']))){
                echo "<a class=\"a-menu-log log-scritta\"href=\"logout.php\"class=\"active\"> Logout</a>";}
            else{echo"<a class=\"a-menu-log\"href=\"login.php\"> Login</a>";}
            echo "<a class=\"a-menu-log\" href=\"registrazione_utente.php\" ";if($current=="Registrati"){echo"class=\"active\"";}echo">Registrati </a>
            </div></div>";

}
function getMenu2($current){
	  	
echo"

    <div class=\"menu-2\">
     <div class=\"header\">
        <div class=\"header-left\">
        <a class=\"logo-a\" href=\"home.php\"><img class=\"logo\"src=\"img/logo.jpg\" alt=\"Veneto on Tour\"></a>
        </div>
        <div class=\"header-right\">
        
           <a href=\"home.php\"  ";if(($current=="Home")||($current=="Città")){echo"class=\"active\"";}echo">Home</a>
           
           <a href=\"eventi.php\"  ";if($current=="Eventi"){echo"class=\"active\"";}echo">Eventi</a>";
	     	if(isset($_SESSION['usernameU'])){
	     		$username=$_SESSION['usernameU'];
                $db = mysqli_connect('localhost', 'root', '', 'irizzo');

        	    $query = "SELECT * FROM `utenti` WHERE Username='$username'";
                $result = mysqli_query($db,$query) or die(mysql_error());      
                $ris=mysqli_fetch_assoc($result);
                $ruolo=$ris['Ruolo'];
	     		echo"<a href=";if($ruolo=="User"){echo"\"area_riservata_utente.php\"";} else {echo"\"area_admin_utente.php\"";}if($current=="AreaRiservata"){echo"class=\"active\"";}echo">Area personale</a>";}
	     	     
            if(isset($_SESSION['usernameA'])){
                
                echo"<a href=\"area_riservata_azienda.php\""; if($current=="AreaRiservata"){echo"class=\"active\"";}echo">Area personale</a>";
            }

	     	echo"<a href=\"contatti.php\"  ";if($current=="Contatti"){echo"class=\"active\"";}echo">Contatti</a>
	     	
	   	
	  	</div>
      	</div>
        </div>
        <div id='contPrincipale'>
      </header>

";

}
function getBreadcumbs($current){
echo "<div class=\"contenitore\">
			<p id=\"breadcumb\">Sei in : ".$current."</p>
        </div>
  ";
}

function getMessage(){
	if(isset($_SESSION['isOrganize'])){
		echo "
		<p id=\"messaggio\">Per iscriverti agli eventi devi accedere con le tue credenziali,<br> se è la prima volta devi prima <a href=\"registrazione_utente.php\">registrati</a href></p>";
	}
}


function getEventiAzienda(){
    $azienda=$_SESSION['usernameA'];
    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    $sql = "SELECT * FROM `eventi` WHERE azienda='$azienda' ";
    $ris = mysqli_query($db,$sql);
    $errore = array();
    if(mysqli_num_rows($ris)==0){
        $_SESSION['eventiAzienda']=false;
        //array_push($errore,"Errore della query: " . $sql);
    }else {$_SESSION['eventiAzienda']=true;}
    $output = array();
    while ($row = mysqli_fetch_assoc($ris)) {
        array_push($output,$row);
    }
    array_push($output,$errore);
    return $output;
}
function getEventiTutti(){
    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    $sql = "SELECT * FROM `eventi`";
    $ris = mysqli_query($db,$sql);
    $errore = array();
    if(mysqli_num_rows($ris)==0){
        $_SESSION['eventi']=false;
        //array_push($errore,"Errore della query: " . $sql);
    }else {$_SESSION['eventi']=true;}
    $output = array();
    while ($row = mysqli_fetch_assoc($ris)) {
        array_push($output,$row);
    }
    array_push($output,$errore);
    return $output;
}

?>



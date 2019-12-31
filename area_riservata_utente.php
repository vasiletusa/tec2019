<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">


<head>
	<?php 
        include_once 'functions.php'; 
	    getHead("AreaRiservata");
	    $_SESSION['area']=true;
     ?>        
  </head>
<?php getMenu1("AreaRiservata");?>
<?php getMenu2("AreaRiservata");?>

<?php getBreadcumbs("Area personale");?>


<div class="box1">
    <p class="coloreAP">Benvenuto nella tua area personale <?php echo $_SESSION['usernameU']; ?>!</p>
    <div class='destra'><a href="modifica_pw.php" style="color:white;">MODIFICA PASSWORD<a>  </div>
        <div class="end"></div>
    
</div>

<div>
    <div class="sinpersarea">
    	<p class="sottotitoloap">I tour che hai organizzato</p>
        <?php
            require_once('functions.php');
            $output=getTuoiTourOrganizzati();
            $outCat="";
            if($_SESSION['tuoiTour']===true){
            foreach ($output as $elem) {
                if($elem){
                    $outCat.=   "<div class='sfondoAP'>
                                
                                    <div class='sinistraparag'>
                                        <p class='titolo' class='coloret parag'>".$elem['Titolo']."</p>

                                        <p class='descrizione' class='coloret parag'>".$elem['Citta']."</a></p>
                                        <p class='descrizione' class='coloret parag'>".$elem['Data']."</a></p>
                                        <p class='descrizione' class='coloret parag'>".$elem['Organizzatore']."</a></p>
                                    </div>
                                    <div class='sinistraparag'><input type=\"button\" onclick=\"window.location.href = 'dettagliTour.php?id=".$elem['Id']."'\" class=\"buttonDettagli\" value=\"DETTAGLI\"/>  </div>

                                    <div class='end'></div>

                                </div>";
                }
            }}

            else{$outCat.= "<p> <h3>Non hai ancora organizzato tour. <a href='registra_tour.php' class='messageTour'> Organizza </a>il tuo primo tour!<h3></p>";}
            echo $outCat;
            unset($outCat);
        ?>
    </div>
    <div class="sinpersarea">
    	<p class="sottotitoloap">I tour a cui sei iscritto</p>
        <?php
            require_once('functions.php');
            $tuoiTour=getTuoiTourPartecipi();
            $tour=getTour();
            $outCat="";
            if($_SESSION['tuoiTour']===true){

            foreach ($tuoiTour as $elem) {
              
                if($_SESSION['tour']===true){
            	foreach ($tour as $key) {
                    
                    if($key&&$elem){
            		if($elem['IdTour']==$key['Id']){
                       
                    $outCat.=   "<div class='sfondoAP'>
                                
                                    <div class='sinpersarea'>
                                        <p class='titolo' class='coloret parag'>".$key['Titolo']."</p>

                                        <p class='descrizione' class='coloret parag'>".$key['Citta']."</a></p>
                                        <p class='descrizione' class='coloret parag'>".$key['Data']."</a></p>
                                        <p class='descrizione' class='coloret parag'>".$key['Organizzatore']."</a></p>
                                    </div>
                                    <div class='sinpersarea'><input type=\"button\" onclick=\"window.location.href = 'dettagliTour.php?id=".$key['Id']."'\" class=\"buttonDettagli\" value=\"DETTAGLI\"/> </div>
                                    <div class='end'> </div>
                                
                                </div>";
                                break;
                }}
             
        }}
        

    }}  else{$outCat.= "<div><h3> Non ci sono tour a cui partecipi. <a href='tour.php' class='messageTour'> Iscriviti </a>al tuo primo tour!</h3></div>";}
        echo $outCat;
        unset($outCat);
    ?>
</div>

</div>

</body>
<?php getFooter() ?>
<!DOCTYPE html>
<html>
<head>

	<?php 
        include_once 'functions.php'; 
	    getHead("Dettagli evento");
     ?>   
          
  </head>

<?php getMenu("Eventi");?>

<?php getBreadcumbs("Eventi");?>


<?php
           
        require_once('functions.php');
        $evento=getEventoDettagli($_GET['id']);
        $_SESSION['idEvento']=$_GET['id'];
        
        $controlloIscrizione= setIscrivitiBottone();
        $controlloPreferiti= setPreferitiBottone();
  echo   " <div class='box-evento dettagli-evento '>
                                        <div class='box-img img-dettagli'>
                                            <img class='img-evento' src='img/eventi.jpg' alt='immagine evento'>
                                        </div>
                                        <div class='box-evento-indettagli '>
                                            <div class='box-titolo titolo-dettagli'>
                                               
                                                <input id='TitoloEvento' type='text' name='TitoloEvento' class='input insertBox ' value='".$evento['Titolo']."' tabindex='9'>
                                                    
                                            </div>
                                            <div class='box-categoria categoria-dettagli'>
                                               
                                                <input id='TitoloEvento' type='text' name='TitoloEvento' class='input insertBox ' value='".$evento['Categoria']."' tabindex='10'>
                                            </div>
                                            <div class='box-data data-dettagli'>
                                                
                                                <div class='box-data-evento'>
                                                    <input id='TitoloEvento' type='text' name='TitoloEvento' class='input insertBox ' value='".$evento['Data']."' tabindex='11'>
                                                </div>
                                            </div>
                                            
                                            <div class='box-luogo luogo-dettagli'>
                                                
                                                <div class='box-luogo-evento'>
                                                    <input id='TitoloEvento' type='text' name='TitoloEvento' class='input insertBox ' value='".$evento['Luogo']."' tabindex='12'>
                                                </div>
                                            </div>
                                        </div>
                                            <div class='box-descr descr-dettagli'>
                                                
                                                <input id='TitoloEvento' type='text' name='TitoloEvento' class='input insertBox ' value='".$evento['Descrizione']."' tabindex='13'>
                                            </div>
                                        
                                            <div class='box-dettagli prefe-iscrizione'>
                                            
                                                <input type='submit' class=' selezione' name='modifica_evento' tabindex='14' accesskey='m'>Modifica</button>
 
                                            </div>
                            </div>
                                    ";  
?>


                
                
              
</div>



</body>

<?php getFooter() ?>    
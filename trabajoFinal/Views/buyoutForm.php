<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Buyout/showBuyoutResume";?>>
		<div align="center">
     		<h2>Seleccione tarjeta de credito</h2>
            <?php if($creditCards!=false){
                echo '<input type = "hidden" name = "movieFunctionId" value = '.$movieFunctionId.'>
                <input type = "hidden" name = "discount" value = '.$discount.'>
                <input type = "hidden" name = "total" value = '.$total.'>  
                <input type = "hidden" name = "cantTicket" value = '.$cantTicket.'>';
                
                 echo "<select name = 'creditCardId'>";
                    foreach($creditCards as $card){
                        echo "<option value = ".$card->getNumber().">".$card->getDescription()." - ".substr($card->getNumber(), -4)."</option>";
                    }
                    echo "</select>";
                    echo "<br>";
     			    echo "<button type='submit'>Continuar</button>";
                }else{
                    echo "SE DEBE CARGAR TARJETA ANTES DE SEGUIR CON LA OPERACIÓN";
                    echo "<br>";
                    echo "<a class='navbar-brand' href=".FRONT_ROOT.'CreditCard/showCreditCardList'.">Tarjetas</a>";
                }?>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Cancelar</button></form>';
?>

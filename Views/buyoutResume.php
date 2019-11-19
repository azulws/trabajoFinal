<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."Buyout/submit";?>>
        <div align="center">
            <h2>Resumen de compra:</h2>
            <div class="form-register"> 
				 <div class="form-register-ul">
                <h3 style="color:white"> Pelicula: <?php echo $function->getMovie()->getTitle()?></h3>
                <h4 style="color:white"> Dia - Horario: <?php echo $function->getStartDateTime()?></h4>
                <p style="color:white"> Cine: <?php echo $function->getRoom()->getCinema()->getName()?></p> 
                <p style="color:white"> Sala: <?php echo $function->getRoom()->getName()?></p>          
                <p style="color:white"> Total: <?php echo $total?></p>
                <p style="color:white"> Descuento: <?php echo $discount ?></p>
                <p style="color:white"> Método de pago: <?php echo $creditCard->getDescription()." terminada en: ".substr($creditCard->getNumber(), -4)?></p>
                <input type = "hidden" name = "discount" value = <?php echo $discount;?>>
                <input type = "hidden" name = "total" value = <?php echo $total?>>
                <input type = "hidden" name = "cantTicket" value = <?php echo $cantTickets;?>>
                <input type = "hidden" name = "creditCardNumber" value = <?php echo $creditCard->getNumber();?>>
                <input type = "hidden" name = "movieFunctionId" value = <?php echo $function->getMovieFunctionId() ?>>
                <button type = "submit"> Aceptar </button> 
                </div>
            </div>
    </form>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Cancelar</button></form>';
?>
<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Buyout/submit";?>>
        <div align="center">
            <h2>Resumen de compra:</h2>
                <h3> Pelicula: <?php echo $function->getMovie()->getTitle()?></h3>
                <h4> Dia - Horario: <?php echo $function->getStartDateTime()?></h4>
                <p> Cine: <?php echo $function->getCinema()->getName()?></p>           
                <p> Total: <?php echo $total?></p>
                <p> Descuento: <?php echo $discount ?></p>
                <p> Método de pago: <?php echo $creditCard->getDescription()." terminada en: ".substr($creditCard->getNumber(), -4)?></p>
                <input type = "hidden" name = "discount" value = <?php echo $discount;?>>
                <input type = "hidden" name = "total" value = <?php echo $total?>>
                <input type = "hidden" name = "cantTicket" value = <?php echo $cantTickets;?>>
                <input type = "hidden" name = "creditCardNumber" value = <?php echo $creditCard->getNumber();?>>
                <input type = "hidden" name = "movieFunctionId" value = <?php echo $function->getMovieFunctionId() ?>>
                <button type = "submit"> Aceptar </button> 
    </form>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Cancelar</button></form>';
?>
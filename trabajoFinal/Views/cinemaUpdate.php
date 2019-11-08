<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Cinema/UpdateDB";?>>
        <div align="center">
            <h2>Modificar cine: </h2>
                <input type="text" name="name" value="<?php echo $cinema->getName();?>" placeholder="nombre" class="form-control" readonly="readonly"><?php?> 
                <input type="number" name="ticket_value" value="<?php echo $cinema->getTicketValue();?>" placeholder="precio ticket" required class="form-control" min="1">
            <br>
                <input type="number" name="capacity" value="<?php echo $cinema->getCapacity();?>" placeholder="capacity total" required class="form-control" min="10"> 
            <br>
                <button type="submit">Cargar</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>
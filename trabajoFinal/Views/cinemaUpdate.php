<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Cinema/showcinemaListDB";?>>
        <div align="center">
            <?php var_dump($cinema);?>
            <h2>Modificar cine: "<?php echo $cinema->getName();?>"</h2>
                <input type="number" name="ticket_value" value="ticketValue"placeholder="precio ticket" required class="form-control"> <?php //TODO marcar bien el dato?> 
            <br>
                <input type="number" name="capacity" value="<?php $cinema->getCapacity();?>" placeholder="capacity total" required class="form-control"> <?php //TODO marcar bien el dato?> 
            <br>
                <button type="submit">Cargar</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>
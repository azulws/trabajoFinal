<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."Cinema/UpdateDB";?>>
        <div align="center">
            <h2>Modificar cine:</h2>
            <div class="form-register"> 
				 <div class="form-register-ul">
                <input style="width:50%"type="text" name="name" value="<?php echo $cinema->getName();?>" placeholder="nombre" class="form-control" readonly="readonly">
                <p style=color:white;> Dirección: </p>
                <input style="width:50%" type="text" name="address" value="<?php echo $cinema->getAddress();?>" placeholder="dirección" class="form-control" readonly="readonly">
                <p style=color:white;> Precio: </p>
                <input style="width:50%" type="number" name="ticket_value" value="<?php echo $cinema->getTicketValue();?>" placeholder="precio ticket" required class="form-control" min="1">
            <br>
                <input type="hidden" readonly name="id" value=<?php echo $cinema->getId()?>>
                <button type="submit">Actualizar</button>
    </form>
</div>
</div>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>
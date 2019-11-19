<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."Room/Update";?>>
        <div align="center">
            <h2>Modificar sala:</h2>
            <div class="form-register"> 
				 <div class="form-register-ul">
                <input style="width:50%" type="text" name="name" value="<?php echo $room->getName() ?>" placeholder="Nombre" class="form-control" readonly="readonly">
                <p style="color:white;"> Capacidad: </p>
                <input style="width:50%" type="number" name="capacity" value="<?php echo $room->getCapacity() ?>" placeholder="Capacidad" required class="form-control" min="10" max="300">
            <br>
                <input type="hidden" readonly name="roomId" value=<?php echo $room->getId() ?>>
                <input type="hidden" readonly name="cinemaId" value=<?php echo $room->getCinema()->getId() ?>>
                <button type="submit">Actualizar</button>
        </div>
    </form>
</div>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>
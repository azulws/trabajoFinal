<form action="<?php echo FRONT_ROOT."cinema/showcinemaListDB";?>">
	<button type="submit">LISTAR CINES</button>
</form>
<form action="<?php echo FRONT_ROOT."cinema/ShowAddView";?>">
	<button type="submit">AGREGAR CINE</button>
</form>
<form action="<?php echo FRONT_ROOT."Login/showUserListDB";?>">
	<button type="submit">LISTAR USUARIOS</button>
</form>
<form action="<?php echo FRONT_ROOT."Movie/moviesToDB";?>">
	<button type="submit">CARGAR PELICULAS DE API A DB</button>
</form>
<form action="<?php echo FRONT_ROOT."Genre/genresToDB";?>">
	<button type="submit">CARGAR GENEROS DE API A DB</button>
</form>
<form action="<?php echo FRONT_ROOT."MovieFunction/showAddView";?>">
	<button type="submit">AGREGAR FUNCIONES</button>
</form>
<form action="<?php echo FRONT_ROOT."MovieFunction/showMovieFunctionListDB";?>">
	<button type="submit">MOSTRAR FUNCIONES</button>
</form>
<form action="<?php echo FRONT_ROOT."MovieFunction/showMovieFunctionOrderByTimeDB";?>">
	<button type="submit">MOSTRAR FUNCIONES POR FECHA</button>
</form>
<form action="<?php echo FRONT_ROOT."MovieFunction/listMovieFunctionListDB";?>">
	<button type="submit">MOSTRAR PELICULAS EN CARTELERA</button>
</form>
<form action="<?php echo FRONT_ROOT."MovieFunction/showMovieFunctionByGenreDB";?>">
	<button type="submit">MOSTRAR POR GENEROS</button>
</form>

<form action="<?php echo FRONT_ROOT."Home/index";?>">
    <button>Desconectar</button>
</form>
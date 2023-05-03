<!DOCTYPE html>
<html>
<head>
	<title>Sistema Inglés</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<nav>
		<ul>
			<li><a href="frances.php">Sistema Francés</a></li>
			<li><a href="aleman.php">Sistema Alemán</a></li>
			<li><a href="ingles.php">Sistema Inglés</a></li>
			<li><a href="flat.php">Sistema Flat</a></li>
		</ul>
	</nav>
	<div class="container">
		<h1>Sistema Inglés</h1>
		<form method="post">
			<label for="prestamo">Préstamo:</label>
			<input type="text" name="prestamo" id="prestamo" required>

			<label for="tiempo">Tiempo (en meses):</label>
            <input type="text" name="tiempo" id="tiempo" required>

			<label for="tasa">Tasa de interés (% mensual):</label>
				<input type="text" name="tasa" id="tasa" required>

			<input type="submit" value="Calcular tabla de amortización">
		</form>

    <?php
        if(isset($_POST['prestamo']) && isset($_POST['tiempo']) && isset($_POST['tasa'])){
            $prestamo = $_POST['prestamo'];
            $tiempo = $_POST['tiempo'];
            $tasa = $_POST['tasa'] /100;
        
            $interes = $prestamo * $tasa;
            $amortizacion = 0; // calcular la amortización del periodo
        
            echo "<h4>Interes: $interes</h4>";
        
            echo "<h2>Tabla de amortización</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Período</th><th>Interes</th><th>Mensualidad</th><th>Amortización</th><th>Saldo</th></tr>";
            for ($i=0; $i<=$tiempo; $i++){
                echo "<tr>";
                echo "<td>$i</td>";
        
                if ($i == 0) {
                    echo "<td></td><td></td><td></td>"; // si es el primer periodo, mostrar las casillas vacías
                    echo "<td>$prestamo</td>"; // mostrar el prestamo en la columna Saldo
                } else {
                    echo "<td>$" . number_format($interes, 2) . "</td>";
        
                    if ($i == $tiempo) {
                        $mensualidad = $interes + $prestamo;
                        echo "<td>$" . number_format($mensualidad, 2) . "</td>";
                        echo "<td>$" . number_format($prestamo, 2) ."</td>";
                    } else {
                        $mensualidad = $interes + $amortizacion;
                        echo "<td>$" . number_format($mensualidad, 2) . "</td>"; // en caso contrario, mostrar cero
                        echo "<td>$0.00</td>";
                    }
        
                    $saldo_actual = $saldo_anterior - $amortizacion; // calcular el saldo actual
                    echo "<td>$" . number_format($saldo_actual, 2) . "</td>";
                }
        
                echo "</tr>";
        
                // actualizar el valor del saldo para el siguiente periodo
                $saldo_anterior = isset($saldo_actual) ? $saldo_actual : $prestamo;

            }
            echo "</table>";
        }

    ?>
 


	</div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema Francés</title>
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
		<h1>Sistema Francés</h1>
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
    
        $complemen = (1 + $tasa) ** $tiempo;
        $complemen2 = ($complemen - 1) / ($tasa*$complemen);
        $anualidad = $prestamo / $complemen2;
        echo "<h4>Anualidad Constante: $anualidad</h4>";
    
        echo "<h2>Tabla de amortización</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Período</th><th>Mensualidad</th><th>Interés</th><th>Amortización</th><th>Saldo</th></tr>";
        for ($i=0; $i<=$tiempo; $i++){
            echo "<tr>";
            echo "<td>$i</td>";
    
            if ($i == 0) {
                echo "<td></td><td></td><td></td>"; // si es el primer periodo, mostrar las casillas vacías
                echo "<td>$prestamo</td>"; // mostrar el prestamo en la columna Saldo
            } else {
                echo "<td>$" . number_format($anualidad, 2) . "</td>";
    
                $interes_periodo = $tasa * floatval($saldo_anterior); // calcular el interés del periodo
                echo "<td>$" . number_format($interes_periodo, 2) . "</td>";
    
                $amortizacion = $anualidad - $interes_periodo; // calcular la amortización del periodo
                echo "<td>$" . number_format($amortizacion, 2) . "</td>";
    
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

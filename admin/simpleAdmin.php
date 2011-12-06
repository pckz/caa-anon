<?php

class simpleAdmin {

  public function display_public() {
  	$q = "SELECT * FROM comments ORDER BY id DESC";
    $r = mysql_query($q);

    if ( $r !== false && mysql_num_rows($r) > 0 ) {
    	$entry_display = "<table>";
    	$entry_display = $entry_display."<tr><th>Nombre</th>";
    	$entry_display = $entry_display."<th>Texto</th>";
    	$entry_display = $entry_display."<th>Borrar?</th></tr>";
      while ( $a = mysql_fetch_assoc($r) ) {
      	$id = stripslashes($a['id']);
      	$id = "<a href='?id=".$id."'>borrar</a>";
        $name = stripslashes($a['name']);
        $bodytext = stripslashes($a['body']);

        $entry_display .= <<<ENTRY_DISPLAY
        <tr>
        	<td>$name</td>
        	<td>$bodytext</td>
        	<td>$id</td>
        </tr>
ENTRY_DISPLAY;
      }
      $entry_display = $entry_display."</table>";
    } else {
      $entry_display = <<<ENTRY_DISPLAY

    <h2>No hay datos para desplegar</h2>
    <p>
      No se ha encontrado ning&#250;n comentario
    </p>

ENTRY_DISPLAY;
    }

    return $entry_display;
  	
  }

  public function delete_id($id) {
  	$q = "DELETE FROM comments WHERE id=".$id;
    $r = mysql_query($q);
    if ($r !== false) {
    	$response = "Comentario borrado satisfactoriamente";
    } else {
    	$response = "Error: No se pudo borrar el comentario";
    } 
    return $response;
  }
}

?>
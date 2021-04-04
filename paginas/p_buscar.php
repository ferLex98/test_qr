<div class="container bg-light shadow">
    <?php
     $accion="listado";
     if(isset($_REQUEST['accion'])){
         $accion=$_REQUEST['accion'];
     }
     switch($accion):
        case "listado";
            ?>
            <h1 class="m-2 p-2">Representantes</h1>
            <a href="?pagina=p_buscar&accion=insertar" class="btn btn-danger">CREAR</a>
            <table class="table">
                <thead>
                    <th>ID</th>Nombre<th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                        $u=$user->buscar("qr_persona","1");
                        foreach($u as $r): //hace la consulta a la tabla                         
                        ?>
                        <tr>
                            <td><?php echo $r['id_persona']; ?></td>
                            <td><?php echo $r['nombres_persona']; ?></td>
                            <td>
                                <a href="?pagina=p_buscar&accion=editar" class="btn btn-danger">Editar</a>
                                <a href="?pagina=p_buscar&accion=eliminar" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr> 
                        <?php endforeach;?>
                </tbody>
            </table>
            <?php
            echo "listado";
        break;
        case "insertar";
            if(isset($_POST['btn'])):
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $direccion = $_POST['direccion'];
                $nomRep = $_POST['nomRep'];
                $descripcion = $_POST['descripcion'];
                $foto     = "foto.jpg";
                ///aqui se arma la cadena para insertar
                $data="'".$id."','".$nombre."','".$apellido."','".$direccion."','".$nomRep."','".$descripcion."','".$foto."'";
                $u=$user->insertar("qr_persona",$data);
                if($u)
                    echo "Insercion correcta";
                else
                    echo "Error al insertar datos";
                /////////////////7
            else:
                ?>
                <div class="col-sm-8">
                    <form method="post"  enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="id">Cédula</label>
                            <input type="text" class="form-control" name="id" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombres</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" name="apellido" require>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" class="form-control" name="direccion" require>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" require>
                        </div>
                        <div class="form-group">
                            <label for="nomRep">Nombre del Representante</label>
                            <input type="text" class="form-control" name="nomRep" require>
                        </div>    
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" name="descripcion" require></textarea>
                        </div>  
                        <input type="submit" name="btn" value="GENERAR">
                    </form>
                </div>
                <?php
            endif;
        break;
        case "editar";
            echo "editar";
        break;
        case "eliminar";
            echo "eliminar";
        break;       
    endswitch;
    ?>
</div>
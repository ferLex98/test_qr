<div class="container bg-light shadow">
    <?php
        /*listado; insertar; editar; eliminar*/
        $accion="listado";
        if(isset($_REQUEST['accion'])){
            $accion=$_REQUEST['accion'];
        }
        switch($accion):
            case "listado";
                ?>
                <h1 class="m-2 p-2">Representantes</h1>
                <a href="?pagina=representantes&accion=insertar" class="btn btn-danger">CREAR</a>
                <table class="table">
                    <thead>
                        <th>ID</th><th>Nombre</th><th>Qr</th><th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php
                            $u=$user->buscar("qr_representante","1");
                            foreach($u as $r): //hace la consulta a la tabla                         
                            ?>
                            <tr>
                                <td><?php echo $r['ced_represent']; ?></td>
                                <td><?php echo $r['nom_representante']; ?></td>
                                <td><img src="Imagenes/qr/<?php echo $r['qr'];?>" alt=""></td>
                                <td>
                                    <a href="?pagina=representantes&accion=editar&cedula=<?php echo $r['ced_represent']?>" class="btn btn-danger">Editar</a>
                                    <a href="?pagina=representantes&accion=eliminar" class="btn btn-danger">Eliminar</a>
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
                    $ced_represent = $_POST['cedula'];
                    $nom_representante = $_POST['nombre'];
                    $ape_representante= $_POST['apellido'];
                    $tlf_contacto= $_POST['telefono'];
                    $preg_seguridad = $_POST['pregunta'];
                    $respuesta_seguridad= $_POST['respuesta'];
                    ///////////SUBIR IMAGENES AL SERVIDOR
                    $foto_representante = $_FILES['foto']['name'];
                    if(move_uploaded_file($_FILES['foto']['tmp_name'],"Imagenes/.$foto_representante"))
                        echo "Foto subida Correctamente";
                    else
                        echo "Error foto subida";
                    $qr="prueba.png";
                    //><<<<<<<<<<<<<<<
                    ///////////GenerarQr
                    ///aqui se arma la cadena para insertar
                    $data="'".$ced_represent."','".$nom_representante."','".$ape_representante."','".$tlf_contacto."','".$preg_seguridad."','".$respuesta_seguridad."','".$foto_representante."','".$qr."'";
                    $u=$user->insertar("qr_representante",$data);
                    
                    if($u):
                        require "class/phpqrcode/qrlib.php";
                        QRcode::png( $ced_represent,"Imagenes/qr/qr_".$ced_represent.".png",'L',10,5);
                        $user->actualizar("qr_representante","qr='qr_".$ced_represent.".png'","ced_represent='".$ced_represent."'");
                        echo "Insercion correcta";
                    else:
                        echo "Error al insertar datos";
                    endif;
                    /////////////////7
                else:
                    ?>
                    <div class="col-sm-8">
                        <form method="post"  enctype="multipart/form-data" action="">
                            <div class="form-group">
                                <label for="cedula">Cédula</label>
                                <input type="text" class="form-control" name="cedula" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombres</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" name="apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" name="telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="pregunta">Pregunta de Seguridad</label>
                                <input type="text" class="form-control" name="pregunta" required>
                            </div>
                            <div class="form-group">
                                <label for="respuesta">Respuesta</label>
                                <input type="text" class="form-control" name="respuesta" require>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" name="foto" required>
                            </div>
                            <input type="submit" name="btn" value="GENERAR">
                        </form>
                    </div>
                    <?php
                endif;
            break;
            case "editar";
            if(isset($_POST['btn'])):
                $nom_representante = $_POST['nombre'];
                $ape_representante= $_POST['apellido'];
                $tlf_contacto= $_POST['telefono'];
                $preg_seguridad = $_POST['pregunta'];
                $respuesta_seguridad= $_POST['respuesta'];
                
                ///////////SUBIR IMAGENES AL SERVIDOR
                $foto_representante = $_FILES['foto']['name'];
                if(move_uploaded_file($_FILES['foto']['tmp_name'],"Imagenes/.$foto_representante"))
                    echo "Foto subida Correctamente";
                else
                    echo "Error foto subida";
                $qr="prueba.png";
                
                //><<<<<<<<<<<<<<<
                ///////////GenerarQr
                ///aqui se arma la cadena para insertar
                $data="nom_representante='".$nom_representante."',ape_representante='".$ape_representante."',tlf_contacto='".$tlf_contacto."',preg_seguridad='".$preg_seguridad."',respuesta_seguridad='".$respuesta_seguridad."',foto_representante='".$foto_representante."'";
                $u=$user->actualizar("qr_representante",$data,"ced_represent='".$_REQUEST['cedula']."'");
                
                if($u):
                    //require "class/phpqrcode/qrlib.php";
                    //QRcode::png( $ced_represent,"Imagenes/qr/qr_".$ced_represent.".png",'L',10,5);
                    //$user->actualizar("qr_representante","qr='qr_".$ced_represent.".png'","ced_represent='".$ced_represent."'");
                    echo "Edicion correcta";
                else:
                    echo "Error al editar datos";
                endif;
                /////////////////7
            else:
                
                $u=$user->buscar("qr_representante","ced_represent='".$_REQUEST['cedula']."'");
                foreach($u as $r):
                ?>
                <div class="col-sm-8">
                    <form method="post"  enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="nombre">Nombres</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo $r['nom_representante']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" name="apellido" value="<?php echo $r['ape_representante']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control" name="telefono" value="<?php echo $r['tlf_contacto']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pregunta">Pregunta de Seguridad</label>
                            <input type="text" class="form-control" name="pregunta" value="<?php echo $r['preg_seguridad']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="respuesta">Respuesta</label>
                            <input type="text" class="form-control" name="respuesta" value="<?php echo $r['respuesta_seguridad']?>" require>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                             <?php/// pendiente la foto?>
                            <input type="file" class="form-control" name="foto" value="<?php echo $r['foto_representante']?>" >
                        </div>
                        <input type="submit" name="btn" value="Actualizar">
                        <input type="hidden" value="<?php echo $_REQUEST['ced_represent'] ?>">
                    </form>
                </div>
                <?php
                endforeach;
            endif;
                
            break;
            case "eliminar";
                echo "eliminar";
            break;       
        endswitch;
        
    ?>
</div>
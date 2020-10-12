<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<div class="table-responsive">
  <table class="table table-striped table-dark text-center">
    <div class="text-center">
      <br>
      <!-- <a class="btn btn-success text-center" href="<?= base_url ?>usuario/generarPDF_profesor"><span class="glyphicon glyphicon-plus"></span> Generar PDF</a>
     --></div>
    <br>
    <tr class="">
      <th>ID</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Usuario</th>
      <!-- <th>Contraseña</th> -->
      <!-- No mostramos la contraseña -->
      <th>Perfil</th>
      <th>Email</th>
      <th>Fotografia</th>
      <th>Telefono</th>
      <th>Departamento</th>
      <th>Fecha</th>
      <th></th>
    </tr>
    <?php while ($lista = $listado_usuarios->fetch_object()) : ?>
      <tr>
        <td><?= $lista->id; ?></td>
        <td><?= $lista->nombre; ?></td>
        <td><?= $lista->apellido1 . ' ' . $lista->apellido2; ?></td>
        <td><?= $lista->username; ?></td>
        <!-- <td><?= $lista->password; ?></td> -->
        <!-- No mostramos la contraseña -->
        <td><?= $lista->perfil; ?></td>
        <td><?= $lista->email; ?></td>
        <?php if (isset($lista) && is_object($lista) && !empty($lista->fotografia)) : ?>
          <td><img src="<?= base_url ?>uploads/images/<?= $lista->fotografia ?>" class="miniatura" /></td>
        <?php else : ?>
          <td></td>
        <?php endif; ?>
        <td><?= $lista->telefono; ?></td>
        <td><?= $lista->departamento; ?></td>
        <td><?= $lista->fecha; ?></td>
        <td>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Responder<?= $lista->id ?>">Enviar</button>
          <!-- Modal -->
          <div class="modal fade text-dark" id="Responder<?= $lista->id ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Nuevo Mensaje</h5>
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Asunto:</label>
                      <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Mensaje:</label>
                      <textarea class="form-control" id="message-text"></textarea>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" role="link" onclick="window.location = '<?= base_url ?>usuario/editar&id=<?= $lista->id ?>'">Enviar</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal -->
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <div>



  </div>

  <!-- MENU DE NAVEGACION INFERIOR (PAGINACION)  -->
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="btn btn-outline-primary" href="<?= base_url ?>usuario/usuarios_profesor&pagina=<?= 1 ?>" tabindex="-1" aria-disabled="true">Primero</a>
      </li>
      <li class="page-item">
        <a class="btn btn-outline-primary" href="<?= base_url ?>usuario/usuarios_profesor&pagina=<?= $pagina - 1 ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>

      <?php for ($i = 1; $i <= $total_paginas; $i++) {
        if ($i == $pagina) {
          echo "<li class='page-item disabled'><a class='btn btn-warning'>$i</a></li>";
        } else {
          echo "<li class='page-item'><a class='btn btn-outline-primary' href='usuarios_profesor&pagina=$i'>$i</a></li>";
        }
      } ?>

      <li class="page-item">
        <a class="btn btn-outline-primary" href="<?= base_url ?>usuario/usuarios_profesor&pagina=<?php echo ($pagina < $total_paginas) ? $pagina + 1 : $pagina = $pagina; ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      <li class="page-item">
        <a class="btn btn-outline-primary" href="<?= base_url ?>usuario/usuarios_profesor&pagina=<?= $total_paginas ?>">Ultimo</a>
      </li>
    </ul>
  </nav>
  <!-- MENU DE NAVEGACION INFERIOR (PAGINACION)  -->

  <?php Utils::deleteSession('register'); ?>
  <?php Utils::deleteSession('delete'); ?>

  <?php require_once 'includes/footer.php'; ?>
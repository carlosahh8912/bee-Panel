<div class="modal fade" id="userModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
        <div id="headerModal" class="modal-header bg-info">
            <h4 class="modal-title" id="titleModal">Nuevo Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <!-- form start -->
            <form id="formUser" name="formUser">
                <div class="modal-body">
                    <input type="hidden" id="idUser" name="idUser" value="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nameUser">Nombre</label>
                            <input type="text" class="form-control" id="nameUser" name="nameUser" placeholder="Nombre del Usuario" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastnameUser">Apellido</label>
                            <input type="text" class="form-control" id="lastnameUser" name="lastnameUser" placeholder="Apellido del Usuario" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="claveUser">Clave</label>
                            <input type="text" class="form-control" id="claveUser" name="claveUser" placeholder="Identificación del Usuario" onkeypress="return controlTag(event);">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailUser">Correo</label>
                            <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="Correo Electrónico" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="selectRoleUser">Tipo de Usuario</label>
                            <select id="selectRoleUser" name="selectRoleUser" class="form-control select2bs4"  required> </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="selectStatusUser">Estatus</label>
                            <select id="selectStatusUser" name="selectStatusUser" class="form-control select2bs4"  required>
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passwordUser">Contraseña</label>
                        <input type="password" class="form-control" id="passwordUser" name="passwordUser" placeholder="Contraseña">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnActionForm" class="btn btn-success"><span id="btnText">Guardar</span></button>
                </div>
            </form>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modalViewUser">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div id="headerModal" class="modal-header bg-info">
            <h4 class="modal-title" id="titleModal">Datos del Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Resumen Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>ID:</th>
                            <td id="celId">jd010205mp0</td>
                        </tr>
                        <tr>
                            <th>Nombre:</th>
                            <td id="celNombre">Jhon Doe</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td id="celEmail">correo@correo.com</td>
                        </tr>
                        <tr>
                            <th>Tipo de Usuario:</th>
                            <td id="celTipo">Usuario</td>
                        </tr>
                        <tr>
                            <th>Estatus:</th>
                            <td id="celEstatus">Activo</td>
                        </tr>
                        <tr>
                            <th>Fecha de Registro:</th>
                            <td id="celFecha">00/00/00</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Datos de Ultimo Ingresos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>IP:</th>
                            <td id="celIp"></td>
                        </tr>
                        <tr>
                            <th>Explorador:</th>
                            <td id="celExplorer"></td>
                        </tr>
                        <tr>
                            <th>SO:</th>
                            <td id="celOs"></td>
                        </tr>
                        <tr>
                            <th>Fecha:</th>
                            <td id="celIngreso"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.modal-body -->

            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="userModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
                    <div class="form-group">
                        <label for="txtNombreUser">Nombre</label>
                        <input type="text" class="form-control" id="txtNombreUser" name="txtNombreUser" placeholder="Nombre del Usuario">
                    </div>
                    <div class="form-group">
                        <label for="txtApellidoUser">Apellido</label>
                        <input type="text" class="form-control" id="txtApellidoUser" name="txtApellidoUser" placeholder="Apellido del Usuario">
                    </div>
                    <div class="form-group">
                        <label for="txtEmailUser">Correo</label>
                        <input type="email" class="form-control" id="txtEmailUser" name="txtEmailUser" placeholder="Correo Electrónico">
                    </div>
                    <div class="form-group">
                        <label for="selectTipoUser">Tipo de Usuario</label>
                        <select id="selectTipoUser" name="selectTipoUser" class="form-control select2bs4" >
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectEstatusUser">Estatus</label>
                        <select id="selectEstatusUser" name="selectEstatusUser" class="form-control select2bs4" >
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtPasswordUser">Contraseña</label>
                        <input type="password" class="form-control" id="txtPasswordUser" name="txtPasswordUser" placeholder="Contraseña">
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
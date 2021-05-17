<div class="modal fade" id="rolesModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div id="headerModal" class="modal-header bg-gradient-dark">
            <h4 class="modal-title" id="titleModal">Nuevo Rol</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <!-- form start -->
            <form id="formRol" name="formRol">
                <div class="modal-body">
                    <input type="hidden" id="idRole" name="idRole" value="">
                    <div class="form-group">
                        <label for="nameRole">Nombre</label>
                        <input type="text" class="form-control" id="nameRole" name="nameRole" placeholder="Nombre del Rol">
                    </div>
                    <div class="form-group">
                        <label for="descriptionRole">Descripción</label>
                        <textarea rows="2" class="form-control" id="descriptionRole" name="descriptionRole" placeholder="Descripción o funciones del Rol"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="selectStatusRole">Estatus</label>
                        <select id="selectStatusRole" name="selectStatusRole" class="form-control select2bs4" >
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                        </select>
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


<div class="modal fade" id="modalPermisos">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
        <div id="headerModal" class="modal-header bg-info">
            <h4 class="modal-title" id="titleModal">Permisos del Rol</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <!-- form start -->
            <form id="formPermisos" name="formPermisos">
                <div class="modal-body">
                <input type="hidden" id="idrol" name="idrol" value="" required>
                    <table class="table table-bordered table-responsive-lg table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Modulo</th>
                                <th class="text-center" scope="col">Ver</th>
                                <th class="text-center" scope="col">Crear</th>
                                <th class="text-center" scope="col">Actualizar</th>
                                <th class="text-center" scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>Dashboard</td>
                                <td class="text-center">
                                    <input type="checkbox" class="b4cb" data-on="SI" data-off="NO" data-onstyle="success" data-toggle="toggle">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" class="b4cb" data-on="SI" data-off="NO" data-onstyle="success" data-toggle="toggle"> 
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" class="b4cb" data-on="SI" data-off="NO" data-onstyle="success" data-toggle="toggle">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" class="b4cb" data-on="SI" data-off="NO" data-onstyle="success" data-toggle="toggle">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="" class="btn btn-success"><span id="btnText">Guardar</span></button>
                </div>
            </form>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
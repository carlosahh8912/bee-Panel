<div class="modal fade" id="rolesModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div id="headerModal" class="modal-header bg-info">
            <h4 class="modal-title" id="titleModal">Nuevo Rol</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <!-- form start -->
            <form id="formRol" name="formRol">
                <div class="modal-body">
                    <input type="hidden" id="idRol" name="idRol" value="">
                    <div class="form-group">
                        <label for="txtNombreRol">Nombre</label>
                        <input type="text" class="form-control" id="txtNombreRol" name="txtNombreRol" placeholder="Nombre del Rol">
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcionRol">Descripción</label>
                        <textarea rows="2" class="form-control" id="txtDescripcionRol" name="txtDescripcionRol" placeholder="Descripción o funciones del Rol"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="estatusRol">Estatus</label>
                        <select id="estatusRol" name="estatusRol" class="form-control select2bs4" >
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div> -->
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
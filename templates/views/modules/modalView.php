<div class="modal fade" id="moduleModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
        <div id="headerModal" class="modal-header bg-gradient-info">
            <h4 class="modal-title" id="titleModal">Nuevo Modulo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <!-- form start -->
            <form id="formModule" name="formUModule">
                <div class="modal-body">
                    <input type="hidden" id="idModule" name="idModule" value="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nameModule">Nombre del Modulo</label>
                            <input type="text" class="form-control validText" id="nameModule" name="nameModule" placeholder="Ej: Dashboard" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iconModule">Icono Font Awesome</label>
                            <input type="text" class="form-control validText" id="iconModule" name="iconModule" placeholder="Ej: fas fa-users" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="urlModule">URL a la que apunta</label>
                            <input type="text" class="form-control validText" id="urlModule" name="urlModule" placeholder="Ej: home">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="activeModule">Mostrar activo cuando este en la URL</label>
                            <input type="text" class="form-control validEmail" id="activeModule" name="activeModule" placeholder="Ej: home" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="selectTypeModule">Vista de Arbol</label>
                            <select id="selectTypeModule" name="selectTypeModule" class="form-control select2bs4"  > 
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="selectEstatusModule">Estatus</label>
                            <select id="selectEstatusModule" name="selectEstatusModule" class="form-control select2bs4"  >
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
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
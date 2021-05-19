<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo isset($d->subject) ? $d->subject : 'No hay asunto en el correo electrónico'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; 
      }
    </style>
  </head>
  <body class="bg-light">
    <span class="d-none"><?php echo isset($d->alt) ? $d->alt : 'Un nuevo correo electrónico'; ?></span>
    <div class="container">
      <div class="row p-3">
        <div class="col-12 text-center py-4">
      
          <img src="<?php echo IMAGES.'bee_logo.png'; ?>" alt="<?php echo get_sitename(); ?>" style="width: 150px;">

        </div>

        <div class="col-12 p-5">
          <?php echo isset($d->body) ? $d->body : ''; ?>
        </div>   
            
                        
            
            <div class="col-12 py-2 text-center text-muted">
                    <p><small><span class="apple-link">Una calle en México #123, Dentro de una Colonia, CDMX, 87560</span><br>
                    Correo generado automáticamente <a href="https://github.com/Moxtrip69/Bee-Framework">www.bee-panel.test</a>.</small></p>
              
                    <p class="py-3"><small><em>Creado por <a href="http://bee-panel.test">Bee-Panel</a>.</em></small></p>
            </div>
            <!-- END FOOTER -->

          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
        
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>

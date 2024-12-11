<div class="mb-3">
                <label for="recipient-img" class="form-label">Foto de perfil:</label><br>
                <?php
                if (empty($infoPerfil['img'])) {?>
                  <input class="form-control" type="file" id="recipient-img" name="imgUser"><?php
                }
                else {
                  $img = $infoPerfil['img'] ?>                  
                  <img src="img/profiles/<?php echo $img?>" class="img-thumbnail" width="160px" height="160px" alt="profile"></img>
                  <!--<input class="form-control" type="file" id="recipient-img" name="imgUser" value="Cambiar imagen">--><?php
                }?>

              </div>
              <!--test-->
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>
<div class="row">
	<div class="large-4 columns large-centered" >
    <h2 style="text-align: center">Imprime tus Victimas</h2>
    <form method="post" action="<?=base_url()?>pdfs/generar" />
    <table align="center">
        <tr>
            <td>
                <select name="gestion" id="gestion">
            		    <option value="">Selecciona la Gestión</option>
            		    <?php
            		    foreach($gestiones as $fila)
            		    {
              		    ?>
              		    <option value=<?=$fila->id_gestion?>><?=$fila->gestion?></option>
              		    <?php
            			  }
            		    ?>
        		      </select>
            </td>
        </tr>
        <tr>
    	    <td align="center" colspan="7">
    	    <hr />
    	        <input type="submit" value="Crear PDF" title="Crear PDF" />
            </td>
        </tr>
    </table>
    </form>
  </div>
</div>

<?php $this->load->view('seccion/pie'); ?>

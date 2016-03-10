<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('cuota/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
         &nbsp;<a class="btn2" href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
          <?php if (!$form->getObject()->isNew()): ?>
            <?php echo link_to('<span class="btn2"><img src="/images/borrar.png"> Borrar</span>', 'cuota/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Confirmar Grabar')) ?>
          <?php endif; ?>
<input type='hidden' id='volver' name='volver' value="">
<a class="btn2" href="javascript:grabarcuota();"><input type="image" id="grabar33" src="/images/grabar.png"/> Grabar</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
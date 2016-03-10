<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('rubro/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
         &nbsp;<a href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
          <?php if (!$form->getObject()->isNew()): ?>
            -&nbsp;<?php echo link_to('<img src="/images/borrar.png"> Borrar', 'rubro/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Confirmar Grabar')) ?>
          <?php endif; ?>
-&nbsp;<a href="javascript:$('#grabar').click();"><input type="image" id="grabar" src="/images/grabar.png"/> Grabar</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>

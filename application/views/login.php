<div class="row">
  <div class="col-lg-offset-3 col-lg-6">
    <h1 style="margin-left: 20px; margin-bottom: 20px">Health Care Hospital</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="well bs-component">
      <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'signin')); ?>
        <fieldset>
          <legend>Sign In</legend>
          <?php if (isset($msg) && isset($typ) && $typ = 'ERR') { ?>
          <div class="form-group">
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Oops!</strong> <?php echo($msg); ?>
            </div>
          </div>
          <?php } ?>
          <div class="form-group">
            <label for="inputEmail" class="col-md-2 control-label">Username</label>
            <div class="col-md-10">
              <?php echo form_input(array('type' => 'text', 'required' => TRUE, 'class' => 'form-control', 'id' => 'u', 'value' => $this->input->post('u'), 'name' => 'u', 'placeholder' => 'Username', 'autocomplete' => 'off', 'style' => 'background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAkCAYAAADo6zjiAAAAAXNSR0IArs4c6QAAAbNJREFUWAntV8FqwkAQnaymUkpChB7tKSfxWCie/Yb+gbdeCqGf0YsQ+hU95QNyDoWCF/HkqdeiIaEUqyZ1ArvodrOHxanQOiCzO28y781skKwFW3scPV1/febP69XqarNeNTB2KGs07U3Ttt/Ozp3bh/u7V7muheQf6ftLUWyYDB5yz1ijuPAub2QRDDunJsdGkAO55KYYjl0OUu1VXOzQZ64Tr+IiPXedGI79bQHdbheCIAD0dUY6gV6vB67rAvo6IxVgWVbFy71KBKkAFaEc2xPQarXA931ot9tyHphiPwpJgSbfe54Hw+EQHMfZ/msVEEURjMfjCjbFeG2dFxPo9/sVOSYzxmAwGIjnTDFRQLMQAjQ5pJAQkCQJ5HlekeERxHEsiE0xUUCzEO9AmqYQhiF0Oh2Yz+ewWCzEY6aYKKBZCAGYs1wuYTabKdNNMWWxnaA4gp3Yry5JBZRlWTXDvaozUgGTyQSyLAP0dbb3DtQlmcan0yngT2ekE9ARc+z4AvC7nauh9iouhpcGamJeX8XF8MaClwaeROWRA7nk+tUnyzGvZrKg0/40gdME/t8EvgG0/NOS6v9NHQAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;')); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword" class="col-md-2 control-label">Password</label>
            <div class="col-md-10">
              <?php echo form_password(array('class' => 'form-control', 'required' => TRUE, 'id' => 'p', 'value' => $this->input->post('p'), 'name' => 'p', 'placeholder' => 'Password', 'autocomplete' => 'off', 'style' => 'background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAkCAYAAADo6zjiAAAAAXNSR0IArs4c6QAAAbNJREFUWAntV8FqwkAQnaymUkpChB7tKSfxWCie/Yb+gbdeCqGf0YsQ+hU95QNyDoWCF/HkqdeiIaEUqyZ1ArvodrOHxanQOiCzO28y781skKwFW3scPV1/febP69XqarNeNTB2KGs07U3Ttt/Ozp3bh/u7V7muheQf6ftLUWyYDB5yz1ijuPAub2QRDDunJsdGkAO55KYYjl0OUu1VXOzQZ64Tr+IiPXedGI79bQHdbheCIAD0dUY6gV6vB67rAvo6IxVgWVbFy71KBKkAFaEc2xPQarXA931ot9tyHphiPwpJgSbfe54Hw+EQHMfZ/msVEEURjMfjCjbFeG2dFxPo9/sVOSYzxmAwGIjnTDFRQLMQAjQ5pJAQkCQJ5HlekeERxHEsiE0xUUCzEO9AmqYQhiF0Oh2Yz+ewWCzEY6aYKKBZCAGYs1wuYTabKdNNMWWxnaA4gp3Yry5JBZRlWTXDvaozUgGTyQSyLAP0dbb3DtQlmcan0yngT2ekE9ARc+z4AvC7nauh9iouhpcGamJeX8XF8MaClwaeROWRA7nk+tUnyzGvZrKg0/40gdME/t8EvgG0/NOS6v9NHQAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;')); ?>
              <div class="checkbox">
                <label>
                  <?php echo form_checkbox(array()) ?> Remember me
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <?php echo form_submit('submit', 'Sign in', array('class' => 'btn btn-primary pull-right')) ?>
              <?php echo form_reset('reset', 'Reset', array('class' => 'btn btn-default pull-right')) ?>
            </div>
          </div>
        </fieldset>
      </form>
    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
    <!-- <div id="source-button" class="btn btn-default btn-xs" style="display: none;">&lt; &gt;</div></div> -->
  </div>
</div>

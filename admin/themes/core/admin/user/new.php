<h1 class="uk-panel-title"><i class='uk-icon uk-icon-large uk-icon-edit'></i> Nuovo utente</h1><form class='uk-form uk-form-stacked' action='<?php echo $this->router->alias('user.save'); ?>' method="POST">    <div class="uk-panel uk-panel-box uk-panel-box-secondary">        <fieldset>            <div class="uk-form-row">                <label for="email" class="uk-form-label">Email: </label>                <input type="email" id="email" name="email" required="" value="<?php echo isset($user->email) ? $user->email : "" ?>">                <label for="password" class="uk-form-label">Password: </label>                <input type="password" id="password" name="password" required="">                <label for="role" class="uk-form-label">Ruolo: </label>                <select name="role" id="role">                    <?php foreach($rolesList as $role):?>                    <?php                         $selected = (isset($user) && $user->role()==$role->id) ? "selected" : "";                          ?>                    <option <?php echo  $selected ?>  value="<?php echo $role->id?>"><?php echo $role->title?></option>                    <?php endforeach;?>                </select>                <label for="status" class="uk-form-label">Stato: </label>                <select name="status" id="status">                    <?php foreach($states as $key => $state):?>                        <?php                        $selected = "";                        if (isset($user)) {                            $selected = $user->status == $key ? "selected" : "";                        }                        ?>                        <option <?php echo $selected?>  value="<?php echo $key?>"><?php echo $state?></option>                    <?php endforeach;?>                </select>            </div>        </fieldset>    </div>    <input type='hidden' value='<?php echo isset($user->id) ? $user->id : ""?>' name='id'></form><script>    $(document).ready(function(){        $('#yx-save-btn').on('click', function() {            $('form').submit();        });    });</script>
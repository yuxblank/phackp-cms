    <h1 class="uk-panel-title"><i class='uk-icon uk-icon-large uk-icon-edit'></i> Nuovo elemento</h1>
     <form class='uk-form uk-form-stacked uk-width-1-1' action='<?php echo $this->router->link('admin/content/save'); ?>' method="POST">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">


                <fieldset>
                    <div class="uk-form-row">
                        <label for="title" class="uk-form-label">Titolo: </label>
                        <input type="text" id="title" name="title" required="" value="<?php echo isset($item->title) ? $item->title : ""?>">
                    </div>

                    <div class="uk-form-row">
                        <textarea name="content" id="editor" rows="10" cols="50" required="" value="<?php echo isset($item->content) ? $item->content :""?>">
                    This is my textarea to be replaced with CKEditor.
                        </textarea>
                        <script>
                            var roxyFileman = '<?php echo $APP_URL."/fileman/index.html"?>';
                            CKEDITOR.replace('editor',
                                {
                                filebrowserBrowseUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload'
                                }
                            );

                            //CKEDITOR.config.filebrowserBrowseUrl = '/browse.php';
                            //CKEDITOR.config.filebrowserUploadUrl = '/upload.php';
                        </script>
                    </div>
                </fieldset>
                <div class='uk-panel-box'>
                    <ul class="uk-tab" data-uk-tab="{connect:'#tabs'}">
                        <li class="uk-active"><a href="#tab1">Pubblicazione</a></li>
                        <li><a href="#tab2">SEO</a></li>
                    </ul>
                  <ul id="tabs" class="uk-switcher">
                      <li>
                          <fieldset class='uk-margin-top'>
                              <label for='state' class="uk-form-label">Stato: </label>
                              <select id="state" name='state'>
                                  <?php foreach ($states as $key => $state): ?>

                                      <?php $selected = ($item!==null) && $item->status==$key ? "selected" : ""; ?>

                                      <option <?php echo $selected?> value="<?php echo $key?>"><?php echo $state?></option>

                                  <?php endforeach;?>
                              </select>
                              <label for='category' class="uk-form-label">Categoria: </label>
                               <select id="category" name='category' selected="<?php echo isset($item->category_id) ? $item->category_id : ""?>">
                                 <?php foreach ($categories as $category): ?>

                                     <?php $selected = $item->category_id===$category->id ? "selected" : ""; ?>

                                     <option <?php echo $selected ?> value="<?php echo $category->id?>" ><?php echo $category->title?></option>

                                   <?php endforeach;?>
                              </select>

                          </fieldset>
                      </li>
                      <li>
                            <fieldset class='uk-margin-top'>

                              <div class="uk-form-row">
                              <label for='meta_description' class="uk-form-label">Metadata description: </label>
                              <textarea name='meta_description' id="meta_description"><?php echo isset($item->meta_desc) ? $item->meta_desc : "" ?></textarea>
                              <label for='meta_tags' class="uk-form-label">Tags: </label>
                              <textarea name='meta_tags' id="meta_tags"><?php echo isset($item->meta_tags) ? $item->meta_tags : "" ?></textarea>
                              </div>
                          </fieldset>
                      </li>
                </ul>

                </div>
                </div>
                <input type='hidden' value='<?php echo isset($item->id) ? $item->id : ""?>' name='id'>
            </form>




    <script>
    $(document).ready(function(){

    $('#yx-save-btn').on('click', function() {
      $('form').submit();
    });



        var content = <?php echo isset($item->content) ? json_encode(htmlspecialchars_decode($item->content)) : 'undefined'; ?>;


            CKEDITOR.instances['editor'].setData(content);



        $('form').on('submit', function(e) {
           var chars = CKEDITOR.instances['editor'].getData().replace(/<[^>]*>/gi, '').length;
           var min = 30;
                if (chars<min) {
                    alert(chars+ " caratteri di testo sono insuffcenti, inserisci almeno " + min + " caratteri");
                    e.preventDefault();
                }
        });
    });

    </script>

   <?php require_once VIEWS . '/incs/header.php'; 
   
   /**
    * @var myframew\Validator $validation;
    */
   
   
   ?>
    <main class="main py-3">
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
          
                <h1>New post</h1>

                <form action="/posts" method="post">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value='<?= old('title');  ?>'>
                        
                       <?= isset($validation) ? $validation->listErrors('title') : "" ?>
                
                    </div>
                   
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <input type="text" class="form-control" id="content" name="content" value="<?= old('content'); ?>">
                        <?= isset($validation) ? $validation->listErrors('content') : "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" rows="3" name="excerpt"><?= old('excerpt');?></textarea>
                         <?= isset($validation) ? $validation->listErrors('excerpt') : "" ?>

                </div>
                    <button type="submit" class="btn btn-primary">Create</button>
               </form>
             
                </div>
            </div>
        </div>
    </main>    
   <?php require_once VIEWS . '/incs/footer.php'; ?>

  

   <?php require_once VIEWS . '/incs/header.php'; ?>
    <main class="main py-3">
        
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 ">
                        <h3>Register page</h3>
                   <form action="" method="post" enctype="multipart/form-data" >
                    <div class="mb-3">
                        <label for="title" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value='<?= old('name');  ?>'>
                       <?= isset($validation) ? $validation->listErrors('name') : "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?= old('password'); ?>">
                        <?= isset($validation) ? $validation->listErrors('password') : "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>">
                        <?= isset($validation) ? $validation->listErrors('email') : "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input class="form-control" name="avatar" type="file" id="avatar">
                         <?= isset($validation) ? $validation->listErrors('avatar') : "" ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Registration</button>
                  </form>
                </div>
            </div>
        </div>
    </main>    
   <?php require_once VIEWS . '/incs/footer.php'; ?>

  

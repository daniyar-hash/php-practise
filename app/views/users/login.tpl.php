   <?php require_once VIEWS . '/incs/header.php'; ?>
    <main class="main py-3">
        
        <div class="container ">
            <div class="row">
                <div class="col-md-6 offset-md-3 ">
                    <h3>Login page</h3>
                   <form action="" method="post" >
                     <div class="mb-3 ">
                        <label for="excerpt" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" ">
                        <?= isset($validation) ? $validation->listErrors('email') : "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?= isset($validation) ? $validation->listErrors('password') : "" ?>
                    </div>
             
          
                    <button type="submit" class="btn btn-primary">Login</button>
                  </form>
                </div>
            </div>
        </div>
    </main>    
   <?php require_once VIEWS . '/incs/footer.php'; ?>

  

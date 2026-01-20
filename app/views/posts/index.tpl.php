   <?php require_once VIEWS . '/incs/header.php'; ?>
   <main class="main py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
         <?= $pagination; ?>

                <?php foreach($posts as $post): ?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><a href="posts?id=<?= $post['id'] ?>"><?= h($post['title']) ?></a></h5>
                            <p class="card-text"><?=$post['excerpt']?></p>
                            <a href="posts?id=<?= $post['id']?>">Go somewhere</a>
                        </div>
                    </div>

                    <?php  endforeach;  ?>
               
                 <?= $pagination; ?>
             
                </div>
                    <?php require_once VIEWS .'/incs/sidebar.php'; ?>
            </div>
        </div>
    </main>    

   <?php require_once VIEWS . '/incs/footer.php'; ?>

 
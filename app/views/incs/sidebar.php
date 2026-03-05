 <div class="col-md-4">

 <h2>Recent Posts</h2>
                    
    <ul class="list-group">

    <?php  foreach($recent_posts as $recent_post): ?>
        <li class="list-group-item"><a href="posts/<?= $recent_post['slug'] ?>"><?= h($recent_post['title']) ?></a></li>
        <?php endforeach; ?>
    </ul>

 </div>
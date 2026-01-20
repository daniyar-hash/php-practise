<?php 

$db = \myframew\App::get(\myframew\Db::class);

$title = 'Page:About';

$post = ' <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam quasi dolore, doloremque at minus voluptates quas soluta omnis corporis corrupti maxime asperiores quo et reprehenderit! Modi saepe nam fugiat rem.</p>
                <p>Amet distinctio incidunt quo nostrum fugit dolorum, repudiandae reiciendis veniam alias asperiores aut harum vero aliquam sed id dolore nam vitae nemo minima nisi commodi? Aliquid ullam quasi velit fuga?</p>
                <p>Explicabo veritatis hic, cum voluptates a maiores vero nihil perferendis recusandae omnis laboriosam fugiat! Placeat, quis! Dolorum doloremque vitae sapiente? Dignissimos voluptatibus temporibus aperiam necessitatibus doloremque neque accusantium vero sapiente.</p>';

$recent_posts =  $db->query("SELECT * from posts order by id DESC LIMIT 3")->findAll();




require_once VIEWS . '/about.tpl.php';




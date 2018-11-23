        <footer class="ui placeholder segment">
            <div class="ui two column grid container">
                <div class="column">
                    <div class="ui big header">Community links</div>

                    <div class="ui middle aligned animated relaxed list">
                        <?php foreach($community_links as $label => $link): ?>
                            <div class="item">
                                <i class="large <?php echo $social_icons[$label]; ?> icon"></i>
                                <div class="content">
                                    <a href="<?php echo $link; ?>" target="_blank">
                                        <div class="header community-link-label"><?php echo $label; ?></div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="column">
                    <div class="ui big header">About</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit voluptatum eligendi sit id molestiae excepturi, voluptates possimus maxime magnam cupiditate ab porro laudantium dicta quod nostrum dolores maiores voluptatibus quisquam quibusdam dolorem repudiandae. Quae perferendis pariatur maiores, rem id incidunt labore esse animi. Consequuntur dolorem eaque pariatur rerum libero itaque dolores nulla enim non commodi assumenda debitis, ipsam vero est veritatis cum. Cumque exercitationem eius sequi sed fugit ullam recusandae?</p>
                </div>
            </div>
        </footer>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
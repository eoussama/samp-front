        <footer class="ui placeholder segment">
            <div class="ui two column grid container">
                <div class="column">
                    <div class="ui big header">Community links</div>

                    <div class="ui middle aligned animated list">
                        <?php foreach($community_links as $label => $link): ?>
                            <div class="item">
                                <i class="ui avatar image big <?php echo $social_icons[$label]; ?> icon"></i>
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
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus perspiciatis eius nobis tenetur omnis! Vero aliquid recusandae dolores, numquam reprehenderit modi perspiciatis. Fuga, doloremque. Vel dolorum sed numquam voluptatum nostrum.</p>
                </div>
            </div>
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
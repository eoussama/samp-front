        <!-- The footer. -->
        <footer class="ui placeholder segment">
            <div class="ui stackable grid container">

                <!-- The about section. -->
                <div id="about" class="twelve wide column">
                    <div class="ui big header">About</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit voluptates eligendi nostrum consectetur laudantium, labore corrupti saepe eveniet incidunt fugit optio ratione sequi possimus ut reiciendis facilis, tempora quod eius iste architecto. Minima, iste! Nemo reiciendis, fugiat facilis saepe illum, fugit repudiandae rem quia officiis, corrupti eos iure libero expedita voluptate! Sit animi magni illo soluta dolorum veniam, at laborum itaque inventore recusandae repellendus, hic dicta tempora, architecto sint. Odio odit aliquam nihil doloribus, delectus iste sapiente eius commodi maxime magnam eligendi reiciendis aperiam dolorum facere consectetur voluptatibus ducimus, veritatis amet iusto. Tempora eligendi recusandae cum voluptatem, aut eum facere deleniti suscipit hic optio. Excepturi, commodi quae. Nisi dolorem quae ipsam cupiditate sint voluptate, autem itaque aliquid ad repellendus possimus adipisci facilis sapiente, inventore porro doloribus blanditiis temporibus, excepturi architecto ducimus velit sit amet. Blanditiis, debitis, reiciendis assumenda odit maxime iusto illo dolor dignissimos veritatis cumque, aspernatur porro ut excepturi!</p>
                </div>

                <!-- The community's links -->
                <div class="four wide column">
                    <div class="ui big header">Community links</div>

                    <div class="ui middle aligned animated relaxed list">
                        <?php foreach($config['links']['community'] as $label => $link): ?>
                            <div class="item">
                                <i class="large <?php echo get_icon($label); ?> icon"></i>
                                <div class="content">
                                    <a href="<?php echo $link; ?>" target="_blank">
                                        <div class="header community-link-label"><?php echo $label; ?></div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Trademark -->
            <div class="ui segment trademark">
                <small>
                    <a href="https://github.com/EOussama/samp-front">Samp Front</a> by <a href="https://github.com/EOussama">EOussama</a>
                </small>
            </div>
        </footer>

        
        <!-- JQuery. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Semantic UI. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

        <!-- Scrollreveal. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.5/scrollreveal.min.js"></script>

        <!-- Slick. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

        <!-- The main script -->
        <script src="assets/js/main.js"></script>
        <script src="assets/js/scrollreveal.js"></script>
    </body>
</html>
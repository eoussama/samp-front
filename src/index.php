<?php
    /**
     * @name:       Samp Front
     * @version:    0.2.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     */

    require_once "config/config.php";
    require_once "utils/SampQueryAPI.php";
    require_once "utils/icons.php";

    $config = unserialize(CONFIG);
    $query = new SampQueryAPI($config['server']['ip'], $config['server']['port']);

    include "views/partials/_header.php";
?>
        <!-- The header. -->
        <header class="ui vertical center aligned segment">
            <div class="ui container">

                <!-- Community name -->
                <h1 class="ui header"><?php echo $config['name']; ?></h1>

                <!-- Community slogan. -->
                <h4 class="ui grey header"><?php echo $config['slogan']; ?></h4>

                <!-- Scroll down button. -->
                <p class="icon-wrapper">
                    <i id="scroll-down-btn" class="grey huge angle down icon"></i>
                </p>
            </div>
        </header>

        <!-- The main content. -->
        <main class="ui container">
            <div class="ui stackable grid">

                <!-- Introduction row. -->
                <div class="row">
                    <section id="intro" class="column">
                        <div class="ui segment">
                            <h3>Who we are</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut voluptatem culpa, obcaecati nam esse voluptatum laudantium omnis aspernatur minus non repellat exercitationem facilis fuga ab recusandae reprehenderit molestias? Deleniti, ea!</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut voluptatem culpa, obcaecati nam esse voluptatum laudantium omnis aspernatur minus non repellat exercitationem facilis fuga ab recusandae reprehenderit molestias? Deleniti, ea!</p>
                        </div>
                    </section>
                </div>

                <!-- Live stats. -->
                <div id="live-stats" class="row">

                    <!-- Server live stats. -->
                    <section class="eleven wide column">
                        <div class="ui segment">
                            <h3>Live stats</h3>
                            <div class="ui two column grid">

                                <!-- Actuall stats -->
                                <div id="server-live-stats" class="twelve wide column">
                                    <?php if($query->isOnline()): ?>
                                        <table class="ui table">
                                            <tbody>
                                                <?php
                                                    $server_info = $query->getInfo();
                                                    $server_rules = $query->getRules();
                                                ?>

                                                <!-- Hostname. -->
                                                <tr>
                                                    <td class="collapsing">
                                                        <i class="star icon"></i> Host name
                                                    </td>
                                                    <td><?php echo $server_info['hostname']; ?></td>
                                                </tr>

                                                <!-- Version. -->
                                                <tr>
                                                    <td class="collapsing">
                                                        <i class="circle icon"></i> Version
                                                    </td>
                                                    <td><?php echo $server_rules['version']; ?></td>
                                                </tr>

                                                <!-- Gamemode. -->
                                                <tr>
                                                    <td class="collapsing">
                                                        <i class="play icon"></i> Game-mode
                                                    </td>
                                                    <td><?php echo $server_info['gamemode']; ?></td>
                                                </tr>

                                                <!-- Map. -->
                                                <tr>
                                                    <td class="collapsing">
                                                        <i class="map icon"></i> Map
                                                    </td>
                                                    <td><?php echo $server_rules['mapname']; ?></td>
                                                </tr>

                                                <!-- Language. -->
                                                <tr>
                                                    <td class="collapsing">
                                                        <i class="globe icon"></i> Language
                                                    </td>
                                                    <td><?php echo $server_info['mapname']; ?></td>
                                                </tr>

                                                <!-- Players. -->
                                                <tr>
                                                    <td class="collapsing">
                                                        <i class="user icon"></i> Players
                                                    </td>
                                                    <td><?php echo $server_info['players']. " / " .$server_info['maxplayers']; ?></td>
                                                </tr>

                                                <!-- Password. -->
                                                <tr>
                                                    <td class="collapsing">
                                                        <i class="lock icon"></i> Password
                                                    </td>
                                                    <td><?php echo $server_info['password'] == 0 ? "No" : "Yes"; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <div class="server-offline">
                                            <i class="huge exclamation icon"></i>
                                            <p>The server is currently offline</p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Figure. -->
                                <div class="four wide column">
                                    <img src="assets/img/figures/tempeny-1.png" alt="Live stats figure.">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Players live stats. -->
                    <section id="players-stats" class="five wide column">
                        <div class="ui segment">
                            <?php if($query->isOnline()): ?>
                                <?php
                                    $players = $query->getDetailedPlayers();
                                ?>

                                <h3>Players <span id="player-count"><?php echo count($players) . " / " . $server_info['maxplayers']; ?></span></h3>

                                <table class="ui celled table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Player name</th>
                                            <th>Score</th>
                                            <th>Ping</th>
                                        </tr>
                                    </thead>
                                </table>

                                <!-- Actuall stats -->
                                <div id="players-live-stats" class="twelve wide column">
                                    <table class="ui celled table">
                                        <tbody>
                                            <?php foreach($players as $player): ?>
                                                <tr>
                                                    <td><?php echo $player['playerid']; ?></td>
                                                    <td><?php echo $player['nickname']; ?></td>
                                                    <td><?php echo $player['score']; ?></td>
                                                    <td><?php echo $player['ping']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="server-offline">
                                    <i class="huge exclamation icon"></i>
                                    <p>The server is currently offline</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>

                <!-- . -->
                <div class="row">

                    <!-- . -->
                    <section class="eleven wide column">
                        
                    </section>

                    <!-- Discord section. -->
                    <section class="five wide column">
                        <div class="ui segment discord-section">
                            <iframe src="https://discordapp.com/widget?id=<?php echo $config['discord']['id']; ?>&theme=<?php echo $config['discord']['theme']; ?>" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <!-- Scroll to top button. -->
        <div id="scroll-top">
            <i class="huge angle up icon"></i>
        </div>
        
<?php include "views/partials/_footer.php"; ?>
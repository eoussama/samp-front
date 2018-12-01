<?php
    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     */
    
    /**
     * Samp Front configurations.
     */
    define('CONFIG', serialize(array(

        /**
         * The name of the community.
         */
        "name"  =>  "My Community Name",

        /**
         * Optional community slogan.
         */
        "slogan"  =>  "Lorem ipsum, dolor sit consectetur adipisicing",

        /**
         * The SA:MP server's information.
         */
        "server" => array(
            /**
             * The server's IP address.
             */
            "ip"    =>  "137.74.179.193",

            /**
             * The server's port.
             */
            "port"  =>  "7777"
        ),

        /**
         * All community related external links.
         */
        "links" => array(

            /**
             * The community's links.
             */
            "community" => array(
                "forum"     =>  "http://forum.sa-mp.com",
                "discord"   =>  "https://discord.gg/uaU2KBz",
                "youtube"   =>  "https://www.youtube.com/",
                "twitter"   =>  "https://www.twitter.com/",
                "facebook"  =>  "https://www.facebook.com/",
                "reddit"    =>  "https://www.reddit.com/r/samp/"
            ),

            /**
             * The donation redirect link.
             */
            "donation" => "javascript:void(0)"
        ),

        /**
         * The discord server's information.
         */
        "discord" => array(
            /**
             * The discord server's ID.
             */
            "id"    =>  "231799104731217931"
        ),

        /**
         * Whether or not to use a dark theme for the website.
         */
        "darkMode" => false,

        /**
         * The auto scroll's speed in milliseconds.
         */
        "scrollSpeed" => 500,

        /**
         * The live stats update interval in milliseconds.
         */
        "liveUpdateInterval" => 10000,

        /**
         * The password used to access the dashboard, make sure this isn't shared
         * or somebody might have your website's news section as their diary.
         */
        "dashboardPassword" => 'CHANGE_THIS',

        /**
         * Don't touch this unless you know what you're doing.
         */
        "root" => dirname(dirname($_SERVER['SCRIPT_NAME']))
    )));

    /**
     * Returns the configurations if requested.
     */
    if (isset($_GET['q'])) {
        echo json_encode(unserialize(CONFIG));
    }
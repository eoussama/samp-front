<?php
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
         * The server's information.
         */
        "server" => array(
            /**
             * The server's IP address.
             */
            "ip"    =>  "176.32.37.208",

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
            "id"    =>  "231799104731217931",

            /**
             * The discord widget's theme; (light/dark).
             */
            "theme" =>  "light"
        ),

        /**
         * The auto scroll's speed in milliseconds.
         */
        "scrollSpeed" => 500,

        /**
         * The live stats update interval in milliseconds.
         */
        "liveUpdateInterval" => 10000
    )));

    if (isset($_GET['q'])) {
        echo json_encode(unserialize(CONFIG));
    }
<?php
    /**
     * Samp Front configurations.
     */

    /**
     * The server's information.
     */
    define('SERVER_INFO', serialize(array(
        /**
         * The name of the community.
         */
        "name"  =>  "My Community Name",

        /**
         * Optional community slogan.
         */
        "slogan"  =>  "Lorem ipsum, dolor sit consectetur adipisicing",

        /**
         * The server's IP address.
         */
        "ip"    =>  "37.59.72.97",

        /**
         * The server's port.
         */
        "port"  =>  "7777"
    )));

    /**
     * The community's links.
     */
    define('COMMUNITY_LINKS', serialize(array(
        "forum"     =>  "http://forum.sa-mp.com",
        "discord"   =>  "https://discord.gg/uaU2KBz",
        "youtube"   =>  "https://www.youtube.com/",
        "twitter"   =>  "https://www.twitter.com/",
        "facebook"  =>  "https://www.facebook.com/"
    )));

    /**
     * The discord server's information.
     */
    define('DISCORD_CONFIG', serialize(array(

        /**
         * The discord server's ID.
         */
        "id"    =>  "231799104731217931",

        /**
         * The discord widget's theme; (light/dark).
         */
        "theme" =>  "dark"
    )));

    /**
     * The respective icon of all social media.
     * To add more, check out (https://semantic-ui.com/elements/icon.html#/icon).
     */
    define('SOCIAL_ICONS', serialize(array(
        "forum"     =>  "external alternate",
        "discord"   =>  "discord",
        "youtube"   =>  "youtube",
        "twitter"   =>  "twitter",
        "facebook"   =>  "facebook"
    )));

    /**
     * The donation's URL.
     */
    define('DONATION_URL', "javascript:void(0)");
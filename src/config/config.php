<?php
    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     * 
     * This file is responsible on loading the configurations from
     * the config.ini file and setting them up for use.
     */
    
    #region Setting up the configurations.

    // Loading the configurations from the config.ini file.
    $config = parse_ini_file('config.ini', true);

    /**
    * Don't touch this unless you know what you're doing.
    * Getting the root folder of the website.
    */
    $_site = dirname(dirname($_SERVER['SCRIPT_NAME'])) . '/';
    $_root = dirname(__DIR__) . '/';

    /**
     * The paths to different parts of the website.
     */
    $config['path'] = array(

        /**
         * The absolute path of the website's folder.
         */
        "root"      => $_root,
        
        /**
         * The path of the root website.
         */
        "site"      => $_site,

        /**
         * The path to the folder that contains controllers.
         */
        "controllers"     => 'controllers/',

        /**
         * The path to the folder that contains models.
         */
        "models"     => 'models/',

        /**
         * The path to the folder that contains utility scripts.
         */
        "utils"     => 'utils/',

        /**
         * The path to the folder that serves public files.
         */
        "public"    => 'public/',

        /**
         * The path to the folder that contains views.
         */
        "views"     => 'views/',

        /**
         * The path to the folder that contains javascript files.
         */
        "js"        => 'assets/js/',

        /**
         * The path to the folder that contains stylesheet files.
         */
        "css"       => 'assets/css/',

        /**
         * The path to the folder that contains images.
         */
        "img"       => 'assets/img/'
    );

    /**
     * Samp Front's configurations.
     */
    define('CONFIG', serialize($config));

    #endregion

    #region Retrieving the configurations.

    /**
     * Returns the configurations if requested.
     */
    if (isset($_GET['q'])) {
        $data = array(
            "path" => array(
                "controllers" => $config['path']['controllers'],
                "site" => $config['path']['site'],
                "utils" => $config['path']['utils']
            ),
            "website" => array(
                "scrollSpeed"           => $config['website']['scrollSpeed'],
                "liveUpdateInterval"    => $config['website']['liveUpdateInterval']
            )
        );

        echo json_encode($data);
    }

    #endregion

    /**
     * Concatenates two paths together.
     * 
     * @param string $dest: The first part of the path, must make use of the values stored
     * in the $config variable.
     * @param string $root: The second part of the path, can be either “root” or “site”.
     * @param boolean $public: Whether or not to append the public folder in between both paths.
     * 
     * @return string The combination of the two paths.
     */
    function pathfy($dest, $root = 'root', $public = false) {
        global $config;

        $dest = (empty($dest) ? '' : $config['path'][$dest]);
        $root = (empty($root) ? '' : $config['path'][$root]);

        return $root . ($public ? $config['path']['public'] : '' ) . $dest;
    }
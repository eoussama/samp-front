<?php
    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     */
    
    // Loading the configurations from the config.ini file.
    $conf = parse_ini_file('config.ini', true);

    /**
    * Don't touch this unless you know what you're doing.
    * Getting the root folder of the website.
    */
    $_path = dirname(dirname($_SERVER['SCRIPT_NAME'])) . '/';

    /**
     * The paths to different parts of the website.
     */
    $conf['path'] = array(

        /**
         * The path of the root folder.
         */
        "root"      => $_path,

        /**
         * The path to the folder that serves public files.
         */
        "public"    => $_path . 'public/',

        /**
         * The path to the folder that contains views.
         */
        "views"     => $_path . 'public/views/',

        /**
         * The path to the folder that contains javascript files.
         */
        "js"        => $_path . 'public/assets/js/',

        /**
         * The path to the folder that contains stylesheet files.
         */
        "css"       => $_path . 'public/assets/css/',

        /**
         * The path to the folder that contains images.
         */
        "img"       => $_path . 'public/assets/img/'
    );

    /**
     * Samp Front's configurations.
     */
    define('CONFIG', serialize($conf));    

    /**
     * Returns the configurations if requested.
     */
    if (isset($_GET['q'])) {
        $tmp = unserialize(CONFIG);

        $data = array(
            "scrollSpeed"           => $tmp['scrollSpeed'],
            "liveUpdateInterval"    => $tmp['liveUpdateInterval']
        );

        echo json_encode($data);
    }

    echo '<table border>';
    foreach ($conf as $k => $v ) {
        echo '<tr>';
        echo '<td>';
        echo '<h4>'.$k.'<h4>';
        echo '</td>';
        echo '<td>';
        echo '<table border>';
        foreach ($v as $_k => $_v) {
            echo '<tr>';
            echo '<td>'.$_k.'</td>';
            if (is_array($_v)) {
                echo '<td>';
                echo '<table border>';
                foreach ($_v as $__k => $__v) {
                    echo '<tr>';
                    echo '<td>'.$__k.'</td>;';
                    echo '<td>'.$__v.'</td>;';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</td>';
            } else {
                echo '<td>'.$_v.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';    
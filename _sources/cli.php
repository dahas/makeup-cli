<?php

Phar::interceptFileFuncs();

$phar = Phar::running(false);

// Root path
if ($phar) { // PHAR
    $src_root = "";
    $dst_root = str_replace("/cli.phar", "", $phar);
} else { // CLI
    $src_root = __DIR__;
    $dst_root = str_replace("/_sources", "", str_replace("\\", "/", __DIR__));
}

/** Create module file structure **/

// Commands with Parameters:
if (isset($argv[1]) && $argv[1] && isset($argv[2]) && $argv[2]) {

    /***** CREATE SERVICE */
    if ($argv[1] == "--create-service") {
        $className = preg_replace("/[^A-Za-z?! ]/", "", $argv[2]);

        if ($className == $argv[2]) {
            $className = ucfirst($className);
            $srvName = strtolower($className);

            $content_srv = file_get_contents($src_root . "/services/xxxx.php");
            $content_srv = str_replace("XXXX", $className, $content_srv);

            $path = $dst_root . "/services/" . $srvName . ".php";

            echo "-----------------------------------------------\n";
            if (file_exists($path)) {
                echo "PHP: FILE EXISTS - Creating file '/makeup/services/" . $srvName . "' failed!\n";
            } else {
                @mkdir(dirname($path), 0777, true);
                if (file_put_contents($path, $content_srv)) {
                    echo "PHP: SUCCESS - Created file '/makeup/services/" . $srvName . "'\n";
                } else {
                    echo "PHP: ERROR - Creating file '/makeup/services/" . $srvName . "' failed!\n";
                }
            }
            echo "-----------------------------------------------\n";
        } else {
            echo "-----------------------------------------------\n";
            echo "Error: Please name the service UpperCamelCase and avoid numbers and special characters!'\n";
            echo "-----------------------------------------------\n";
        }
    }

    /***** CREATE MODULE */
    elseif ($argv[1] == "--create-module") {
        $className = preg_replace("/[^A-Za-z?! ]/", "", $argv[2]);

        if ($className == $argv[2]) {
            // Type: PAGE
            if (!isset($argv[3]) || strtolower($argv[3]) == "page") {
                $className = ucfirst($className);
                $modName = strtolower(preg_replace('/(?<!^)[A-Z]+/', '_$0', $className));

                $content_ini = file_get_contents($src_root . "/modules/xxxx/config/xxxx.ini");
                $content_ini = str_replace(["xxxx", "XXXX"], [$modName, $className], $content_ini);

                $content_php = file_get_contents($src_root . "/modules/xxxx/controller/xxxx.php");
                $content_php = str_replace(["xxxx", "XXXX"], [$modName, $className], $content_php);

                $content_html = file_get_contents($src_root . "/modules/xxxx/view/xxxx.html");
                $content_html = str_replace(["xxxx", "XXXX"], [$modName, $className], $content_html);

                $path = $dst_root . "/modules/" . $modName;

                echo "-----------------------------------------------\n";
                if (mkdir($path, 0777, true)) {
                    echo "PHP: SUCCESS - Created directory '/makeup/modules/" . $modName . "'\n";
                    if (mkdir($path . "/config")) {
                        echo "PHP: SUCCESS - Created directory '/makeup/modules/" . $modName . "/config'\n";
                        if (file_put_contents($path . "/config/" . $modName . ".ini", $content_ini)) {
                            echo "PHP: SUCCESS - Created file '/makeup/modules/" . $modName . "/config/" . $modName . ".ini'\n";
                        } else {
                            echo "PHP: ERROR - Creating file '/makeup/modules/" . $modName . "/config/" . $modName . ".ini' failed!\n";
                        }
                    } else {
                        echo "PHP: ERROR - Creating directory '/makeup/modules/" . $modName . "/config' failed!\n";
                    }
                    if (mkdir($path . "/controller")) {
                        echo "PHP: SUCCESS - Created directory '/makeup/modules/" . $modName . "/controller'\n";
                        if (file_put_contents($path . "/controller/" . $modName . ".php", $content_php)) {
                            echo "PHP: SUCCESS - Created file '/makeup/modules/" . $modName . "/controller/" . $modName . ".php'\n";
                        } else {
                            echo "PHP: ERROR - Creating file '/makeup/modules/" . $modName . "/controller/" . $modName . ".php' failed!\n";
                        }
                    } else {
                        echo "PHP: ERROR - Creating directory '/makeup/modules/" . $modName . "/controller' failed!\n";
                    }
                    if (mkdir($path . "/view")) {
                        echo "PHP: SUCCESS - Created directory '/makeup/modules/" . $modName . "/view'\n";
                        if (file_put_contents($path . "/view/" . $modName . ".html", $content_html)) {
                            echo "PHP: SUCCESS - Created file '/makeup/modules/" . $modName . "/view/" . $modName . ".html'\n";
                        } else {
                            echo "PHP: ERROR - Creating file '/makeup/modules/" . $modName . "/view/" . $modName . ".html' failed!\n";
                        }
                    } else {
                        echo "PHP: ERROR - Creating directory '/makeup/modules/" . $modName . "/view' failed!\n";
                    }
                } else {
                    echo "PHP: ERROR - Creating directory '/makeup/modules/" . $modName . " failed!'\n";
                }
                echo "-----------------------------------------------\n";
                echo "Please make sure, all files and folders have been created successfully! If an error occured, remove the directory of the module you just created, as long as it exists. Before trying again, make sure you have the right permissions and the name of the module does not contain any weired characters.\n";
                echo "Open your browser and add '" . $modName . ".html' to the URL and check, if your new module is running correctly.\n";
                echo "-----------------------------------------------\n";
            }
            // Type: MENU
            else if (isset($argv[3]) && strtolower($argv[3]) == "menu") {
                $className = ucfirst($className);
                $modName = strtolower(preg_replace('/(?<!^)[A-Z]+/', '_$0', $className));

                $content_ini = file_get_contents($src_root . "/modules/zzzz/config/zzzz.ini");
                $content_ini = str_replace(["zzzz", "ZZZZ"], [$modName, $className], $content_ini);

                $path = $dst_root . "/modules/" . $modName;

                echo "-----------------------------------------------\n";
                if (mkdir($path, 0777, true)) {
                    echo "PHP: SUCCESS - Created directory '/modules/" . $modName . "'\n";
                    if (mkdir($path . "/config")) {
                        echo "PHP: SUCCESS - Created directory '/makeup/modules/" . $modName . "/config'\n";
                        if (file_put_contents($path . "/config/" . $modName . ".ini", $content_ini)) {
                            echo "PHP: SUCCESS - Created file '/makeup/modules/" . $modName . "/config/" . $modName . ".ini'\n";
                        } else {
                            echo "PHP: ERROR - Creating file '/makeup/modules/" . $modName . "/config/" . $modName . ".ini' failed!\n";
                        }
                    } else {
                        echo "PHP: ERROR - Creating directory '/makeup/modules/" . $modName . "/config' failed!\n";
                    }
                } else {
                    echo "PHP: ERROR - Creating directory '/makeup/modules/" . $modName . " failed!'\n";
                }
                echo "-----------------------------------------------\n";
                echo "Please make sure, all files and folders have been created successfully! If an error occured, remove the directory of the module you just created, as long as it exists. Before trying again, make sure you have the right permissions and the name of the module does not contain any weired characters.\n";
                echo "INFO: The new menu item will show up as soon as you have assigned it a module as a submenu entry.\n";
                echo "-----------------------------------------------\n";
            }
        } else {
            echo "-----------------------------------------------\n";
            echo "Error: Please name the module UpperCamelCase and avoid numbers and special characters!'\n";
            echo "-----------------------------------------------\n";
        }
    } else {
        echo "Error: Unknown command!";
    }
}

// Commands without Parameters:
elseif (isset($argv[1]) && $argv[1] && (!isset($argv[2]) || !$argv[2])) {

    $serveFromPath = str_replace(["phar://", "/makeup/cli.phar"], ["", "/public"], __DIR__);
    
    /***** RUN WEBSERVER */
    if ($argv[1] == "--serve") {
        echo "-----------------------------------------------\n";
        echo "Webserver is running!\n";
        echo "Open http://localhost:8080 in your browser.\n";
        echo "Serving from $serveFromPath\n";
        echo "Press CTRL + C to cancel server.\n";
        echo "-----------------------------------------------\n";
        // Server
        exec("php -S localhost:8080 -t $serveFromPath");
    }
    
    /***** RUN SASS WATCHER */
    elseif ($argv[1] == "--watch") {
        system("sass --watch $serveFromPath/bootstrap-sass/bootstrap-sass-gen.scss:$serveFromPath/resources/css/bootstrap-sass-gen.css");
    }
    
    /***** CREATE APP */
    elseif ($argv[1] == "--create-app") {
        echo "-----------------------------------------------\n";
        echo "Not possible at the moment :-(.\n";
        echo "-----------------------------------------------\n";
    } 
    
    /***** ERROR */
    else {
        echo "Error: Please enter a parameter for the command!";
    }

}

// Default Error Message:
else {
    echo "Error: Please enter the command to be executed! (For example: --create-module YourModule)";
}

<?php

/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:57
 */
class DhtmlChess extends Package implements PackageInterface
{

    public function getRootFolder()
    {
        return "../dhtml-chess/";
    }


    public function getLicenseText()
    {
        return "/*
 * Copyright [DATE]. dhtmlchess.com. All Rights Reserved.
 * This is a commercial software. See dhtmlchess.com for licensing options.
 *
 * You are free to use/try this software for 30 days without paying any fees.
 *
 * IN NO EVENT SHALL DHTML CHESS BE LIABLE TO ANY PARTY FOR DIRECT, INDIRECT, SPECIAL, INCIDENTAL,
 * OR CONSEQUENTIAL DAMAGES, INCLUDING LOST PROFITS, ARISING OUT OF THE USE OF THIS SOFTWARE AND
 * ITS DOCUMENTATION, EVEN IF DHTML CHESS HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * DHTML CHESS SPECIFICALLY DISCLAIMS ANY WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.
 * THE SOFTWARE AND ACCOMPANYING DOCUMENTATION, IF ANY, PROVIDED HEREUNDER IS PROVIDED \"AS IS\".
 * DHTML CHESS HAS NO OBLIGATION TO PROVIDE MAINTENANCE, SUPPORT, UPDATES, ENHANCEMENTS, OR MODIFICATIONS.
 *
 */";
    }

    public function getAllModules()
    {
        return array(
            "chess.js",
            'view/chess.js',
            'util/dynamic-styles.js',
            "language" => array(
                "modules" => array("default.js")
            ),
            "view" => array(
                "notation" => array(
                    'modules' => array(
                        "Panel" => array("css" => true), "TacticPanel", "Table", "LastMove","LastComment"
                    )
                ),
                "seek" => array(
                    'modules' => array(
                        "View"
                    )
                ),
                "board" => array(
                    'modules' => array(
                        "Gui", "Board", "Piece", 'Background',"SideToMove", 'BoardInteraction'
                    ),
                    "css" => true
                ),
                "highlight" => array(
                    'modules' => array(
                        "Base", "SquareBase", "Square", "ArrowSvg", "ArrowBase", "Arrow", "ArrowTactic", "SquareTacticHint",
                        "ArrowPool", "ArrowNode", "ArrowBase", "SquarePool"
                    )
                ),
                "buttonbar" => array(
                    "modules" => array(
                        "Game", "Bar"
                    )
                ),
                "gamelist" => array(
                    "modules" => array(
                        "Grid" => array("css" => "grid.css")
                    )
                ),
                "metadata" => array(
                    "modules" => array(
                        "Game", "Move", "FenField"
                    )
                ),
                "message" => array(
                    "modules" => array(
                        "TacticsMessage" => array("css" => true)
                    )
                ),
                "dialog" => array(
                    "modules" => array(
                        "Dialog", "NewGame", "EditGameMetadata", "OverwriteMove", "PuzzleSolved", "Promote" => array("css" => true), "Comment"
                    )
                ),
                "button" => array(
                    "modules" => array(
                        "SaveGame", "TacticHint", "TacticSolution", "NextGame", "PreviousGame"
                    )
                ),
                /*
                "user" => array(
                    "modules" => array("Country", "LoginButton", "Controller", "RegisterButton", "LogoutButton", "RegisterWindow", "Panel", "LoginWindow", "SettingsButton", "ProfileWindow")
                ),
                */
                "command" => array(
                    "modules" => array("Line", "Controller", "Panel"),
                    "css" => true
                ),
                "menu-item" => array(
                    "modules" => array("GameImport", "SaveGame", "NewGame")
                ),
                "position" => array(
                    "modules" => array("Board", "Pieces", "Dialog" => array("css" => true), "Castling", "SideToMove")
                ),
                "pgn" => array(
                    "modules" => array('Grid')
                ),
                "score" => array(
                    "modules" => array("Bar")
                )
            ),
            "util" => array(
                "modules" => array(
                    "CoordinateUtil"
                )

            ),
            "sound" => array(
                "modules" => array("Sound")
            ),
            "parser0x88" => array(
                "modules" => array(
                    "Config", "fen-parser-0x88.js", "move-0x88.js", "position-validator.js"
                )
            ),
            "controller" => array(
                "modules" => array("Controller", "EnginePlayController", "TacticController", "TacticControllerGui", "AnalysisController", "GameplayController", "AnalysisEngineController")
            ),
            "model" => array(
                "modules" => array("Game")
            ),
            "remote" => array(
                "modules" => array("Reader", "GameReader")
            ),
            "datasource" => array(
                "modules" => array("GameList", "PgnGames", "PgnList")
            ),
            "pgn" => array(
                "modules" => "Parser"
            ),
            "wordpress" => array(
                "modules" => array("GameListGrid", "PgnList", "GameList")

            )
        );
    }

    public function getExternalModuleDependencies()
    {
        return array(
            array("package" => "LudoJS",
                "modules" => array(
                    "layout", "View", "Application", "grid", "dialog", "form/Number",
                    "form/Checkbox", "controller", "menu", "Panel", 'svg/EventManager', "svg/Path", "svg/Canvas", "svg/Animation",
                    "remote", "svg/Group",
                    "form/SubmitButton", "form/CancelButton",
                    "layout", "form/Textarea", "Notification", "paging", "form/DisplayField", "progress", "form/Radio",
                    "form/Select", "theme/Themes", 'form/Label',
                    'ListView', "storage/Storage"
                )
            )
        );
    }


    public function getJSFileName()
    {
        $folder = $this->getRootFolder() . "js";
        return $folder . "/" . $this->getName() . ".js";
    }

    public function getJSFileNameMinified()
    {
        $folder = $this->getRootFolder() . "js";
        return $folder . "/" . $this->getName() . "-minified.js";
    }


    public function getCssSkins()
    {
        return array();
    }

    public function getVersion()
    {
        return "1.1";
    }

    public function getFilesForZip()
    {
        return array("js", "css", "jquery", "demo", "ludojs", "php", "router.php", "autoload.php", "src",
            ".htaccess", "README.md", "src-tests", "pgn", "images", "themes", "stockfish-js", "tools");
    }

    public function getUrlsToRunBeforeStart()
    {
        return array(
            "http://localhost/CodeBuilder/router.php?request=Builder/DHTMLChessWordpress/minify"
        );
    }

    public function getUrlsToRunAtEnd()
    {
        return array(
            "http://localhost/dhtml-chess/src/wp-public/minify-wordpress-js.php",
            "http://localhost/dhtml-chess/wp-plugins/build-plugin.php",
            "http://localhost/dhtml-chess/images/board/find-brightness.php",
            "http://localhost/dhtml-chess/scripts/find-words.php",
            "http://localhost/dhtml-chess/images/board-bg/find-brightness.php");
    }
}

<?php

/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:57
 */
class DhtmlChessWordpress extends Package implements PackageInterface
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
                        "Panel" => array("css" => true), "TacticPanel", "Table", "LastMove", "LastComment"
                    )
                ),
                "board" => array(
                    'modules' => array(
                        "Gui", "Board", "Piece", 'Background', 'BoardInteraction','SideToMove'
                    ),
                    "css" => true
                ),
                "highlight" => array(
                    'modules' => array(
                        "Base", "SquareBase", "Square", "ArrowBase", "Arrow", "ArrowTactic", "SquareTacticHint",
                        "ArrowPool", "ArrowNode", "SquarePool"
                    )
                ),
                "buttonbar" => array(
                    "modules" => array(
                        "Bar"
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
                        "Dialog", "PuzzleSolved", "Promote" => array("css" => true), "Comment"
                    )
                ),
                "button" => array(
                    "modules" => array(
                        "TacticHint", "TacticSolution", "NextGame", "PreviousGame"
                    )
                ),
                "pgn" => array(
                    "modules" => array('Grid')
                )
            ),

            "pgn" => array(
                "modules" => array(
                    "Parser"
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
                "modules" => array("Controller", "EnginePlayController",
                    "TacticController", "TacticControllerGui",
                    "PlayStockfishController","ComputerController")
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
            "wordpress" => array(
                "modules" => array("GameListGrid", "PgnList", "GameList")
            ),
            "computer" => array(
                "modules" => array("ComputerPlay")
            ),
            "wordpress/PgnStandings",
            "wp-public/wp-template.js",
            "wp-public/game-grid.js",
            "wp-public/manager.js",
            "wp-public/wpcom-message.js",
            "wp-public/game/game-template.js",
            "wp-public/game/game1.js",
            "wp-public/game/game2.js",
            "wp-public/game/game3.js",
            "wp-public/game/game4.js",
            "wp-public/game/game5.js",
            "wp-public/game/game6.js",
            "wp-public/pgn/viewer-template.js",
            "wp-public/pgn/viewer1.js",
            "wp-public/pgn/viewer2.js",
            "wp-public/pgn/viewer3.js",
            "wp-public/computer/comp1.js",
            "wp-public/special/pinned.js",
            "wp-public/special/standings.js",
            "wp-public/tactics/tactics1.js",
            "wp-public/tactics/tactics-game1.js",

        );
    }

    public function getExternalModuleDependencies()
    {
        return array(
            array("package" => "LudoJS",
                "modules" => array(
                    "layout/Base",
                    "View",
                    "layout/Relative", "layout/LinearVertical", "layout/linearHorizontal", "layout/Fill", "layout/Tab", "layout/Table", "layout/Grid",
                    "grid", "dialog",
                    "controller", 'svg/EventManager', "svg/Path", "svg/Canvas", "remote", "svg/Group",
                    "Notification", "paging", "theme/Themes", 'form/Label', "storage/Storage"
                )
            )
        );
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
    }

    public function getUrlsToRunBeforeStart()
    {
        return array();
    }

    public function getUrlsToRunAtEnd()
    {

        return array(
            "http://localhost/CodeBuilder/router.php?request=Builder/DHTMLChessWordpressFree/minify",
            "http://localhost/dhtml-chess/src/wp-public/minify-wordpress-js.php",
            "http://localhost/dhtml-chess/wp-plugins/build-plugin.php",
            "http://localhost/dhtml-chess/wp-plugins/build-plugin-free.php"
        );
    }

    public function shouldBuildCss()
    {
        return false;
    }


    public function shouldBuildZip()
    {
        return false;
    }
}

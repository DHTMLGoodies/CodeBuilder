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
        return "/**
        DHTML Chess - Javascript and PHP chess software
        Copyright (C) 2012-[DATE] dhtml-chess.com

        This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program.  If not, see <http://www.gnu.org/licenses/>.
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
                        "Panel" => array("css" => true), "TacticPanel"
                    )
                ),
                "seek" => array(
                    'modules' => array(
                        "View"
                    )
                ),
                "board" => array(
                    'modules' => array(
                        "Gui", "Board", "Piece", 'Background'
                    ),
                    "css" => true
                ),
                "highlight" => array(
                    'modules' => array(
                        "Base", "SquareBase", "Square", "ArrowSvg", "ArrowBase", "Arrow", "ArrowTactic", "SquareTacticHint"
                    )
                ),
                "buttonbar" => array(
                    "modules" => array(
                        "Game","Bar"
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
                "folder" => array(
                    "modules" => array(
                        "Tree"
                    )
                ),
                "eco" => array(
                    "modules" => array("VariationTree")
                ),
                "tree" => array(
                    "modules" => array("SelectFolder")
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
                    "form/Checkbox", "controller", "menu", "Panel", 'svg/EventManager', "svg/Path", "svg/Canvas", "svg/Animation", "remote", "svg/Group",
                    "form/SubmitButton", "form/CancelButton", "form/ResetButton", "tree", 'card/Button', 'card/PreviousButton', 'card/NextButton', 'card/FinishButton',
                    "layout", "form/Textarea", "Notification", "paging", "form/DisplayField", "progress", "form/Radio", "form/Select", "theme/Themes", 'form/Label',
                    'ListView'
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
        return array("js", "css", "jquery", "demo", "ludojs", "php", "router.php", "autoload.php", "src",
            ".htaccess", "README.md", "src-tests", "pgn", "garbochess-engine", "images", "themes");
    }

    public function getUrlsToRunBeforeStart()
    {
        return array();
    }

    public function getUrlsToRunAtEnd()
    {
        return array("http://localhost/dhtml-chess/wp-plugins/build-plugin.php",
            "http://localhost/dhtml-chess/images/board/find-brightness.php",
            "http://localhost/dhtml-chess/wordpress/minify-wordpress-js.php",
            "http://localhost/dhtml-chess/images/board-bg/find-brightness.php");
    }
}

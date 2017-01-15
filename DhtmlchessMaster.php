<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:57
 */
class DhtmlchessMaster extends Package implements PackageInterface
{
    public function __construct()
    {
        parent::__construct();
        $this->name = "dhtml-chess";

    }

    public function getRootFolder()
    {
        return "../dhtmlchess-master/";
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
                        "Gui", "Board", "Piece"
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
                        "Game"
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
                        "NewGame", "EditGameMetadata", "OverwriteMove", "Promote" => array("css" => true), "Comment", "GameImport"
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
                "user" => array(
                    "modules" => array("Country","LoginButton", "Controller", "RegisterButton", "LogoutButton", "RegisterWindow", "Panel", "LoginWindow", "SettingsButton", "ProfileWindow")
                ),
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
                )
            ),

            "parser0x88" => array(
                "modules" => array(
                    "Config", "fen-parser-0x88.js", "move-0x88.js", "position-validator.js"
                )
            ),
            "controller" => array(
                "modules" => array("Controller", "EnginePlayController", "TacticController", "TacticControllerGui", "AnalysisController", "GameplayController")
            ),
            "model" => array(
                "modules" => array("Game")
            ),
            "remote" => array(
                "modules" => array("Reader", "GameReader")
            ),
            "datasource" => array(
                "modules" => array("FolderTree", "GameList", "PgnGames", "PgnList")
            ),
            "pgn" => array(
                "modules" => "Parser"
            )
        );
    }

    public function getExternalModuleDependencies()
    {
        return array(
            array("package" => "LudoJS",
                "modules" => array(
                    "layout", "View", "Application", "grid", "dialog", "form/StrongPassword", "form/Email", "form/Number",
                    "form/Checkbox", "controller", "menu", "Panel", "canvas/Path", "canvas/Canvas", "remote",
                    "form/SubmitButton", "form/CancelButton", "form/ResetButton", "tree",
                    "layout", "form/Textarea", "Notification", "form/ComboTree","paging","form/DisplayField","progress","form/File","form/Radio","form/Select"
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
        return array("js", "css", "jquery", "demo");
    }


}

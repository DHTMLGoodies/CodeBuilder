<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:57
 */
class DHTMLChess extends Package implements PackageInterface
{
    public function getRootFolder()
    {
        return "../dhtml-chess/";
    }

    public function getLicenseText()
    {

    }

    public function getAllModules()
    {
        return array(
            "chess.js",
            "view" => array(
                "notation" => array(
                    'modules' => array(
                        "Panel"
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
                    )
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
                        "Grid"
                    )
                ),
                "metadata" => array(
                    "modules" => array(
                        "Game", "Move", "FenField"
                    )
                ),
                "message" => array(
                    "modules" => array(
                        "TacticsMessage"
                    )
                ),
                "dialog" => array(
                    "modules" => array(
                        "NewGame", "OverwriteMove", "Promote", "Comment", "GameImport"
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
                    "modules" => array("LoginButton", "Controller", "RegisterButton", "LogoutButton", "RegisterWindow", "Panel", "LoginWindow", "SettingsButton", "ProfileWindow", "UserModel")
                ),
                "command" => array(
                    "modules" => array("Line", "Controller", "Panel")
                ),
                "menu-item" => array(
                    "modules" => array("GameImport", "SaveGame", "NewGame")
                ),
                "position" => array(
                    "modules" => array("Board", "Pieces", "Dialog", "Castling", "SideToMove")
                )

            ),
            "language" => array(
                "modules" => array("default.js")
            ),
            "parser0x88" => array(
                "modules" => array(
                    "Config", "fen-parser-0x88.js", "move-0x88.js", "position-validator.js"
                )
            ),
            "controller" => array(
                "modules" => array("Controller", "EnginePlayController", "TacticController", "AnalysisController", "GameplayController")
            ),
            "model" => array(
                "modules" => array("Model", "Game")
            ),
            "remote" => array(
                "modules" => array("Reader", "GameReader")
            ),
            "datasource" => array(
                "modules" => array("FolderTree", "GameList")
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
                    "View","grid","dialog","form"
                )
            )

        );
    }
}

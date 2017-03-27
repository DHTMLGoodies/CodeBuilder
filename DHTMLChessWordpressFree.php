<?php

/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:57
 */
class DhtmlChessWordpressFree extends Package implements PackageInterface {

	public function getRootFolder() {
		return "../dhtml-chess/";
	}


	public function getLicenseText() {
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

	public function getAllModules() {
		return array(
			"chess.js",
			'view/chess.js',
			'util/dynamic-styles.js',
			"language"   => array(
				"modules" => array( "default.js" )
			),
			"view"       => array(
				"notation"  => array(
					'modules' => array(
						"Panel" => array( "css" => true ),
						"TacticPanel",
						"Table",
						"LastMove",
						"LastComment"
					)
				),
				"board"     => array(
					'modules' => array(
						"Gui",
						"Board",
						"Piece",
						'Background',
						'BoardInteraction'
					),
					"css"     => true
				),
				"highlight" => array(
					'modules' => array(
						"Base",
						"SquareBase",
						"Square",
						"ArrowBase",
						"Arrow",
						"ArrowTactic",
						"SquareTacticHint",
						"ArrowPool",
						"ArrowNode",
						"SquarePool"
					)
				),
				"buttonbar" => array(
					"modules" => array(
						"Bar"
					)
				),
				"metadata"  => array(
					"modules" => array(
						"Game",
						"Move"
					)
				),
				"message"   => array(
					"modules" => array(
						"TacticsMessage" => array( "css" => true )
					)
				),
				"dialog"    => array(
					"modules" => array(
						"Dialog",
						"PuzzleSolved",
						"Promote" => array( "css" => true )
					)
				),
				"button"    => array(
					"modules" => array(
						"TacticHint",
						"TacticSolution",
						"NextGame",
						"PreviousGame"
					)
				),
				"pgn"       => array()
			),
			"util"       => array(
				"modules" => array(
					"CoordinateUtil"
				)
			),
			"sound"      => array(
				"modules" => array( "Sound" )
			),
			"parser0x88" => array(
				"modules" => array(
					"Config",
					"fen-parser-0x88.js",
					"move-0x88.js",
					"position-validator.js"
				)
			),
			"controller" => array(
				"modules" => array(
					"Controller",
					"TacticController",
					"TacticControllerGui"
				)
			),
			"model"      => array(
				"modules" => array( "Game" )
			),
			"remote"     => array(
				"modules" => array( "Reader", "GameReader" )
			),
			"datasource" => array(
				"modules" => array( "GameList", "PgnGames", "PgnList" )
			),
			"wp-public/wp-template.js",
			"wp-public/manager.js",
			"wp-public/wpcom-message.js",
			"wp-public/game/game-template.js",
			"wp-public/game/game1.js",
			"wp-public/game/game2.js",
			"wp-public/game/game3.js",
			"wp-public/game/game4.js",
			"wp-public/game/game5.js",
		);
	}

	public function getExternalModuleDependencies() {
		return array(
			array("package" => "LudoJS",
			      "modules" => array(
				      "layout/Base",
				      "View",
				      "layout/Relative", "layout/LinearVertical", "layout/linearHorizontal",
				      "layout/Fill", "layout/Grid",
				       "dialog","data-source/JsonArray","form/Button",
				      "controller", 'svg/EventManager', "svg/Path", "svg/Canvas", "remote", "svg/Group",
				      "Notification", "theme/Themes", 'form/Label', "storage/Storage"
			      )
			)
		);
	}

	public function getCssSkins() {
		return array();
	}

	public function getVersion() {
		return "1.1";
	}

	public function getFilesForZip() {
	}

	public function getUrlsToRunBeforeStart() {
		return array();
	}

	public function getUrlsToRunAtEnd() {

		return array();
	}

	public function shouldBuildCss() {
		return false;
	}


	public function shouldBuildZip() {
		return false;
	}
}

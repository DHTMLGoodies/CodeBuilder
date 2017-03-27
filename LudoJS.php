<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:57
 */
class LudoJS extends Package implements PackageInterface
{
    public function getRootFolder(){
        return "../ludojs/";
    }

    public function getAllModules(){
        return array(
            'Core' => array(
                'dependencies' => array(
                    '../mootools/MooTools-Core-1.6.0.js',
                    '../mootools/Mootools-More-1.6.0.js', 'ludo.js',
                    'util.js', 'effect.js', 'language/default.js', 'registry.js','storage/storage.js', 'object-factory.js', 'config.js','assets.js'
                ),
                'hidden' => true
            ),
            'theme' => array(
                'modules' => array(
                    'Themes' => array('dependencies' => array(), 'hidden' => true),
                )
            ),
            'Movable' => array(
                'hidden' => true
            ),
            'remote' => array(
                'modules' => array(
                    'Base' => array('dependencies' => array('remote/Inject'), 'hidden' => true),
                    'JSON' => array('dependencies' => array('remote/Base')),
                    'HTML' => array('dependencies' => array('remote/Base')),
                    'Broadcaster' => array('dependencies' => array()),
                    'Message' => array('dependencies' => array('View'),'css' => 'message.css'),
                    'ErrorMessage' => array('dependencies' => array('remote/Message')),
                    'Inject' => array('dependencies' => array()),
                )
            ),
            'chart' => array(
                'modules' => array(
                    'Chart' => array('dependencies' => array('View','chart/DataSource','chart/Record','svg/Effect'), 'hidden' => false),
                    'DataSource' => array('dependencies' => array('dataSource/JSON','color/Color'), 'hidden' => true),
                    'ScatterDataSource' => array('dependencies' => array('chart/DataSource'), 'hidden' => true),
                    'Fragment' => array('dependencies' => array('Core'), 'hidden' => true),
                    'Base' => array('dependencies' => array('svg/Group'), 'hidden' => true),
                    'Pie' => array('dependencies' => array('chart/Base','chart/PieSlice'), 'hidden' => false),
                    'PieSlice' => array('dependencies' => array('chart/Fragment'), 'hidden' => true),
                    'Record' => array('dependencies' => array('dataSource/Record'), 'hidden' => true),
                    'LabelList' => array('dependencies' => array('chart/Base'), 'hidden' => false),
                    'LabelListItem' => array('dependencies' => array('chart/Fragment'), 'hidden' => true),
                    'AddOn' => array('dependencies' => array('Core'), 'hidden' => true),
                    'PieSliceHighlighted' => array('dependencies' => array('chart/AddOn'), 'hidden' => false),
                    'Tooltip' => array('dependencies' => array('chart/AddOn','svg/TextBox','svg/Rect'), 'hidden' => false),
                    'Text' => array('dependencies' => array('chart/Base'), 'hidden' => false),
                    'ChartLabels' => array('dependencies' => array('chart/Base'), 'hidden' => false),
                    'ChartValues' => array('dependencies' => array('chart/Base'), 'hidden' => false),
                    'Bar' => array('dependencies' => array('chart/Base'), 'hidden' => false),
                    'BarItem' => array('dependencies' => array('chart/Fragment'), 'hidden' => true),
                    'Line' => array('dependencies' => array('chart/Base'), 'hidden' => false),
                    'Area' => array('dependencies' => array('chart/Line'), 'hidden' => false),
                    'LineItem' => array('dependencies' => array('chart/Fragment'), 'hidden' => true),
                    'LineDot' => array('dependencies' => array('svg/Path'), 'hidden' => true),
                    'Outline' => array('dependencies' => array('chart/Base'), 'hidden' => true),
                    'LineUtil' => array('dependencies' => array(), 'hidden' => true),
                    'Scatter' => array('dependencies' => array('chart/Base'), 'hidden' => true),
                    'ScatterSeries' => array('dependencies' => array('chart/Fragment'), 'hidden' => true),
                    'ChartUtil' => array('dependencies' => array(), 'hidden' => true),
                    'Ticks' => array('dependencies' => array('chart/Base'), 'hidden' => true),
                    'BgLines' => array('dependencies' => array('chart/Base'), 'hidden' => true),
                )
            ),
            'tpl' => array(
                'hidden' => true,
                'modules' => array(
                    'Parser' => array(
                        'hidden' => true
                    )
                )
            ),
            'ludo-db' => array(
                'hidden' => true,
                'modules' => array(
                    'Factory' => array(
                        'hidden' => false
                    )
                )
            ),
            'color' => array(
                'hidden' => false,
                'modules' => array(
                    'Color' => array('dependencies' => array(), 'hidden' => false),
                    'Base' => array('dependencies' => array('View'), 'hidden' => false),
                    'Boxes' => array('dependencies' => array('color/Base'), 'hidden' => false),
                    'NamedColors' => array('dependencies' => array('color/Boxes'), 'hidden' => false),
                    'RgbColors' => array('dependencies' => array('color/Boxes'), 'hidden' => false),
                )
            ),
            'layout' => array(
                'hidden' => true,
                'modules' => array(
                    'Factory' => array('dependencies' => array('Core'), 'hidden' => true),
                    'Resizer' => array('dependencies' => array('Core'), 'hidden' => true),
                    'Base' => array('dependencies' => array('layout/Resizer', 'layout/TextBox'), 'hidden' => true, array()),
                    'Table' => array('dependencies' => array('layout/Base'), 'hidden' => true),
                    'Accordion' => array('dependencies' => array('layout/Base'), 'hidden' => true, 'css'=>array("accordion.css")),
                    'Linear' => array('dependencies' => array('layout/Base'), 'hidden' => true),
                    'LinearHorizontal' => array('dependencies' => array('layout/Linear'), 'hidden' => false),
                    'LinearVertical' => array('dependencies' => array('layout/Linear'), 'hidden' => false),
                    'ViewPager' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Tab' => array('dependencies' => array('layout/Relative', 'layout/Tabs'), 'hidden' => false, "css" => array("tab.css","tab-strip.css")),
                    'Docking' => array('dependencies' => array('layout/Tab'), 'hidden' => false),
                    'Fill' => array('dependencies' => array('layout/Relative'), 'hidden' => false),
                    'Grid' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Popup' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Relative' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Canvas' => array('dependencies' => array('layout/Relative'), 'hidden' => false),
                    'NavBar' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Menu' => array('dependencies' => array('layout/Base','layout/menu-container.js'), 'hidden' => true),
                    'MenuHorizontal' => array('dependencies' => array('layout/Menu'), 'hidden' => false),
                    'MenuVertical' => array('dependencies' => array('layout/Menu'), 'hidden' => false),
                    'Tabs' => array('dependencies' => array('View'), 'hidden' => true),
                    'TextBox' => array('dependencies' => array('svg/Canvas'), 'hidden' => true),
                    'Renderer' => array('dependencies' => array(), 'hidden' => true),
                    'CollapseBar' => array('dependencies' => array('View'), 'hidden' => true),
                )
            ),
            'View' => array(
                'dependencies' => array(
                    'dom.js',
                    'util.js',
                    'Core',
                    'tpl/Parser',
                    'layout/Renderer',
                    'data-source/JSON',
                    'view/shim.js',
                    'remote/shim.js',
                    'layout/Factory',
                    'layout/Base'
                ),
                'css' => array('view.css','resize.css')
            ),
            'CollectionView' => array(
                'dependencies' => array(
                    'View'
                )
            ),
            'ListView' => array(
                'dependencies' => array('CollectionView'), 'css'=>true
            ),
            'Notification' => array(
                'dependencies' => array('View')
            ),
            'FramedView' => array(
                'dependencies' => array('View', 'view/button-bar.js', 'effect/Resize', 'view/title-bar.js', 'effect/Drag')
            ),
            'Application' => array(
                'dependencies' => array('FramedView')
            ),
            'Window' => array(
                'dependencies' => array('FramedView'),'css' => 'window.css'
            ),
            'grid' => array(
                'modules' => array(
                    'Grid' => array('dependencies' => array(
                        'View', 'scroller.js', 'grid/grid-header.js', 'grid/ColumnMove', 'col-resize.js', 'grid/column-manager.js', 'grid/row-manager.js', 'data-source/JsonArray'
                    ), 'css' => array('grid.css')),
                    'ColumnMove' => array('hidden' => true, 'dependencies' => array('effect/DragDrop')),
                )
            ),
            'view' => array(
                'modules' => array(
                    'ViewPagerNav' => array('dependencies' => array('View'), 'css' => true)
                )

            ),

            'calendar' => array(
                'modules' => array(
                    'Base' => array('dependencies' => array('View'), 'hidden' => true),
                    'Calendar' => array('dependencies' => array('calendar/Base')),
                    'Days' => array('dependencies' => array('calendar/Base')),
                    'NavBar' => array('dependencies' => array('calendar/Base')),
                    'Selector' => array('dependencies' => array('calendar/Base'), 'hidden' => true),
                    'MonthSelector' => array('dependencies' => array('calendar/Base')),
                    'Today' => array('dependencies' => array('calendar/Base')),
                    'YearSelector' => array('dependencies' => array('calendar/Selector')),
                    'MonthYearSelector' => array('dependencies' => array('calendar/Selector')),
                    'TimePicker' => array('dependencies' => array('View','util/geometry.js')),
                ),
                'css' => true
            ),
            'effect' => array(
                'modules' => array(
                    'Effect' => array(
                        'dependencies' => array('Core', 'dom.js')
                    ),
                    'Drag' => array(
                        'dependencies' => array('effect/Effect', 'effect/DraggableNode')
                    ),
                    'DragDrop' => array(
                        'dependencies' => array('effect/Drag', 'effect/DropPoint')
                    ),
                    'Resize' => array(
                        'dependencies' => array('Core')
                    ),
                    'DraggableNode' => array(
                        'hidden' => true
                    ),
                    'DropPoint' => array(
                        'hidden' => true
                    )
                )

            ),
            'menu' => array(
                'modules' => array(
                    'Item' => array('dependencies' => array('View'),'css' => 'menu.css'),
                    'Menu' => array('dependencies' => array('View', 'menu/Item')),
                    'Context' => array('dependencies' => array('View')),
                    'DropDown' => array('dependencies' => array('menu/Menu')),
                    'Button' => array('dependencies' => array('View'),'css' => 'button.css'),
                )
            ),
            'tree' => array(
                'modules' => array(
                    'Tree' => array(
                        'dependencies' => array('CollectionView','dataSource/JsonTree'),'css' => 'tree.css'
                    )
                )
            ),
            'data-source' => array(
                'modules' => array(
                    'Base' => array(
                        'dependencies' => array('Core'),
                        'hidden' => true
                    ),
                    'JSON' => array(
                        'dependencies' => array('data-source/Base')
                    ),
                    'HTML' => array(
                        'dependencies' => array('data-source/Base')
                    ),
                    'JsonArray' => array(
                        'dependencies' => array('data-source/JSON', 'data-source/JsonArraySearch', 'data-source/Record')
                    ),
                    'JsonTree' => array(
                        'dependencies' => array('data-source/JsonArray')
                    ),
                    'JsonTreeSearch',
                    'JsonArraySearch' => array(
                        'hidden' => true,
                        'dependencies' => array('data-source/SearchParser')
                    ),
                    'SearchParser' => array(
                        'hidden' => true
                    ),
                    'Record' => array(
                        'hidden' => true
                    )
                )
            ),
            'controller' => array(
                'modules' => array(
                    'Controller' => array(
                        'dependencies' => array('controller/Manager')
                    ),
                    'Manager' => array('hidden' => true)
                )
            ),
            'progress' => array(
                'modules' => array(
                    'Bar' => array(
                        'dependencies' => array('View'), 'css'=>true
                    ),
                    'Donut' => array(
                        'dependencies' => array('View')
                    )
                )
            ),
            'form' => array(
                'modules' => array(
                    'Element' => array('dependencies' => array('View','form/validator/fns.js'), 'hidden' => true, 'css' => 'form.css'),
                    'LabelElement' => array('dependencies' => array('form/Element'), 'hidden' => true),
                    'Button' => array('dependencies' => array('form/Element'), "css" => true),
                    'ToggleGroup' => array('dependencies' => array('Core'), 'hidden' => true),
                    'SubmitButton' => array('dependencies' => array('form/Button', 'form/Manager')),
                    'CancelButton' => array('dependencies' => array('form/Button')),
                    'Date' => array('dependencies' => array('form/Combo','calendar/Calendar')),
                    'Color' => array('dependencies' => array('form/Combo','color/Color','color/Boxes','color/NamedColors','color/RgbColors'), 'css' => 'color.css'),
                    'ResetButton' => array('dependencies' => array('form/Button', 'form/Manager')),
                    'Combo' => array('dependencies' => array('form/Text'), "css" => true),
                    'ComboTree' => array('dependencies' => array('form/Element', 'tree/Tree'), "css" => "filter-tree.css"),
                    'Label' => array('dependencies' => array('form/Element')),
                    'Text' => array('dependencies' => array('form/LabelElement'), 'css' => 'text.css'),
                    'Textarea' => array('dependencies' => array('form/Text')),
                    'DisplayField' => array('dependencies' => array('form/Element')),
                    'Checkbox' => array('dependencies' => array('form/Element')),
                    'Radio' => array('dependencies' => array('form/Element'), "css" => true),
                    'Manager' => array('dependencies' => array('Core')),
                    'Password' => array('dependencies' => array('form/Text', 'external/Md5')),
                    'StrongPassword' => array('dependencies' => array('form/Password')),
                    'Number' => array('dependencies' => array('form/Text')),
                    'Email' => array('dependencies' => array('form/Text')),
                    'Spinner' => array('dependencies' => array('form/Text'), "css" => true),
                    'Select' => array('dependencies' => array('form/LabelElement')),
                    'RadioGroup' => array('dependencies' => array('form/Element', 'form/Checkbox')),
                    'OnOff' => array('dependencies' => array('form/LabelElement'), "css" => true),
                    'Seekbar' => array('dependencies' => array('form/Element'), "css" => true),
                    'File' => array('dependencies' => array('form/Element', 'form/LabelElement'), "css" => true),
                    'Slider' => array('dependencies' => array('form/LabelElement', 'form/LabelElement', 'effect/Drag'), "css" => true),
                    'SearchField' => array('dependencies' => array('form/Text')),
                    'validator' => array(
                        'modules' => array(
                            'Base' => array('dependencies' => array('Core'), 'hidden' => true),
                            'Md5' => array('dependencies' => array('form/validator/Base')),
                        )
                    ),
                )
            ),
            'paging' => array(
                'modules' => array(
                    'Button' => array('dependencies' => array('form/Button')),
                    'Next' => array('dependencies' => array('paging/Button')),
                    'Previous' => array('dependencies' => array('paging/Button')),
                    'Last' => array('dependencies' => array('paging/Button')),
                    'First' => array('dependencies' => array('paging/Button')),
                    'PageInput' => array('dependencies' => array('form/Number')),
                    'CurrentPage' => array('dependencies' => array('View')),
                    'TotalPages' => array('dependencies' => array('View')),
                    'NavBar' => array('dependencies' => array('View')),
                    'PageSize' => array('dependencies' => array('form/Select')),
                )
            ),
            'external' => array(
                'modules' => array(
                    'Md5' => array('hidden' => true)
                ),
                'hidden' => true
            ),
            'Panel' => array(
                'dependencies' => array('View'),
                'css' => array('Panel.css')
            ),
            'dialog' => array(
                'modules' => array(
                    'Dialog' => array('dependencies' => array('Window'), 'css' => 'dialog.css'),
                    'Confirm' => array('dependencies' => array('dialog/Dialog')),
                    'Alert' => array('dependencies' => array('dialog/Dialog')),
                    'Prompt' => array('dependencies' => array('dialog/Dialog', 'form/Text'))
                ),

            ),
            'video' => array(
                'modules' => array(
                    'Video' => array('dependencies' => array('View'), 'hidden' => true),
                    'YouTube' => array('dependencies' => array('video/Video'))
                )
            ),
            'svg' => array(
                'modules' => array(
                    'Effect' => array('dependencies' => array()),
                    'Engine' => array('dependencies' => array("Core")),
                    'Node' => array('dependencies' => array('svg/Engine','svg/util.js')),
                    'Paint' => array('dependencies' => array('svg/Node')),
                    'View' => array('dependencies' => array('Core', 'svg/Node')),
                    'Canvas' => array('dependencies' => array('svg/View','svg/Matrix')),
                    'Group' => array('dependencies' => array('svg/View')),
                    'Gradient' => array('dependencies' => array('svg/NamedNode')),
                    'RadialGradient' => array('dependencies' => array('svg/Gradient')),
                    'Stop' => array('dependencies' => array('svg/Node')),
                    'Drag' => array('dependencies' => array('effect/Drag')),
                    'EventManager' => array('dependencies' => array()),
                    'NamedNode' => array('dependencies' => array('svg/Node','svg/Paint')),
                    'Rect' => array('dependencies' => array('svg/NamedNode')),
                    'Path' => array('dependencies' => array('svg/NamedNode')),
                    'Text' => array('dependencies' => array('svg/NamedNode')),
                    'Filter' => array('dependencies' => array('svg/NamedNode')),
                    'Mask' => array('dependencies' => array('svg/NamedNode')),
                    'Animation' => array('dependencies' => array('color/Color')),
                    'TextBox' => array('dependencies' => array('svg/Group')),
                    'Matrix' => array('dependencies' => array('Core')),
                )
            )
        );
    }

    public function getLicenseText(){
        return "/************************************************************************************************************
                @fileoverview
                ludoJS - Javascript framework, [VERSION]
                Copyright (C) 2012-[DATE]  ludoJS.com, Alf Magne Kalleland

                This library is free software; you can redistribute it and/or
                modify it under the terms of the GNU Lesser General Public
                License as published by the Free Software Foundation; either
                version 2.1 of the License, or (at your option) any later version.

                This library is distributed in the hope that it will be useful,
                but WITHOUT ANY WARRANTY; without even the implied warranty of
                MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
                Lesser General Public License for more details.

                You should have received a copy of the GNU Lesser General Public
                License along with this library; if not, write to the Free Software
                Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

                ludoJS.com., hereby disclaims all copyright interest in this script
                written by Alf Magne Kalleland.

                Alf Magne Kalleland, [DATE]
                Owner of ludoJS.com
                ************************************************************************************************************/";
    }

    public function getExternalModuleDependencies(){
        return array();
    }

    public function getCssSkins(){
        return array(
            "blue" =>  "blue.css",
            "gray" =>  "gray.css",
            "light-gray" =>  "light-gray.css",
            "twilight" =>  "twilight.css"
        );
    }

    public function getVersion(){
        return "1.1";
    }

    public function getFilesForZip()
    {
        return array(
            "images", "js", "css", "src", "jquery", "README.md", "samples"

        );
    }

    public function getUrlsToRunBeforeStart(){
        return array("http://localhost/ludojs/demos-to-html.php");
    }

}

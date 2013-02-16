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
                    'ludo.js', 'effect.js', 'language/default.js', 'storage/storage.js', 'object-factory.js', 'config.js'
                ),
                'hidden' => true
            ),
            'Movable' => array(
                'hidden' => true
            ),
            'remote' => array(
                'modules' => array(
                    'JSON' => array('dependencies' => array()),
                    'Broadcaster' => array('dependencies' => array()),
                    'Message' => array('dependencies' => array('View')),
                    'ErrorMessage' => array('dependencies' => array('remote/Message')),
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
            'color' => array(
                'hidden' => false,
                'modules' => array(
                    'Color' => array('dependencies' => array(), 'hidden' => false),
                )
            ),
            'layout' => array(
                'hidden' => true,
                'modules' => array(
                    'Factory' => array('dependencies' => array('Core'), 'hidden' => true),
                    'Resizer' => array('dependencies' => array('Core'), 'hidden' => true),
                    'Base' => array('dependencies' => array('layout/Resizer', 'layout/TextBox'), 'hidden' => true, array("collapse-bar.css")),
                    'Linear' => array('dependencies' => array('layout/Base'), 'hidden' => true),
                    'LinearHorizontal' => array('dependencies' => array('layout/Linear'), 'hidden' => false),
                    'LinearVertical' => array('dependencies' => array('layout/Linear'), 'hidden' => false),
                    'Card' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Tab' => array('dependencies' => array('layout/Relative', 'layout/TabStrip'), 'hidden' => false, "css" => true),
                    'Fill' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Grid' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Popup' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'Relative' => array('dependencies' => array('layout/Base'), 'hidden' => false),
                    'TabStrip' => array('dependencies' => array('View'), 'hidden' => true),
                    'TextBox' => array('dependencies' => array('canvas/Canvas'), 'hidden' => true),
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
                    'view/loader.js',
                    'layout/Factory',
                    'layout/Base'
                ),
                'css' => array('view.css','resize.css')
            ),
            'Notification' => array(
                'dependencies' => array('View')
            ),
            'socket' => array(
                'modules' => array(
                    'Socket' => array('dependencies' => array('Core'))
                )
            ),
            'FramedView' => array(
                'dependencies' => array('View', 'view/button-bar.js', 'effect/Resize', 'view/status-bar.js', 'view/title-bar.js', 'effect/Drag')
            ),
            'Application' => array(
                'dependencies' => array('FramedView')
            ),
            'Window' => array(
                'dependencies' => array('FramedView'),'css' => 'window.css'
            ),
            'Accordion' => array(
                'dependencies' => array('FramedView'),'css' => true
            ),
            'grid' => array(
                'modules' => array(
                    'Grid' => array('dependencies' => array(
                        'View', 'scroller.js', 'grid/grid-header.js', 'grid/ColumnMove', 'col-resize.js', 'grid/column-manager.js', 'grid/row-manager.js', 'data-source/Collection'
                    ), 'css' => array('grid.css')),
                    'ColumnMove' => array('hidden' => true, 'dependencies' => array('effect/DragDrop')),
                )
            ),
            'card' => array(
                'modules' => array(
                    'Button' => array('dependencies' => array('form/Button')),
                    'FinishButton' => array('dependencies' => array('card/Button')),
                    'NextButton' => array('dependencies' => array('card/Button')),
                    'PreviousButton' => array('dependencies' => array('card/Button')),
                    'ProgressBar' => array('dependencies' => array('progress/Bar')),
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
            'model' => array(
                'modules' => array(
                    'Model' => array(
                        'dependencies' => array()
                    )
                )
            ),
            'menu' => array(
                'modules' => array(
                    'MenuItem' => array('dependencies' => array('View', 'menu/MenuHandler'),'css' => 'menu.css'),
                    'Menu' => array('dependencies' => array('View', 'menu/MenuHandler', 'menu/MenuItem')),
                    'Context' => array('dependencies' => array('menu/Menu')),
                    'DropDown' => array('dependencies' => array('menu/Menu')),
                    'MenuHandler' => array('hidden' => true),
                    'Button' => array('dependencies' => array('View'),'css' => 'button.css'),
                )
            ),
            'tree' => array(
                'modules' => array(
                    'Tree' => array(
                        'dependencies' => array('View'),'css' => 'tree.css'
                    ),
                    'DragDrop' => array(
                        'dependencies' => array('Movable', 'tree/Modifications')
                    ),
                    'Modifications' => array('hidden' => true),
                    'Filter' => array('hidden' => true),
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
                    'Collection' => array(
                        'dependencies' => array('data-source/JSON', 'data-source/CollectionSearch', 'data-source/Record')
                    ),
                    'CollectionSearch' => array(
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
                    'Base' => array(
                        'dependencies' => array('View', 'progress/Datasource'), 'hidden' => true
                    ),
                    'Bar' => array(
                        'dependencies' => array('progress/Base')
                    ),
                    'Text' => array(
                        'dependencies' => array('progress/Base')
                    ),
                    'Datasource' => array(
                        'dependencies' => array('data-source/JSON'), 'hidden' => true
                    )
                )
            ),
            'form' => array(
                'modules' => array(
                    'Element' => array('dependencies' => array('View'), 'hidden' => true, 'css' => 'form.css'),
                    'LabelElement' => array('dependencies' => array('form/Element'), 'hidden' => true),
                    'Button' => array('dependencies' => array('form/Element'), "css" => true),
                    'ToggleGroup' => array('dependencies' => array('Core'), 'hidden' => true),
                    'TinyButton' => array('dependencies' => array('form/Button'),"css" => true),
                    'SubmitButton' => array('dependencies' => array('form/Button', 'form/Manager')),
                    'CancelButton' => array('dependencies' => array('form/Button')),
                    'ResetButton' => array('dependencies' => array('form/Button', 'form/Manager')),
                    'Combo' => array('dependencies' => array('form/Element'), "css" => true),
                    'ComboTree' => array('dependencies' => array('form/Element', 'tree/Tree')),
                    'Hidden' => array('dependencies' => array('form/Element')),
                    'Text' => array('dependencies' => array('form/LabelElement'), 'css' => 'text.css'),
                    'Textarea' => array('dependencies' => array('form/Text')),
                    'DisplayField' => array('dependencies' => array('form/Element')),
                    'Checkbox' => array('dependencies' => array('form/Element')),
                    'Radio' => array('dependencies' => array('form/Element'), "css" => true),
                    'Manager' => array('dependencies' => array('Core')),
                    'Password' => array('dependencies' => array('form/Text', 'external/Md5')),
                    'Number' => array('dependencies' => array('form/Text')),
                    'Email' => array('dependencies' => array('form/Text')),
                    'Spinner' => array('dependencies' => array('form/Text'), "css" => true),
                    'Select' => array('dependencies' => array('form/LabelElement')),
                    'FilterText' => array('dependencies' => array('form/Text')),
                    'RadioGroup' => array('dependencies' => array('form/Element', 'form/Checkbox')),
                    'File' => array('dependencies' => array('form/Element', 'form/LabelElement'), "css" => true),
                    'Slider' => array('dependencies' => array('form/LabelElement', 'form/LabelElement', 'effect/Drag'), "css" => true),
                    'SearchField' => array('dependencies' => array('form/Text')),
                ),
                'validator' => array(
                    'modules' => array(
                        'Base' => array('dependencies' => array('Core'), 'hidden' => true),
                        'Md5' => array('dependencies' => array('form/validator/Base')),
                    )
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
                    'TotalPages' => array('dependencies' => array('View')),
                    'NavBar' => array('dependencies' => array('View')),
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
            'Anchor' => array(
                'dependencies' => array('View'),'css' => 'anchor.css'
            ),
            'dialog' => array(
                'modules' => array(
                    'Dialog' => array('dependencies' => array('Window'), 'css' => 'dialog.css'),
                    'Confirm' => array('dependencies' => array('dialog/Dialog')),
                    'Alert' => array('dependencies' => array('dialog/Dialog')),
                    'Prompt' => array('dependencies' => array('dialog/Dialog', 'form/Text')),
                    'Form' => array('dependencies' => array('dialog/Dialog', 'form/Text')),
                ),

            ),
            'video' => array(
                'modules' => array(
                    'Video' => array('dependencies' => array('View'), 'hidden' => true),
                    'YouTube' => array('dependencies' => array('video/Video')),
                    'GoogleVideo' => array('dependencies' => array('video/Video')),
                    'DailyMotion' => array('dependencies' => array('video/Video')),
                )
            ),
            'canvas' => array(
                'modules' => array(
                    'Engine' => array('dependencies' => array("Core")),
                    'Node' => array('dependencies' => array('canvas/Engine')),
                    'Paint' => array('dependencies' => array('canvas/Node')),
                    'Element' => array('dependencies' => array('Core', 'canvas/Node')),
                    'Canvas' => array('dependencies' => array('canvas/Element')),
                    'Gradient' => array('dependencies' => array('canvas/NamedNode')),
                    'RadialGradient' => array('dependencies' => array('canvas/Gradient')),
                    'Stop' => array('dependencies' => array('canvas/Node')),
                    'Drag' => array('dependencies' => array('effect/Drag')),
                    'EventManager' => array('dependencies' => array()),
                    'NamedNode' => array('dependencies' => array('canvas/Node')),
                    'Circle' => array('dependencies' => array('canvas/NamedNode')),
                    'Rect' => array('dependencies' => array('canvas/NamedNode')),
                    'Polyline' => array('dependencies' => array('canvas/NamedNode')),
                    'Polygon' => array('dependencies' => array('canvas/Polyline')),
                    'Ellipse' => array('dependencies' => array('canvas/NamedNode')),
                    'Path' => array('dependencies' => array('canvas/NamedNode')),
                    'Filter' => array('dependencies' => array('canvas/NamedNode')),
                    'Mask' => array('dependencies' => array('canvas/NamedNode')),
                )
            )
        );
    }

    public function getLicenseText(){

    }

    public function getExternalModuleDependencies(){
        return array();
    }

    public function getCssSkins(){
        return array(
            "blue" =>  "ludo-all-blue-skin.css",
            "gray" =>  "ludo-all-gray-skin.css",
            "light-gray" =>  "ludo-all-light-gray-skin.css",
            "ocean" =>  "ludo-all-ocean-skin.css"
        );
    }
}

<?php
/**
 * page_numbering
 * @aurhor Vladimir Shestakov
 * @version 1.0
 */
namespace boolive\navigations\page_numbering;

use boolive\basic\widget\widget;
use boolive\core\request\Request;
use boolive\core\values\Rule;

class page_numbering extends widget
{
    function startRule()
    {
        return Rule::arrays([
            'REQUEST' => Rule::arrays([
                'object' => Rule::entity()->required(),
                'page' => Rule::int()->default(1)->required(),
                'page_count' => Rule::int()->more(3)->default(3)->required()
            ])
        ]);
    }

    function show($v, Request $request)
    {
        $obj = $request['REQUEST']['object'];
        $v['uri'] = Request::url($obj->uri());
        $v['count'] = $request['REQUEST']['page_count'];
        $v['current'] = min($v['count'], $request['REQUEST']['page']);
        $v['show'] = $this->show_cnt->value();
        return parent::show($v, $request);
    }
} 
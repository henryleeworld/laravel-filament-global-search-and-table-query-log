<?php

return [

    'form' => [

        'operator' => [
            'label' => '運算子',
        ],

        'or_groups' => [

            'block' => [
                'label' => '析取（或）',
                'or' => 'OR',
            ],

        ],

    ],

    'no_rules' => '（沒有規則）',

    'item_separators' => [
        'and' => '和',
        'or' => '或',
    ],

    'operators' => [

        'boolean' => [

            'is_true' => [

                'label' => [
                    'direct' => '是真',
                    'inverse' => '是假',
                ],

                'summary' => [
                    'direct' => ':attribute 是真',
                    'inverse' => ':attribute 是假',
                ],

            ],

        ],

        'number' => [

            'equals' => [

                'label' => [
                    'direct' => '等於',
                    'inverse' => '不等於',
                ],

                'summary' => [
                    'direct' => ':attribute 等於 :number',
                    'inverse' => ':attribute 不等於 :number',
                ],

            ],

            'is_max' => [

                'label' => [
                    'direct' => '是最大值',
                    'inverse' => '大於',
                ],

                'summary' => [
                    'direct' => ':attribute 最大為 :number',
                    'inverse' => ':attribute 大於 :number',
                ],

            ],

            'is_min' => [

                'label' => [
                    'direct' => '是最小值',
                    'inverse' => '小於',
                ],

                'summary' => [
                    'direct' => ':attribute 最小為 :number',
                    'inverse' => ':attribute 小於 :number',
                ],

            ],

            'form' => [

                'number' => [
                    'label' => '數字',
                ],

            ],

        ],

        'text' => [

            'form' => [

                'text' => [
                    'label' => '內容',
                ],

            ],

        ],

    ],

    'actions' => [

        'add_rule' => [
            'label' => '新增規則',
        ],

        'add_rule_group' => [
            'label' => '新增規則群組',
        ],

    ],

];

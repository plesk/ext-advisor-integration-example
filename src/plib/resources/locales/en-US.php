<?php

$messages = [
    'app' => [
        'index' => [
            'title' => 'Advisor Integration Example',
        ],

        'section' => [
            'general' => 'Server-wide options',
            'entities' => 'Entities options',
        ],

        'option' => [
            'setA' => 'Option A',
            'setAHint' => 'Assume this single option do one good thing and you want to suggest your customers to keep it on.',

            'setB' => 'Option B',
            'setBHint' => 'Assume this option do awesome, although it take some time, still you also suggest your customers to keep it on.',

            'setC' => 'Option C',
            'setCHint' => 'Assume this stuff also useful, especially in couple of option D, so your customers would be better to keep it both.',

            'setD' => 'Option D',
            'setDHint' => 'Assume this stuff also useful, especially in couple of option C, so your customers would be better to keep it both.',

            'setE' => 'Option E',
            'setEHint' => 'Assume this option is a little tricking: it definitely should be on, but for the good reason it also should be on for all domains on the server. Let\'s summarize this one: your customers need to turn it on on the server level and just then turn it on for each domain on the server. And you can suggest them to do it!',
            'setEEntities' => 'Domains',

            'setF' => 'Option F',
            'setFHint' => 'Assume this option is similar to option E. Actually, you want both to be a part of a single recommendation. All this is possible.',
            'setFEntities' => 'Domains',
        ],

        'entity' => [
            'optionE' => [
                'title' => 'Set option E for domains',
                'action' => [
                    'turnOn' => 'Turn on',
                    'turnOff' => 'Turn off',
                ],
            ],
            'optionF' => [
                'title' => 'Set option F for domains',
                'action' => [
                    'turnOn' => 'Turn on',
                    'turnOff' => 'Turn off',
                ],
            ],
            'column' => [
                'title' => [
                    'name' => 'Domain name',
                    'optionE' => 'Option E',
                    'optionF' => 'Option F',
                ],
                'value' => [
                    'on' => 'On',
                    'off' => 'Off',
                ],
            ],
        ]
    ],

    'recommendationDefaultAction' => 'Open',

    'recommendation1' => 'Achieve the desired state #1',
    'recommendation1Hint' => 'Let\'s imaging that your extension is able to made something valuable for customers, so you want to suggest him to do single click to archive it.',
    'recommendation1OptionATurnedOn' => 'Option A is turned on',
    'recommendation1OptionATurnedOff' => 'Option A is turned off',
    'recommendation1TurnOnOptionA' => 'Turn on option A',

    'recommendation2' => 'Achieve the desired state #2',
    'recommendation2Hint' => 'At the second course, assume you have an another thing to suggest to your customer. It could take some time but all efforts will be rewarded!',
    'recommendation2OptionBTurnedOn' => 'Option B is turned on',
    'recommendation2OptionBTurnedOff' => 'Option B is turned off',
    'recommendation2TurnOnOptionB' => 'Turn on option B',
    'recommendation2TurnOnOptionBProgress' => 'Turning on option B...',

    'recommendation3' => 'Achieve the desired state #3',
    'recommendation3Hint' => 'Imaging two another options to apply, one by one, to achieve that we desire so much.',
    'recommendation3OptionCTurnedOn' => 'Option C is turned on',
    'recommendation3OptionCTurnedOff' => 'Option C is turned off',
    'recommendation3TurnOnOptionC' => 'Turn on option C',
    'recommendation3OptionDTurnedOn' => 'Option D is turned on',
    'recommendation3OptionDTurnedOff' => 'Option D is turned off',
    'recommendation3TurnOnOptionD' => 'Turn on option D',

    'recommendation4' => 'Achieve the desired state #4',
    'recommendation4Hint' => 'Welcome to the high grade! Let\'s imaging that your extension is able to something amazing with domains on the server. This feature must be turned on at the server level first, and then enabled for all existing domains. This is the desired state #4 and this recommendation will allow to establish it.',
    'recommendation4TurnOnOptionsEF' => 'Turn on options E and F',
    'recommendation4OptionsTurnedOn' => 'Options E and F are turned on',
    'recommendation4OptionsTurnedOff' => 'Option E or F or both are turned off',
    'recommendation4TurnOnEntityOptionE' => 'Turn on entity option E',
    'recommendation4EntityOptionETurnedOn' => 'Option E is turned on for all domains',
    'recommendation4EntityOptionETurnedOff' => 'Option E is turned off for one or several domains',
    'recommendation4TurnOnEntityOptionF' => 'Turn on entity option F',
    'recommendation4EntityOptionFTurnedOn' => 'Option F is turned on for all domains',
    'recommendation4EntityOptionFTurnedOff' => 'Option F is turned off for one or several domains',
    'recommendation4TableColumnName' => 'Domain name',
    'recommendation4TableColumnOptionE' => 'Option E',
    'recommendation4TableColumnOptionF' => 'Option F',
    'recommendation4TableValueOptionTurnedOn' => 'Turned on',
    'recommendation4TableValueOptionTurnedOff' => 'Turned off',
];

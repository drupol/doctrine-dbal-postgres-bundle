<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\drupol\DoctrineDbalPostgresqlBundle\DependencyInjection;

use drupol\DoctrineDbalPostgresqlBundle\DependencyInjection\DoctrineDbalPostgresqlExtension;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineDbalPostgresqlExtensionSpec extends ObjectBehavior
{
    public function it_do_not_change_anything_if_doctrine_extension_is_not_available(ContainerBuilder $containerBuilder)
    {
        $containerBuilder
            ->hasExtension('doctrine')
            ->willReturn(false)
            ->shouldBeCalledOnce();

        $this
            ->prepend($containerBuilder)
            ->shouldReturn(false);
    }

    public function it_is_initializable(ContainerBuilder $containerBuilder)
    {
        $this->shouldHaveType(DoctrineDbalPostgresqlExtension::class);

        $containerBuilder->setParameter()->shouldNotBeCalled();

        $this->load([], $containerBuilder);
    }

    public function it_setup_the_doctrine_configuration(ContainerBuilder $containerBuilder)
    {
        $containerBuilder
            ->hasExtension('doctrine')
            ->willReturn(true)
            ->shouldBeCalledOnce();

        $containerBuilder
            ->loadFromExtension(
                'doctrine',
                [
                    'orm' => [
                        'dql' => [
                            'string_functions' => [
                                'CONTAINS' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\Contains',
                                'CONTAINED' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\Contained',
                                'GET_JSON_FIELD' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\GetJsonField',
                                'GET_JSON_FIELD_BY_KEY' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\GetJsonFieldByKey',
                                'GET_JSON_OBJECT' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\GetJsonObject',
                                'GET_JSON_OBJECT_TEXT' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\GetJsonObjectText',
                                'ANY_OP' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\Any',
                                'ALL_OP' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\All',
                                'ARR' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\Arr',
                                'ARR_APPEND' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\ArrayAppend',
                                'ARR_REPLACE' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\ArrayReplace',
                                'REGEXP_REPLACE' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\RegexpReplace',
                                'ARR_REMOVE' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\ArrayRemove',
                                'ARR_CONTAINS' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\ArrayContains',
                                'TO_TSQUERY' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\ToTsquery',
                                'TO_TSVECTOR' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\ToTsvector',
                                'TS_CONCAT_OP' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\TsConcat',
                                'TS_MATCH_OP' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\TsMatch',
                                'UNNEST' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\Unnest',
                                'JSON_AGG' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\JsonAgg',
                                'JSONB_ARRAY_ELEM_TEXT' => 'Opsway\\Doctrine\\ORM\\Query\\AST\\Functions\\JsonbArrayElementsText',
                            ],
                        ],
                    ],
                ]
            )
            ->shouldBeCalledOnce();

        $this->prepend($containerBuilder);
    }
}

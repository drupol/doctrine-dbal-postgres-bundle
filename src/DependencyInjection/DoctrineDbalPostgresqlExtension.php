<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace drupol\DoctrineDbalPostgresqlBundle\DependencyInjection;

use Opsway\Doctrine\ORM\Query\AST\Functions\All;
use Opsway\Doctrine\ORM\Query\AST\Functions\Any;
use Opsway\Doctrine\ORM\Query\AST\Functions\Arr;
use Opsway\Doctrine\ORM\Query\AST\Functions\ArrayAppend;
use Opsway\Doctrine\ORM\Query\AST\Functions\ArrayContains;
use Opsway\Doctrine\ORM\Query\AST\Functions\ArrayRemove;
use Opsway\Doctrine\ORM\Query\AST\Functions\ArrayReplace;
use Opsway\Doctrine\ORM\Query\AST\Functions\Contained;
use Opsway\Doctrine\ORM\Query\AST\Functions\Contains;
use Opsway\Doctrine\ORM\Query\AST\Functions\GetJsonField;
use Opsway\Doctrine\ORM\Query\AST\Functions\GetJsonFieldByKey;
use Opsway\Doctrine\ORM\Query\AST\Functions\GetJsonObject;
use Opsway\Doctrine\ORM\Query\AST\Functions\GetJsonObjectText;
use Opsway\Doctrine\ORM\Query\AST\Functions\JsonAgg;
use Opsway\Doctrine\ORM\Query\AST\Functions\JsonbArrayElementsText;
use Opsway\Doctrine\ORM\Query\AST\Functions\RegexpReplace;
use Opsway\Doctrine\ORM\Query\AST\Functions\ToTsquery;
use Opsway\Doctrine\ORM\Query\AST\Functions\ToTsvector;
use Opsway\Doctrine\ORM\Query\AST\Functions\TsConcat;
use Opsway\Doctrine\ORM\Query\AST\Functions\TsMatch;
use Opsway\Doctrine\ORM\Query\AST\Functions\Unnest;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class DoctrineDbalPostgresqlExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        // noop
    }

    public function prepend(ContainerBuilder $container)
    {
        if (false === $container->hasExtension('doctrine')) {
            return false;
        }

        $container
            ->loadFromExtension(
                'doctrine',
                [
                    'orm' => [
                        'dql' => [
                            'string_functions' => [
                                'CONTAINS' => Contains::class,
                                'CONTAINED' => Contained::class,
                                'GET_JSON_FIELD' => GetJsonField::class,
                                'GET_JSON_FIELD_BY_KEY' => GetJsonFieldByKey::class,
                                'GET_JSON_OBJECT' => GetJsonObject::class,
                                'GET_JSON_OBJECT_TEXT' => GetJsonObjectText::class,
                                'ANY_OP' => Any::class,
                                'ALL_OP' => All::class,
                                'ARR' => Arr::class,
                                'ARR_APPEND' => ArrayAppend::class,
                                'ARR_REPLACE' => ArrayReplace::class,
                                'REGEXP_REPLACE' => RegexpReplace::class,
                                'ARR_REMOVE' => ArrayRemove::class,
                                'ARR_CONTAINS' => ArrayContains::class,
                                'TO_TSQUERY' => ToTsquery::class,
                                'TO_TSVECTOR' => ToTsvector::class,
                                'TS_CONCAT_OP' => TsConcat::class,
                                'TS_MATCH_OP' => TsMatch::class,
                                'UNNEST' => Unnest::class,
                                'JSON_AGG' => JsonAgg::class,
                                'JSONB_ARRAY_ELEM_TEXT' => JsonbArrayElementsText::class,
                            ],
                        ],
                    ],
                ],
            );
    }
}

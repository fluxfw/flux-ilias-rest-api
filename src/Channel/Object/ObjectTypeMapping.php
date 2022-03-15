<?php

namespace FluxIliasRestApi\Channel\Object;

use FluxIliasRestApi\Adapter\Api\Object\CustomObjectType;
use FluxIliasRestApi\Adapter\Api\Object\LegacyDefaultObjectType;
use FluxIliasRestApi\Adapter\Api\Object\ObjectType;

class ObjectTypeMapping
{

    public static function mapExternalToInternal(ObjectType $type) : InternalObjectType
    {
        return CustomInternalObjectType::factory(array_flip(static::INTERNAL_EXTERNAL())[$type->value] ?? substr($type->value, 1));
    }


    public static function mapInternalToExternal(InternalObjectType $type) : ObjectType
    {
        return CustomObjectType::factory(static::INTERNAL_EXTERNAL()[$type->value] ?? "_" . $type->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyDefaultInternalObjectType::BIBL()->value => LegacyDefaultObjectType::BIBLIOGRAPHY()->value,
            LegacyDefaultInternalObjectType::BLOG()->value => LegacyDefaultObjectType::BLOG()->value,
            LegacyDefaultInternalObjectType::BOOK()->value => LegacyDefaultObjectType::BOOKING_POOL()->value,
            LegacyDefaultInternalObjectType::CAT()->value  => LegacyDefaultObjectType::CATEGORY()->value,
            LegacyDefaultInternalObjectType::CATR()->value => LegacyDefaultObjectType::CATEGORY_LINK()->value,
            LegacyDefaultInternalObjectType::CHTR()->value => LegacyDefaultObjectType::CHAT_ROOM()->value,
            LegacyDefaultInternalObjectType::CLD()->value  => LegacyDefaultObjectType::CLOUD_OBJECT()->value,
            LegacyDefaultInternalObjectType::CMIX()->value => LegacyDefaultObjectType::XAPI_CMI5()->value,
            LegacyDefaultInternalObjectType::COPA()->value => LegacyDefaultObjectType::CONTENT_PAGE()->value,
            LegacyDefaultInternalObjectType::CRS()->value  => LegacyDefaultObjectType::COURSE()->value,
            LegacyDefaultInternalObjectType::CRSR()->value => LegacyDefaultObjectType::COURSE_LINK()->value,
            LegacyDefaultInternalObjectType::DCL()->value  => LegacyDefaultObjectType::DATA_COLLECTION()->value,
            LegacyDefaultInternalObjectType::EXC()->value  => LegacyDefaultObjectType::EXERCISE()->value,
            LegacyDefaultInternalObjectType::FEED()->value => LegacyDefaultObjectType::WEB_FEED()->value,
            LegacyDefaultInternalObjectType::FILE()->value => LegacyDefaultObjectType::FILE()->value,
            LegacyDefaultInternalObjectType::FOLD()->value => LegacyDefaultObjectType::FOLDER()->value,
            LegacyDefaultInternalObjectType::FRM()->value  => LegacyDefaultObjectType::FORUM()->value,
            LegacyDefaultInternalObjectType::GLO()->value  => LegacyDefaultObjectType::GLOSSARY()->value,
            LegacyDefaultInternalObjectType::GRP()->value  => LegacyDefaultObjectType::GROUP()->value,
            LegacyDefaultInternalObjectType::GRPR()->value => LegacyDefaultObjectType::GROUP_LINK()->value,
            LegacyDefaultInternalObjectType::HTLM()->value => LegacyDefaultObjectType::HTML_LEARNING_MODULE()->value,
            LegacyDefaultInternalObjectType::IASS()->value => LegacyDefaultObjectType::INDIVIDUAL_ASSESSMENT()->value,
            LegacyDefaultInternalObjectType::ITGR()->value => LegacyDefaultObjectType::ITEM_GROUP()->value,
            LegacyDefaultInternalObjectType::LM()->value   => LegacyDefaultObjectType::ILIAS_LEARNING_MODULE()->value,
            LegacyDefaultInternalObjectType::LSO()->value  => LegacyDefaultObjectType::LEARNING_SEQUENCE()->value,
            LegacyDefaultInternalObjectType::LTI()->value  => LegacyDefaultObjectType::LTI_CONSUMER()->value,
            LegacyDefaultInternalObjectType::MCST()->value => LegacyDefaultObjectType::MEDIA_CAST()->value,
            LegacyDefaultInternalObjectType::MEP()->value  => LegacyDefaultObjectType::MEDIA_POOL()->value,
            LegacyDefaultInternalObjectType::ORGU()->value => LegacyDefaultObjectType::ORGANISATIONAL_UNIT()->value,
            LegacyDefaultInternalObjectType::POLL()->value => LegacyDefaultObjectType::POLL()->value,
            LegacyDefaultInternalObjectType::PRG()->value  => LegacyDefaultObjectType::STUDY_PROGRAMME()->value,
            LegacyDefaultInternalObjectType::PRGR()->value => LegacyDefaultObjectType::LINK_TO_STUDY_PROGRAMME()->value,
            LegacyDefaultInternalObjectType::PRTT()->value => LegacyDefaultObjectType::PORTFOLIO_TEMPLATE()->value,
            LegacyDefaultInternalObjectType::QPL()->value  => LegacyDefaultObjectType::QUESTION_POOL_TEST()->value,
            LegacyDefaultInternalObjectType::ROLE()->value => LegacyDefaultObjectType::ROLE()->value,
            LegacyDefaultInternalObjectType::ROOT()->value => LegacyDefaultObjectType::ROOT()->value,
            LegacyDefaultInternalObjectType::SAHS()->value => LegacyDefaultObjectType::SCORM_LEARNING_MODULE()->value,
            LegacyDefaultInternalObjectType::SESS()->value => LegacyDefaultObjectType::SESSION()->value,
            LegacyDefaultInternalObjectType::SPL()->value  => LegacyDefaultObjectType::QUESTION_POOL_SURVEY()->value,
            LegacyDefaultInternalObjectType::SVY()->value  => LegacyDefaultObjectType::SURVEY()->value,
            LegacyDefaultInternalObjectType::TST()->value  => LegacyDefaultObjectType::TEST()->value,
            LegacyDefaultInternalObjectType::USR()->value  => LegacyDefaultObjectType::USER()->value,
            LegacyDefaultInternalObjectType::WEBR()->value => LegacyDefaultObjectType::WEB_LINK()->value,
            LegacyDefaultInternalObjectType::WIKI()->value => LegacyDefaultObjectType::WIKI()->value
        ];
    }
}

<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectType;

final class ObjectTypeMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalObjectType::BIBL => ObjectType::BIBLIOGRAPHY,
            InternalObjectType::BLOG => ObjectType::BLOG,
            InternalObjectType::BOOK => ObjectType::BOOKING_POOL,
            InternalObjectType::CAT  => ObjectType::CATEGORY,
            InternalObjectType::CATR => ObjectType::CATEGORY_LINK,
            InternalObjectType::CHTR => ObjectType::CHAT_ROOM,
            InternalObjectType::CLD  => ObjectType::CLOUD_OBJECT,
            InternalObjectType::CMIX => ObjectType::XAPI_CMI5,
            InternalObjectType::COPA => ObjectType::CONTENT_PAGE,
            InternalObjectType::CRS  => ObjectType::COURSE,
            InternalObjectType::CRSR => ObjectType::COURSE_LINK,
            InternalObjectType::DCL  => ObjectType::DATA_COLLECTION,
            InternalObjectType::EXC  => ObjectType::EXERCISE,
            InternalObjectType::FEED => ObjectType::WEB_FEED,
            InternalObjectType::FILE => ObjectType::FILE,
            InternalObjectType::FOLD => ObjectType::FOLDER,
            InternalObjectType::FRM  => ObjectType::FORUM,
            InternalObjectType::GLO  => ObjectType::GLOSSARY,
            InternalObjectType::GRP  => ObjectType::GROUP,
            InternalObjectType::GRPR => ObjectType::GROUP_LINK,
            InternalObjectType::HTLM => ObjectType::HTML_LEARNING_MODULE,
            InternalObjectType::IASS => ObjectType::INDIVIDUAL_ASSESSMENT,
            InternalObjectType::ITGR => ObjectType::ITEM_GROUP,
            InternalObjectType::LM   => ObjectType::ILIAS_LEARNING_MODULE,
            InternalObjectType::LSO  => ObjectType::LEARNING_SEQUENCE,
            InternalObjectType::LTI  => ObjectType::LTI_CONSUMER,
            InternalObjectType::MCST => ObjectType::MEDIA_CAST,
            InternalObjectType::MEP  => ObjectType::MEDIA_POOL,
            InternalObjectType::ORGU => ObjectType::ORGANISATIONAL_UNIT,
            InternalObjectType::POLL => ObjectType::POLL,
            InternalObjectType::PRG  => ObjectType::STUDY_PROGRAMME,
            InternalObjectType::PRGR => ObjectType::LINK_TO_STUDY_PROGRAMME,
            InternalObjectType::PRTT => ObjectType::PORTFOLIO_TEMPLATE,
            InternalObjectType::QPL  => ObjectType::QUESTION_POOL_TEST,
            InternalObjectType::ROLE => ObjectType::ROLE,
            InternalObjectType::ROOT => ObjectType::ROOT,
            InternalObjectType::SAHS => ObjectType::SCORM_LEARNING_MODULE,
            InternalObjectType::SESS => ObjectType::SESSION,
            InternalObjectType::SPL  => ObjectType::QUESTION_POOL_SURVEY,
            InternalObjectType::SVY  => ObjectType::SURVEY,
            InternalObjectType::TST  => ObjectType::TEST,
            InternalObjectType::USR  => ObjectType::USER,
            InternalObjectType::WEBR => ObjectType::WEB_LINK,
            InternalObjectType::WIKI => ObjectType::WIKI
        ];


    public static function mapExternalToInternal(?string $type) : string
    {
        return array_flip(static::INTERNAL_EXTERNAL)[$type] ?? substr($type, 1);
    }


    public static function mapInternalToExternal(?string $type) : string
    {
        return static::INTERNAL_EXTERNAL[$type] ?? "_" . $type;
    }
}

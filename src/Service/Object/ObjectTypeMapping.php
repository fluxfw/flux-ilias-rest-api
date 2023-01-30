<?php

namespace FluxIliasRestApi\Service\Object;

use FluxIliasBaseApi\Adapter\Object\CustomObjectType;
use FluxIliasBaseApi\Adapter\Object\DefaultObjectType;
use FluxIliasBaseApi\Adapter\Object\ObjectType;

class ObjectTypeMapping
{

    public static function mapExternalToInternal(ObjectType $type) : InternalObjectType
    {
        return CustomInternalObjectType::factory(
            array_flip(static::INTERNAL_EXTERNAL())[$type->value] ?? substr($type->value, 1)
        );
    }


    public static function mapInternalToExternal(InternalObjectType $type) : ObjectType
    {
        return CustomObjectType::factory(
            static::INTERNAL_EXTERNAL()[$type->value] ?? "_" . $type->value
        );
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            DefaultInternalObjectType::BIBL->value => DefaultObjectType::BIBLIOGRAPHY->value,
            DefaultInternalObjectType::BLOG->value => DefaultObjectType::BLOG->value,
            DefaultInternalObjectType::BOOK->value => DefaultObjectType::BOOKING_POOL->value,
            DefaultInternalObjectType::CAT->value  => DefaultObjectType::CATEGORY->value,
            DefaultInternalObjectType::CATR->value => DefaultObjectType::CATEGORY_LINK->value,
            DefaultInternalObjectType::CHTR->value => DefaultObjectType::CHAT_ROOM->value,
            DefaultInternalObjectType::CLD->value  => DefaultObjectType::CLOUD_OBJECT->value,
            DefaultInternalObjectType::CMIX->value => DefaultObjectType::XAPI_CMI5->value,
            DefaultInternalObjectType::COPA->value => DefaultObjectType::CONTENT_PAGE->value,
            DefaultInternalObjectType::CRS->value  => DefaultObjectType::COURSE->value,
            DefaultInternalObjectType::CRSR->value => DefaultObjectType::COURSE_LINK->value,
            DefaultInternalObjectType::DCL->value  => DefaultObjectType::DATA_COLLECTION->value,
            DefaultInternalObjectType::EXC->value  => DefaultObjectType::EXERCISE->value,
            DefaultInternalObjectType::FEED->value => DefaultObjectType::WEB_FEED->value,
            DefaultInternalObjectType::FILE->value => DefaultObjectType::FILE->value,
            DefaultInternalObjectType::FOLD->value => DefaultObjectType::FOLDER->value,
            DefaultInternalObjectType::FRM->value  => DefaultObjectType::FORUM->value,
            DefaultInternalObjectType::GLO->value  => DefaultObjectType::GLOSSARY->value,
            DefaultInternalObjectType::GRP->value  => DefaultObjectType::GROUP->value,
            DefaultInternalObjectType::GRPR->value => DefaultObjectType::GROUP_LINK->value,
            DefaultInternalObjectType::HTLM->value => DefaultObjectType::HTML_LEARNING_MODULE->value,
            DefaultInternalObjectType::IASS->value => DefaultObjectType::INDIVIDUAL_ASSESSMENT->value,
            DefaultInternalObjectType::ITGR->value => DefaultObjectType::ITEM_GROUP->value,
            DefaultInternalObjectType::LM->value   => DefaultObjectType::ILIAS_LEARNING_MODULE->value,
            DefaultInternalObjectType::LSO->value  => DefaultObjectType::LEARNING_SEQUENCE->value,
            DefaultInternalObjectType::LTI->value  => DefaultObjectType::LTI_CONSUMER->value,
            DefaultInternalObjectType::MCST->value => DefaultObjectType::MEDIA_CAST->value,
            DefaultInternalObjectType::MEP->value  => DefaultObjectType::MEDIA_POOL->value,
            DefaultInternalObjectType::ORGU->value => DefaultObjectType::ORGANISATIONAL_UNIT->value,
            DefaultInternalObjectType::POLL->value => DefaultObjectType::POLL->value,
            DefaultInternalObjectType::PRG->value  => DefaultObjectType::STUDY_PROGRAMME->value,
            DefaultInternalObjectType::PRGR->value => DefaultObjectType::LINK_TO_STUDY_PROGRAMME->value,
            DefaultInternalObjectType::PRTT->value => DefaultObjectType::PORTFOLIO_TEMPLATE->value,
            DefaultInternalObjectType::QPL->value  => DefaultObjectType::QUESTION_POOL_TEST->value,
            DefaultInternalObjectType::ROLE->value => DefaultObjectType::ROLE->value,
            DefaultInternalObjectType::ROOT->value => DefaultObjectType::ROOT->value,
            DefaultInternalObjectType::SAHS->value => DefaultObjectType::SCORM_LEARNING_MODULE->value,
            DefaultInternalObjectType::SESS->value => DefaultObjectType::SESSION->value,
            DefaultInternalObjectType::SPL->value  => DefaultObjectType::QUESTION_POOL_SURVEY->value,
            DefaultInternalObjectType::SVY->value  => DefaultObjectType::SURVEY->value,
            DefaultInternalObjectType::TST->value  => DefaultObjectType::TEST->value,
            DefaultInternalObjectType::USR->value  => DefaultObjectType::USER->value,
            DefaultInternalObjectType::WEBR->value => DefaultObjectType::WEB_LINK->value,
            DefaultInternalObjectType::WIKI->value => DefaultObjectType::WIKI->value,
            DefaultInternalObjectType::XFRO->value => DefaultObjectType::FLUX_ILIAS_REST_OBJECT->value
        ];
    }
}

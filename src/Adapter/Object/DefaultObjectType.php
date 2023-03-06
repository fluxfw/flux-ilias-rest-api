<?php

namespace FluxIliasRestApi\Adapter\Object;

enum DefaultObjectType: string implements ObjectType
{

    case BIBLIOGRAPHY = "bibliography";
    case BLOG = "blog";
    case BOOKING_POOL = "booking_pool";
    case CATEGORY = "category";
    case CATEGORY_LINK = "category_link";
    case CHAT_ROOM = "chat_room";
    case CLOUD_OBJECT = "cloud_object";
    case CONTENT_PAGE = "content_page";
    case COURSE = "course";
    case COURSE_LINK = "course_link";
    case DATA_COLLECTION = "data_collection";
    case EXERCISE = "exercise";
    case FILE = "file";
    case FLUX_ILIAS_REST_OBJECT = "flux_ilias_rest_object";
    case FOLDER = "folder";
    case FORUM = "forum";
    case GLOSSARY = "glossary";
    case GROUP = "group";
    case GROUP_LINK = "group_link";
    case HTML_LEARNING_MODULE = "html_learning_module";
    case ILIAS_LEARNING_MODULE = "ilias_learning_module";
    case INDIVIDUAL_ASSESSMENT = "individual_assessment";
    case ITEM_GROUP = "item_group";
    case LEARNING_SEQUENCE = "learning_sequence";
    case LINK_TO_STUDY_PROGRAMME = "link_to_study_programme";
    case LTI_CONSUMER = "lti_consumer";
    case MEDIA_CAST = "media_cast";
    case MEDIA_POOL = "media_pool";
    case ORGANISATIONAL_UNIT = "organisational_unit";
    case POLL = "poll";
    case PORTFOLIO_TEMPLATE = "portfolio_template";
    case QUESTION_POOL_SURVEY = "question_pool_survey";
    case QUESTION_POOL_TEST = "question_pool_test";
    case ROLE = "role";
    case ROOT = "root";
    case SCORM_LEARNING_MODULE = "scorm_learning_module";
    case SESSION = "session";
    case STUDY_PROGRAMME = "study_programme";
    case SURVEY = "survey";
    case TEST = "test";
    case USER = "user";
    case WEB_FEED = "web_feed";
    case WEB_LINK = "web_link";
    case WIKI = "wiki";
    case XAPI_CMI5 = "xapi_cmi5";
}

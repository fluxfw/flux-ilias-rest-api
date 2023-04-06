<?php

namespace FluxIliasRestApi\Adapter\Object;

enum DefaultObjectType: string implements ObjectType
{

    case BIBLIOGRAPHY = "bibliography";
    case BLOG = "blog";
    case BOOKING_POOL = "booking-pool";
    case CATEGORY = "category";
    case CATEGORY_LINK = "category-link";
    case CHAT_ROOM = "chat-room";
    case CLOUD_OBJECT = "cloud-object";
    case CONTENT_PAGE = "content-page";
    case COURSE = "course";
    case COURSE_LINK = "course-link";
    case DATA_COLLECTION = "data-collection";
    case EXERCISE = "exercise";
    case FILE = "file";
    case FLUX_ILIAS_REST_OBJECT = "flux-ilias-rest-object";
    case FOLDER = "folder";
    case FORUM = "forum";
    case GLOSSARY = "glossary";
    case GROUP = "group";
    case GROUP_LINK = "group-link";
    case HTML_LEARNING_MODULE = "html-learning-module";
    case ILIAS_LEARNING_MODULE = "ilias-learning-odule";
    case INDIVIDUAL_ASSESSMENT = "individual-assessment";
    case ITEM_GROUP = "item-group";
    case LEARNING_SEQUENCE = "learning-sequence";
    case LINK_TO_STUDY_PROGRAMME = "link-to-study-programme";
    case LTI_CONSUMER = "lti-consumer";
    case MEDIA_CAST = "media-cast";
    case MEDIA_POOL = "media-pool";
    case ORGANISATIONAL_UNIT = "organisational-unit";
    case POLL = "poll";
    case PORTFOLIO_TEMPLATE = "portfolio-template";
    case QUESTION_POOL_SURVEY = "question-pool-survey";
    case QUESTION_POOL_TEST = "question-pool-test";
    case ROLE = "role";
    case ROOT = "root";
    case SCORM_LEARNING_MODULE = "scorm-learning-module";
    case SESSION = "session";
    case STUDY_PROGRAMME = "study-programme";
    case SURVEY = "survey";
    case TEST = "test";
    case USER = "user";
    case WEB_FEED = "web-feed";
    case WEB_LINK = "web-link";
    case WIKI = "wiki";
    case XAPI_CMI5 = "xapi-cmi5";
}

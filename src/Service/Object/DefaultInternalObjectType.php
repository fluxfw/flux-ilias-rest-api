<?php

namespace FluxIliasRestApi\Service\Object;

enum DefaultInternalObjectType: string implements InternalObjectType
{

    case BIBL = "bibl";
    case BLOG = "blog";
    case BOOK = "book";
    case CAT = "cat";
    case CATR = "catr";
    case CHTR = "chtr";
    case CLD = "cld";
    case CMIX = "cmix";
    case COPA = "copa";
    case CRS = "crs";
    case CRSR = "crsr";
    case DCL = "dcl";
    case EXC = "exc";
    case FEED = "feed";
    case FILE = "file";
    case FOLD = "fold";
    case FRM = "frm";
    case GLO = "glo";
    case GRP = "grp";
    case GRPR = "grpr";
    case HTLM = "htlm";
    case IASS = "iass";
    case ITGR = "itgr";
    case LM = "lm";
    case LSO = "lso";
    case LTI = "lti";
    case MCST = "mcst";
    case MEP = "mep";
    case ORGU = "orgu";
    case POLL = "poll";
    case PRG = "prg";
    case PRGR = "prgr";
    case PRTT = "prtt";
    case QPL = "qpl";
    case ROLE = "role";
    case ROOT = "root";
    case SAHS = "sahs";
    case SESS = "sess";
    case SPL = "spl";
    case SVY = "svy";
    case TST = "tst";
    case USR = "usr";
    case WEBR = "webr";
    case WIKI = "wiki";
    case XFRO = "xfro";
}

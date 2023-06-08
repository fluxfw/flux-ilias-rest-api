<?php

namespace FluxIliasRestApi\Service\User\Command;

use FluxIliasRestApi\Adapter\User\UserDiffDto;
use FluxIliasRestApi\Adapter\User\UserIdDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\Timestamp\TimestampQuery;
use FluxIliasRestApi\Service\User\UserQuery;
use ILIAS\DI\RBACServices;

class CreateUserCommand
{

    use TimestampQuery;
    use UserQuery;

    private function __construct(
        private readonly RBACServices $ilias_rbac,
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        RBACServices $ilias_rbac,
        ObjectService $object_service
    ) : static {
        return new static(
            $ilias_rbac,
            $object_service
        );
    }


    public function createUser(UserDiffDto $diff) : UserIdDto
    {
        $ilias_user = $this->newIliasUser();

        $ilias_user->setActive(true);
        $ilias_user->setTimeLimitUnlimited(true);

        $this->mapUserDiff(
            $diff,
            $ilias_user
        );

        $ilias_user->create();
        $ilias_user->saveAsNew();

        $this->ilias_rbac->admin()->assignUser(4, $ilias_user->getId());

        return UserIdDto::new(
            $ilias_user->getId() ?: null,
            $diff->import_id
        );
    }
}

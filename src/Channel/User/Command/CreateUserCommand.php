<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\User\UserQuery;
use ILIAS\DI\RBACServices;

class CreateUserCommand
{

    use UserQuery;

    private ObjectService $object;
    private RBACServices $rbac;


    public static function new(RBACServices $rbac, ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->rbac = $rbac;
        $command->object = $object;

        return $command;
    }


    public function createUser(UserDiffDto $diff) : UserIdDto
    {
        $ilias_user = $this->newIliasUser();

        $ilias_user->setActive(true);
        $ilias_user->setTimeLimitUnlimited(true);

        $this->mapDiff(
            $diff,
            $ilias_user
        );

        $ilias_user->create();
        $ilias_user->saveAsNew();

        $this->rbac->admin()->assignUser(SYSTEM_USER_ID, $ilias_user->getId());

        return UserIdDto::new(
            $ilias_user->getId(),
            $diff->getImportId()
        );
    }
}

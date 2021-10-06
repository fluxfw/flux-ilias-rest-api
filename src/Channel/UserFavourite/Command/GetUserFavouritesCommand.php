<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\UserFavourite\Command;

use Fluxlabs\FluxIliasRestApi\Channel\UserFavourite\UserFavouriteQuery;
use ilDBInterface;

class GetUserFavouritesCommand
{

    use UserFavouriteQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getUserFavourites(?int $user_id = null, ?string $user_import_id = null, ?int $object_id = null, ?string $object_import_id = null, ?int $object_ref_id = null) : array
    {
        return array_map([$this, "mapUserFavouriteDto"], $this->database->fetchAll($this->database->query($this->getUserFavouriteQuery(
            $user_id,
            $user_import_id,
            $object_id,
            $object_import_id,
            $object_ref_id
        ))));
    }
}

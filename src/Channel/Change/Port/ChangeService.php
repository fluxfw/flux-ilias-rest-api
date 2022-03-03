<?php

namespace FluxIliasRestApi\Channel\Change\Port;

use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Channel\Category\Port\CategoryService;
use FluxIliasRestApi\Channel\Change\Command\CreateChangeDatabaseCommand;
use FluxIliasRestApi\Channel\Change\Command\DropChangeDatabaseCommand;
use FluxIliasRestApi\Channel\Change\Command\GetChangeCronJobsCommand;
use FluxIliasRestApi\Channel\Change\Command\GetChangesCommand;
use FluxIliasRestApi\Channel\Change\Command\HandleIliasEventCommand;
use FluxIliasRestApi\Channel\Change\Command\KeepChangesInsideDaysConfigCommand;
use FluxIliasRestApi\Channel\Change\Command\LastTransferredChangeTimeCommand;
use FluxIliasRestApi\Channel\Change\Command\PurgeChangesCommand;
use FluxIliasRestApi\Channel\Change\Command\TransferChangesCommand;
use FluxIliasRestApi\Channel\Change\Command\TransferChangesPostUrlConfigCommand;
use FluxIliasRestApi\Channel\Config\Port\ConfigService;
use FluxIliasRestApi\Channel\Course\Port\CourseService;
use FluxIliasRestApi\Channel\CourseMember\Port\CourseMemberService;
use FluxIliasRestApi\Channel\File\Port\FileService;
use FluxIliasRestApi\Channel\Group\Port\GroupService;
use FluxIliasRestApi\Channel\GroupMember\Port\GroupMemberService;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\ObjectLearningProgress\Port\ObjectLearningProgressService;
use FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use FluxIliasRestApi\Channel\OrganisationalUnitStaff\Port\OrganisationalUnitStaffService;
use FluxIliasRestApi\Channel\Role\Port\RoleService;
use FluxIliasRestApi\Channel\ScormLearningModule\Port\ScormLearningModuleService;
use FluxIliasRestApi\Channel\User\Port\UserService;
use FluxIliasRestApi\Channel\UserRole\Port\UserRoleService;
use ilDBInterface;

class ChangeService
{

    private CategoryService $category;
    private ConfigService $config;
    private CourseService $course;
    private CourseMemberService $course_member;
    private ilDBInterface $database;
    private FileService $file;
    private GroupService $group;
    private GroupMemberService $group_member;
    private ObjectService $object;
    private ObjectLearningProgressService $object_learning_progress;
    private OrganisationalUnitService $organisational_unit;
    private OrganisationalUnitStaffService $organisational_unit_staff;
    private RoleService $role;
    private ScormLearningModuleService $scorm_learning_module;
    private UserService $user;
    private UserRoleService $user_role;


    public static function new(
        ilDBInterface $database,
        ConfigService $config,
        CategoryService $category,
        CourseService $course,
        CourseMemberService $course_member,
        FileService $file,
        GroupService $group,
        GroupMemberService $group_member,
        ObjectService $object,
        ObjectLearningProgressService $object_learning_progress,
        OrganisationalUnitService $organisational_unit,
        OrganisationalUnitStaffService $organisational_unit_staff,
        RoleService $role,
        ScormLearningModuleService $scorm_learning_module,
        UserService $user,
        UserRoleService $user_role
    ) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->config = $config;
        $service->category = $category;
        $service->course = $course;
        $service->course_member = $course_member;
        $service->file = $file;
        $service->group = $group;
        $service->group_member = $group_member;
        $service->object = $object;
        $service->object_learning_progress = $object_learning_progress;
        $service->organisational_unit = $organisational_unit;
        $service->organisational_unit_staff = $organisational_unit_staff;
        $service->role = $role;
        $service->scorm_learning_module = $scorm_learning_module;
        $service->user = $user;
        $service->user_role = $user_role;

        return $service;
    }


    public function createChangeDatabase() : void
    {
        CreateChangeDatabaseCommand::new(
            $this->database
        )
            ->createChangeDatabase();
    }


    public function dropChangeDatabase() : void
    {
        DropChangeDatabaseCommand::new(
            $this->database
        )
            ->dropChangeDatabase();
    }


    public function getChangeCronJobs() : array
    {
        return GetChangeCronJobsCommand::new(
            $this
        )
            ->getChangeCronJobs();
    }


    public function getChanges(?float $from = null, ?float $to = null, ?float $after = null, ?float $before = null) : ?array
    {
        return GetChangesCommand::new(
            $this->database
        )
            ->getChanges(
                $from,
                $to,
                $after,
                $before
            );
    }


    public function getKeepChangesInsideDays() : int
    {
        return KeepChangesInsideDaysConfigCommand::new(
            $this->config
        )
            ->getKeepChangesInsideDays();
    }


    public function getLastTransferredChangeTime() : ?float
    {
        return LastTransferredChangeTimeCommand::new(
            $this->config
        )
            ->getLastTransferredChangeTime();
    }


    public function getTransferChangesPostUrl() : string
    {
        return TransferChangesPostUrlConfigCommand::new(
            $this->config
        )
            ->getTransferChangesPostUrl();
    }


    public function handleIliasEvent(UserDto $user, string $component, string $event, array $parameters) : void
    {
        HandleIliasEventCommand::new(
            $this->database,
            $this->category,
            $this->course,
            $this->course_member,
            $this->file,
            $this->group,
            $this->group_member,
            $this->object,
            $this->object_learning_progress,
            $this->organisational_unit,
            $this->organisational_unit_staff,
            $this->role,
            $this->scorm_learning_module,
            $this->user,
            $this->user_role
        )
            ->handleIliasEvent(
                $user,
                $component,
                $event,
                $parameters
            );
    }


    public function purgeChanges() : ?int
    {
        return PurgeChangesCommand::new(
            $this->database,
            $this
        )
            ->purgeChanges();
    }


    public function setKeepChangesInsideDays(int $keep_changes_inside_days) : void
    {
        KeepChangesInsideDaysConfigCommand::new(
            $this->config
        )
            ->setKeepChangesInsideDays(
                $keep_changes_inside_days
            );
    }


    public function setLastTransferredChangeTime(float $last_transferred_change_time) : void
    {
        LastTransferredChangeTimeCommand::new(
            $this->config
        )
            ->setLastTransferredChangeTime(
                $last_transferred_change_time
            );
    }


    public function setTransferChangesPostUrl(string $transfer_changes_url) : void
    {
        TransferChangesPostUrlConfigCommand::new(
            $this->config
        )
            ->setTransferChangesPostUrl(
                $transfer_changes_url
            );
    }


    public function transferChanges() : ?int
    {
        return TransferChangesCommand::new(
            $this->database,
            $this
        )
            ->transferChanges();
    }
}

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

    private CategoryService $category_service;
    private ConfigService $config_service;
    private CourseMemberService $course_member_service;
    private CourseService $course_service;
    private FileService $file_service;
    private GroupMemberService $group_member_service;
    private GroupService $group_service;
    private ilDBInterface $ilias_database;
    private ObjectLearningProgressService $object_learning_progress_service;
    private ObjectService $object_service;
    private OrganisationalUnitService $organisational_unit_service;
    private OrganisationalUnitStaffService $organisational_unit_staff_service;
    private RoleService $role_service;
    private ScormLearningModuleService $scorm_learning_module_service;
    private UserRoleService $user_role_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ConfigService $config_service,
        /*private readonly*/ CategoryService $category_service,
        /*private readonly*/ CourseService $course_service,
        /*private readonly*/ CourseMemberService $course_member_service,
        /*private readonly*/ FileService $file_service,
        /*private readonly*/ GroupService $group_service,
        /*private readonly*/ GroupMemberService $group_member_service,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ObjectLearningProgressService $object_learning_progress_service,
        /*private readonly*/ OrganisationalUnitService $organisational_unit_service,
        /*private readonly*/ OrganisationalUnitStaffService $organisational_unit_staff_service,
        /*private readonly*/ RoleService $role_service,
        /*private readonly*/ ScormLearningModuleService $scorm_learning_module_service,
        /*private readonly*/ UserService $user_service,
        /*private readonly*/ UserRoleService $user_role_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->config_service = $config_service;
        $this->category_service = $category_service;
        $this->course_service = $course_service;
        $this->course_member_service = $course_member_service;
        $this->file_service = $file_service;
        $this->group_service = $group_service;
        $this->group_member_service = $group_member_service;
        $this->object_service = $object_service;
        $this->object_learning_progress_service = $object_learning_progress_service;
        $this->organisational_unit_service = $organisational_unit_service;
        $this->organisational_unit_staff_service = $organisational_unit_staff_service;
        $this->role_service = $role_service;
        $this->scorm_learning_module_service = $scorm_learning_module_service;
        $this->user_service = $user_service;
        $this->user_role_service = $user_role_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ConfigService $config_service,
        CategoryService $category_service,
        CourseService $course_service,
        CourseMemberService $course_member_service,
        FileService $file_service,
        GroupService $group_service,
        GroupMemberService $group_member_service,
        ObjectService $object_service,
        ObjectLearningProgressService $object_learning_progress_service,
        OrganisationalUnitService $organisational_unit_service,
        OrganisationalUnitStaffService $organisational_unit_staff_service,
        RoleService $role_service,
        ScormLearningModuleService $scorm_learning_module_service,
        UserService $user_service,
        UserRoleService $user_role_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $config_service,
            $category_service,
            $course_service,
            $course_member_service,
            $file_service,
            $group_service,
            $group_member_service,
            $object_service,
            $object_learning_progress_service,
            $organisational_unit_service,
            $organisational_unit_staff_service,
            $role_service,
            $scorm_learning_module_service,
            $user_service,
            $user_role_service
        );
    }


    public function createChangeDatabase() : void
    {
        CreateChangeDatabaseCommand::new(
            $this->ilias_database
        )
            ->createChangeDatabase();
    }


    public function dropChangeDatabase() : void
    {
        DropChangeDatabaseCommand::new(
            $this->ilias_database
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
            $this->ilias_database
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
            $this->config_service
        )
            ->getKeepChangesInsideDays();
    }


    public function getLastTransferredChangeTime() : ?float
    {
        return LastTransferredChangeTimeCommand::new(
            $this->config_service
        )
            ->getLastTransferredChangeTime();
    }


    public function getTransferChangesPostUrl() : string
    {
        return TransferChangesPostUrlConfigCommand::new(
            $this->config_service
        )
            ->getTransferChangesPostUrl();
    }


    public function handleIliasEvent(UserDto $user, string $component, string $event, array $parameters) : void
    {
        HandleIliasEventCommand::new(
            $this->ilias_database,
            $this->category_service,
            $this->course_service,
            $this->course_member_service,
            $this->file_service,
            $this->group_service,
            $this->group_member_service,
            $this->object_service,
            $this->object_learning_progress_service,
            $this->organisational_unit_service,
            $this->organisational_unit_staff_service,
            $this->role_service,
            $this->scorm_learning_module_service,
            $this->user_service,
            $this->user_role_service
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
            $this->ilias_database,
            $this
        )
            ->purgeChanges();
    }


    public function setKeepChangesInsideDays(int $keep_changes_inside_days) : void
    {
        KeepChangesInsideDaysConfigCommand::new(
            $this->config_service
        )
            ->setKeepChangesInsideDays(
                $keep_changes_inside_days
            );
    }


    public function setLastTransferredChangeTime(float $last_transferred_change_time) : void
    {
        LastTransferredChangeTimeCommand::new(
            $this->config_service
        )
            ->setLastTransferredChangeTime(
                $last_transferred_change_time
            );
    }


    public function setTransferChangesPostUrl(string $transfer_changes_url) : void
    {
        TransferChangesPostUrlConfigCommand::new(
            $this->config_service
        )
            ->setTransferChangesPostUrl(
                $transfer_changes_url
            );
    }


    public function transferChanges() : ?int
    {
        return TransferChangesCommand::new(
            $this->ilias_database,
            $this
        )
            ->transferChanges();
    }
}

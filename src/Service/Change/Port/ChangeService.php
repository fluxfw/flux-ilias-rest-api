<?php

namespace FluxIliasRestApi\Service\Change\Port;

use FluxIliasRestApi\Adapter\Change\ChangeDto;
use FluxIliasRestApi\Adapter\Cron\Change\PurgeChangesCronJob;
use FluxIliasRestApi\Adapter\Cron\Change\TransferChangesCronJob;
use FluxIliasRestApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Category\Port\CategoryService;
use FluxIliasRestApi\Service\Change\Command\CreateChangeDatabaseCommand;
use FluxIliasRestApi\Service\Change\Command\DropChangeDatabaseCommand;
use FluxIliasRestApi\Service\Change\Command\GetChangeCronJobsCommand;
use FluxIliasRestApi\Service\Change\Command\GetChangesCommand;
use FluxIliasRestApi\Service\Change\Command\GetKeepChangesInsideDaysCommand;
use FluxIliasRestApi\Service\Change\Command\GetLastTransferredChangeTimeCommand;
use FluxIliasRestApi\Service\Change\Command\GetPurgeChangesCronJobCommand;
use FluxIliasRestApi\Service\Change\Command\GetPurgeChangesScheduleCommand;
use FluxIliasRestApi\Service\Change\Command\GetTransferChangesCronJobCommand;
use FluxIliasRestApi\Service\Change\Command\GetTransferChangesPasswordCommand;
use FluxIliasRestApi\Service\Change\Command\GetTransferChangesPostUrlCommand;
use FluxIliasRestApi\Service\Change\Command\GetTransferChangesScheduleCommand;
use FluxIliasRestApi\Service\Change\Command\GetTransferChangesUserCommand;
use FluxIliasRestApi\Service\Change\Command\HandleIliasEventCommand;
use FluxIliasRestApi\Service\Change\Command\IsEnableLogChangesCommand;
use FluxIliasRestApi\Service\Change\Command\IsEnablePurgeChangesCommand;
use FluxIliasRestApi\Service\Change\Command\IsEnableTransferChangesCommand;
use FluxIliasRestApi\Service\Change\Command\PurgeChangesCommand;
use FluxIliasRestApi\Service\Change\Command\SetEnableLogChangesCommand;
use FluxIliasRestApi\Service\Change\Command\SetEnablePurgeChangesCommand;
use FluxIliasRestApi\Service\Change\Command\SetEnableTransferChangesCommand;
use FluxIliasRestApi\Service\Change\Command\SetKeepChangesInsideDaysCommand;
use FluxIliasRestApi\Service\Change\Command\SetLastTransferredChangeTimeCommand;
use FluxIliasRestApi\Service\Change\Command\SetPurgeChangesScheduleCommand;
use FluxIliasRestApi\Service\Change\Command\SetTransferChangesPasswordCommand;
use FluxIliasRestApi\Service\Change\Command\SetTransferChangesPostUrlCommand;
use FluxIliasRestApi\Service\Change\Command\SetTransferChangesScheduleCommand;
use FluxIliasRestApi\Service\Change\Command\SetTransferChangesUserCommand;
use FluxIliasRestApi\Service\Change\Command\TransferChangesCommand;
use FluxIliasRestApi\Service\Config\Port\ConfigService;
use FluxIliasRestApi\Service\Course\Port\CourseService;
use FluxIliasRestApi\Service\CourseMember\Port\CourseMemberService;
use FluxIliasRestApi\Service\CronConfig\Port\CronConfigService;
use FluxIliasRestApi\Service\File\Port\FileService;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasRestApi\Service\Group\Port\GroupService;
use FluxIliasRestApi\Service\GroupMember\Port\GroupMemberService;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\ObjectLearningProgress\Port\ObjectLearningProgressService;
use FluxIliasRestApi\Service\OrganisationalUnit\Port\OrganisationalUnitService;
use FluxIliasRestApi\Service\OrganisationalUnitStaff\Port\OrganisationalUnitStaffService;
use FluxIliasRestApi\Service\Role\Port\RoleService;
use FluxIliasRestApi\Service\ScormLearningModule\Port\ScormLearningModuleService;
use FluxIliasRestApi\Service\User\Port\UserService;
use FluxIliasRestApi\Service\UserRole\Port\UserRoleService;
use FluxRestApi\Adapter\Api\RestApi;
use ilCronJob;
use ilDBInterface;

class ChangeService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly ConfigService $config_service,
        private readonly CategoryService $category_service,
        private readonly CourseService $course_service,
        private readonly CourseMemberService $course_member_service,
        private readonly FileService $file_service,
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly GroupService $group_service,
        private readonly GroupMemberService $group_member_service,
        private readonly ObjectService $object_service,
        private readonly ObjectLearningProgressService $object_learning_progress_service,
        private readonly OrganisationalUnitService $organisational_unit_service,
        private readonly OrganisationalUnitStaffService $organisational_unit_staff_service,
        private readonly RoleService $role_service,
        private readonly ScormLearningModuleService $scorm_learning_module_service,
        private readonly UserService $user_service,
        private readonly UserRoleService $user_role_service,
        private readonly RestApi $rest_api,
        private readonly CronConfigService $cron_config_service
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        ConfigService $config_service,
        CategoryService $category_service,
        CourseService $course_service,
        CourseMemberService $course_member_service,
        FileService $file_service,
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        GroupService $group_service,
        GroupMemberService $group_member_service,
        ObjectService $object_service,
        ObjectLearningProgressService $object_learning_progress_service,
        OrganisationalUnitService $organisational_unit_service,
        OrganisationalUnitStaffService $organisational_unit_staff_service,
        RoleService $role_service,
        ScormLearningModuleService $scorm_learning_module_service,
        UserService $user_service,
        UserRoleService $user_role_service,
        RestApi $rest_api,
        CronConfigService $cron_config_service
    ) : static {
        return new static(
            $ilias_database,
            $config_service,
            $category_service,
            $course_service,
            $course_member_service,
            $file_service,
            $flux_ilias_rest_object_service,
            $group_service,
            $group_member_service,
            $object_service,
            $object_learning_progress_service,
            $organisational_unit_service,
            $organisational_unit_staff_service,
            $role_service,
            $scorm_learning_module_service,
            $user_service,
            $user_role_service,
            $rest_api,
            $cron_config_service
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


    /**
     * @return ilCronJob[]
     */
    public function getChangeCronJobs() : array
    {
        return GetChangeCronJobsCommand::new(
            $this
        )
            ->getChangeCronJobs();
    }


    /**
     * @return ChangeDto[]
     */
    public function getChanges(?float $from = null, ?float $to = null, ?float $after = null, ?float $before = null) : array
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
        return GetKeepChangesInsideDaysCommand::new(
            $this->config_service
        )
            ->getKeepChangesInsideDays();
    }


    public function getLastTransferredChangeTime() : ?float
    {
        return GetLastTransferredChangeTimeCommand::new(
            $this->config_service
        )
            ->getLastTransferredChangeTime();
    }


    public function getPurgeChangesCronJob() : PurgeChangesCronJob
    {
        return GetPurgeChangesCronJobCommand::new(
            $this
        )
            ->getPurgeChangesCronJob();
    }


    public function getPurgeChangesSchedule() : object
    {
        return GetPurgeChangesScheduleCommand::new(
            $this,
            $this->cron_config_service
        )
            ->getPurgeChangesSchedule();
    }


    public function getTransferChangesCronJob() : TransferChangesCronJob
    {
        return GetTransferChangesCronJobCommand::new(
            $this
        )
            ->getTransferChangesCronJob();
    }


    public function getTransferChangesPassword() : ?string
    {
        return GetTransferChangesPasswordCommand::new(
            $this->config_service
        )
            ->getTransferChangesPassword();
    }


    public function getTransferChangesPostUrl() : string
    {
        return GetTransferChangesPostUrlCommand::new(
            $this->config_service
        )
            ->getTransferChangesPostUrl();
    }


    public function getTransferChangesSchedule() : object
    {
        return GetTransferChangesScheduleCommand::new(
            $this,
            $this->cron_config_service
        )
            ->getTransferChangesSchedule();
    }


    public function getTransferChangesUser() : ?string
    {
        return GetTransferChangesUserCommand::new(
            $this->config_service
        )
            ->getTransferChangesUser();
    }


    public function handleIliasEvent(UserDto $user, string $component, string $event, array $parameters) : void
    {
        HandleIliasEventCommand::new(
            $this->ilias_database,
            $this,
            $this->category_service,
            $this->course_service,
            $this->course_member_service,
            $this->file_service,
            $this->flux_ilias_rest_object_service,
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


    public function isEnableLogChanges() : bool
    {
        return IsEnableLogChangesCommand::new(
            $this->config_service
        )
            ->isEnableLogChanges();
    }


    public function isEnablePurgeChanges() : bool
    {
        return IsEnablePurgeChangesCommand::new(
            $this,
            $this->cron_config_service
        )
            ->isEnablePurgeChanges();
    }


    public function isEnableTransferChanges() : bool
    {
        return IsEnableTransferChangesCommand::new(
            $this,
            $this->cron_config_service
        )
            ->isEnableTransferChanges();
    }


    public function purgeChanges() : int
    {
        return PurgeChangesCommand::new(
            $this->ilias_database,
            $this
        )
            ->purgeChanges();
    }


    public function setEnableLogChanges(bool $enable_log_changes) : void
    {
        SetEnableLogChangesCommand::new(
            $this->config_service
        )
            ->setEnableLogChanges(
                $enable_log_changes
            );
    }


    public function setEnablePurgeChanges(bool $enable_purge_changes) : void
    {
        SetEnablePurgeChangesCommand::new(
            $this,
            $this->cron_config_service
        )
            ->setEnablePurgeChanges(
                $enable_purge_changes
            );
    }


    public function setEnableTransferChanges(bool $enable_transfer_changes) : void
    {
        SetEnableTransferChangesCommand::new(
            $this,
            $this->cron_config_service
        )
            ->setEnableTransferChanges(
                $enable_transfer_changes
            );
    }


    public function setKeepChangesInsideDays(?int $keep_changes_inside_days) : void
    {
        SetKeepChangesInsideDaysCommand::new(
            $this->config_service
        )
            ->setKeepChangesInsideDays(
                $keep_changes_inside_days
            );
    }


    public function setLastTransferredChangeTime(float $last_transferred_change_time) : void
    {
        SetLastTransferredChangeTimeCommand::new(
            $this->config_service
        )
            ->setLastTransferredChangeTime(
                $last_transferred_change_time
            );
    }


    public function setPurgeChangesSchedule(ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        SetPurgeChangesScheduleCommand::new(
            $this,
            $this->cron_config_service
        )
            ->setPurgeChangesSchedule(
                $type,
                $interval
            );
    }


    public function setTransferChangesPassword(?string $transfer_changes_password) : void
    {
        SetTransferChangesPasswordCommand::new(
            $this->config_service
        )
            ->setTransferChangesPassword(
                $transfer_changes_password
            );
    }


    public function setTransferChangesPostUrl(string $transfer_changes_post_url) : void
    {
        SetTransferChangesPostUrlCommand::new(
            $this->config_service
        )
            ->setTransferChangesPostUrl(
                $transfer_changes_post_url
            );
    }


    public function setTransferChangesSchedule(ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        SetTransferChangesScheduleCommand::new(
            $this,
            $this->cron_config_service
        )
            ->setTransferChangesSchedule(
                $type,
                $interval
            );
    }


    public function setTransferChangesUser(?string $transfer_changes_user) : void
    {
        SetTransferChangesUserCommand::new(
            $this->config_service
        )
            ->setTransferChangesUser(
                $transfer_changes_user
            );
    }


    public function transferChanges() : ?int
    {
        return TransferChangesCommand::new(
            $this->ilias_database,
            $this,
            $this->rest_api
        )
            ->transferChanges();
    }
}

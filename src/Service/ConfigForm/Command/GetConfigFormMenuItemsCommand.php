<?php

namespace FluxIliasRestApi\Service\ConfigForm\Command;

use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxIliasRestApi\Service\Proxy\ProxyTarget;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Identification\IdentificationProviderInterface;
use ILIAS\GlobalScreen\Scope\MainMenu\Factory\Item\Link as MainMenuLink;
use ILIAS\MainMenu\Provider\StandardTopItemsProvider;
use ILIAS\UI\Component\Symbol\Icon\Standard;

class GetConfigFormMenuItemsCommand
{

    private function __construct(
        private readonly ConfigFormService $config_form_service,
        private readonly Container $ilias_dic
    ) {

    }


    public static function new(
        ConfigFormService $config_form_service,
        Container $ilias_dic
    ) : static {
        return new static(
            $config_form_service,
            $ilias_dic
        );
    }


    public function getConfigFormMenuItem(IdentificationProviderInterface $if, ?UserDto $user) : MainMenuLink
    {
        $symbol = $this->ilias_dic->ui()->factory()->symbol()->icon()->standard(Standard::ADM, "flux-ilias-rest-config");
        if (method_exists($symbol, "withIsOutlined")) {
            $symbol = $symbol->withIsOutlined(true);
        }

        return $this->ilias_dic->globalScreen()->mainBar()->link($if->identifier(ProxyTarget::CONFIG->value))
            ->withParent(StandardTopItemsProvider::getInstance()->getAdministrationIdentification())
            ->withPosition(42001)
            ->withTitle("flux-ilias-rest-config")
            ->withAction("flux-ilias-rest-config")
            ->withSymbol($symbol)
            ->withVisibilityCallable(fn() : bool => $this->config_form_service->hasAccessToConfigForm(
                $user
            ));
    }
}

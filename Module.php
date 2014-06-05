<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountclientmessage
 */

namespace DragonJsonServerAccountclientmessage;

/**
 * Klasse zur Initialisierung des Moduls
 */
class Module
{
    use \DragonJsonServer\ServiceManagerTrait;

    /**
     * Gibt die Konfiguration des Moduls zurück
     * @return array
     */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    /**
     * Gibt die Autoloaderkonfiguration des Moduls zurück
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * Wird bei der Initialisierung des Moduls aufgerufen
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     */
    public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
    {
        $sharedManager = $moduleManager->getEventManager()->getSharedManager();
        $sharedManager->attach('DragonJsonServer\Service\Clientmessages', 'Clientmessages',
            function (\DragonJsonServer\Event\Clientmessages $eventClientmessages) {
                $serviceManager = $this->getServiceManager();

                $session = $serviceManager->get('\DragonJsonServerAccount\Service\Session')
                    ->getSession();
                if (!isset($session)) {
                    return;
                }
                $accountclientmessages = $serviceManager->get('\DragonJsonServerAccountclientmessage\Service\Accountclientmessage')
                    ->getAccountclientmessagesByAccountIdAndEventClientmessages($session->getAccountId(), $eventClientmessages);
                $serviceClientmessages = $serviceManager->get('\DragonJsonServer\Service\Clientmessages');
                foreach ($accountclientmessages as $accountclientmessage) {
                    $serviceClientmessages->addClientmessage($accountclientmessage->getKey(), $accountclientmessage->getData());
                }
            }
        );
        $sharedManager->attach('DragonJsonServerAccount\Service\Account', 'RemoveAccount',
            function (\DragonJsonServerAccount\Event\RemoveAccount $eventRemoveAccount) {
                $account = $eventRemoveAccount->getAccount();
                $this->getServiceManager()->get('\DragonJsonServerAccountclientmessage\Service\Accountclientmessage')
                    ->removeAccountclientmessagesByAccountId($account->getAccountId());
            }
        );
    }
}

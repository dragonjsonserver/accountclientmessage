<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccount
 */

namespace DragonJsonServerAccount\Service;

/**
 * Serviceklasse zur Verwaltung der Accountclientmessages
 */
class Accountclientmessage
{
	use \DragonJsonServer\ServiceManagerTrait;
	use \DragonJsonServerDoctrine\EntityManagerTrait;

	/**
	 * Erstellt eine Accountclientmessage die dem Account beim nächsten Request ausgeliefert wird
     * @param integer $account_id
     * @param string $key
     * @param array $data
	 * @return \DragonJsonServerAccountclientmessage\Entity\Accountclientmessage
	 */
	public function createAccountclientmessage($account_id, $key, array $data = [])
	{
        $entityManager = $this->getEntityManager();

		$accountclientmessage = (new \DragonJsonServerAccountclientmessage\Entity\Accountclientmessage())
            ->setAccountId($account_id)
            ->setKey($key)
            ->setData($data);
        $entityManager->persist($accountclientmessage);
        $entityManager->flush();
		return $accountclientmessage;
	}

    /**
     * Entfernt alle Accountclientmessages der übergebenen AccountId
     * @param integer $account_id
     * @return Accountclientmessage
     */
    public function removeAccountclientmessagesByAccountId($account_id)
    {
        $entityManager = $this->getEntityManager();

        $accountclientmessages = $entityManager
            ->getRepository('\DragonJsonServerAccountclientmessage\Entity\Accountclientmessage')
            ->findBy(['account_id' => $account_id]);
        foreach ($accountclientmessages as $accountclientmessage) {
            $entityManager->remove($accountclientmessage);
        }
        $entityManager->flush();
    }

	/**
	 * Gibt die Accountclientmessages der übergebenen AccountId und des Clientmessage Events zurück
	 * @param integer $account_id
     * @param \DragonJsonServer\Event\Clientmessages $eventClientmessages
	 * @return array
	 */
	public function getAccountclientmessagesByAccountIdAndEventClientmessages($account_id,
                                                                              \DragonJsonServer\Event\Clientmessages $eventClientmessages)
	{
        $entityManager = $this->getEntityManager();

        return $entityManager
            ->createQuery('
                SELECT accountclientmessages
                FROM \DragonJsonServerAccountclientmessage\Entity\Accountclientmessage accountclientmessages
                WHERE
                    accountclientmessages.account_id = :account_id
                    AND
                    accountclientmessages.created >= :from
                    AND
                    accountclientmessages.created < :to
                    AND
                    accountclientmessages.key IN (:keys)
                ORDER BY
                    accountclientmessages.created
            ')
            ->execute([
                'account_id' => $account_id,
                'from' => $eventClientmessages->getFrom(),
                'to' => $eventClientmessages->getTo(),
                'keys' => $eventClientmessages->getKeys(),
            ]);
	}
}

<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountclientmessage
 */

namespace DragonJsonServerAccountclientmessage\Entity;

/**
 * Entityklasse einer Accountclientmessage
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="accountclientmessages")
 */
class Accountclientmessage
{
	use \DragonJsonServerDoctrine\Entity\CreatedTrait;
    use \DragonJsonServerAccount\Entity\AccountIdTrait;
	
	/** 
	 * @Doctrine\ORM\Mapping\Id 
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 * @Doctrine\ORM\Mapping\GeneratedValue
	 **/
	protected $accountclientmessage_id;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     **/
    protected $key;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     **/
    protected $data;
	
	/**
	 * Setzt die ID der Accountclientmessage
	 * @param integer $accountclientmessage_id
	 * @return Accountclientmessage
	 */
	protected function setAccountclientmessageId($accountclientmessage_id)
	{
		$this->accountclientmessage_id = $accountclientmessage_id;
		return $this;
	}
	
	/**
	 * Gibt die ID der Accountclientmessage zurück
	 * @return integer
	 */
	public function getAccountclientmessageId()
	{
		return $this->accountclientmessage_id;
	}

    /**
     * Setzt den Key der Accountclientmessage
     * @param string $key
     * @return Accountclientmessage
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Gibt den Key der Accountclientmessage zurück
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Setzt die Daten der Accountclientmessage
     * @param array $data
     * @return Accountclientmessage
     */
    public function setData(array $data)
    {
        $this->data = \Zend\Json\Encoder::encode($data);
        return $this;
    }

    /**
     * Gibt die Daten der Accountclientmessage zurück
     * @return array
     */
    public function getData()
    {
        return \Zend\Json\Decoder::decode($this->data, \Zend\Json\Json::TYPE_ARRAY);
    }
	
	/**
	 * Setzt die Attribute der Accountclientmessage aus dem Array
	 * @param array $array
	 * @return Accountclientmessage
	 */
	public function fromArray(array $array)
	{
		return $this
            ->setAccountclientmessageId($array['accountclientmessage_id'])
            ->setCreatedTimestamp($array['created'])
            ->setAccountId($array['account_id'])
            ->setKey($array['key'])
            ->setData($array['data']);
	}
	
	/**
	 * Gibt die Attribute der Accountclientmessage als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'__className' => __CLASS__,
			'accountclientmessage_id' => $this->getAccountclientmessageId(),
            'created' => $this->getCreatedTimestamp(),
            'account_id' => $this->getAccountId(),
            'key' => $this->getKey(),
            'data' => $this->getData(),
		];
	}
}

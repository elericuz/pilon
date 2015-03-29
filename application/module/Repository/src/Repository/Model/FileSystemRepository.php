<?php
namespace Repository\Model;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class FileSystemRepository extends EntityRepository
{
	private $em;

	function __construct($em)
	{
		$this->em = $em;
	}

    public function getLastUploadedFiles($client, $limit=5)
    {
        $query = $this->em->createQueryBuilder();
        $query->select(array(
                'fsc.fsciId',
                'fsc.fscvRealName',
                'fsc.fscdUploadDate',
                'fsc.fsciTotalDownload',
                'fs.fisvName'))
             ->from('Application\Entity\FileSystemClient', 'fsc')
             ->innerJoin('fsc.fisi', 'fs')
             ->setFirstResult(0)
             ->setMaxResults($limit)
             ->distinct('fs.fisvName')
             ->where('fsc.clii='.$client)
             ->andWhere('fs.fisiType=1')
             ->andWhere('fsc.fsciStatus=1')
             ->orderBy('fsc.fscdUploadDate', 'desc');

        $result = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    public function getMostDownloadFiles($client, $limit=5)
    {
        $query = $this->em->createQueryBuilder();
        $query->select(array(
                'fsc.fsciId',
                'fsc.fscvRealName',
                'fsc.fscdUploadDate',
                'fsc.fsciTotalDownload',
                'fs.fisvName'))
             ->from('Application\Entity\FileSystemClient', 'fsc')
             ->innerJoin('fsc.fisi', 'fs')
             ->setFirstResult(0)
             ->setMaxResults($limit)
             ->distinct('fs.fisvName')
             ->where('fsc.clii='.$client)
             ->andWhere('fs.fisiType=1')
             ->andWhere('fsc.fsciStatus=1')
             ->orderBy('fsc.fsciTotalDownload', 'desc');

        $result = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    public function getFolders($client, $parent=0)
    {
        $query = $this->em->createQueryBuilder();
        $query->select(array(
                'fsc.fsciId',
                'fsc.fscvRealName',
                'fsc.fscvFriendlyName',
                'fsc.fscdUploadDate',
                'fs.fisvName'))
             ->from('Application\Entity\FileSystemClient', 'fsc')
             ->innerJoin('fsc.fisi', 'fs')
             ->distinct('fs.fisvName')
             ->where('fsc.clii='.$client)
             ->andWhere('fs.fisiType=0')
             ->andWhere('fsc.fsciParentId='.$parent)
             ->andWhere('fsc.fsciStatus=1');

        $result = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    public function getFiles($client, $parent=0)
    {
        $query = $this->em->createQueryBuilder();
        $query->select(array(
                'fsc.fsciId',
                'fsc.fscvRealName',
                'fsc.fscvFriendlyName',
                'fsc.fsctDescription',
                'fsc.fscdUploadDate',
                'fsc.fsciTotalDownload',
                'fs.fisvName'))
             ->from('Application\Entity\FileSystemClient', 'fsc')
             ->innerJoin('fsc.fisi', 'fs')
             ->distinct('fs.fisvName')
             ->where('fsc.clii='.$client)
             ->andWhere('fs.fisiType=1')
             ->andWhere('fsc.fsciParentId='.$parent)
             ->andWhere('fsc.fsciStatus=1');

        $result = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    public function findFile($client, $md5)
    {
        $query = $this->em->createQueryBuilder();
        $query->select(array(
                'fsc.fsciId',
                'fsc.fscvRealName',
                'fsc.fscvFriendlyName',
                'fsc.fsctDescription',
                'fsc.fscdUploadDate',
                'fs.fisvName',
                'fs.fisvMimetype'))
             ->from('Application\Entity\FileSystemClient', 'fsc')
             ->innerJoin('fsc.fisi', 'fs')
             ->distinct('fs.fisvName')
             ->where('fsc.clii='.$client)
             ->andWhere('fs.fisiType=1')
             ->andWhere('fs.fisvName=:md5')
             ->andWhere('fsc.fsciStatus=1')
             ->setParameter('md5', $md5);

        $result = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    public function getChildrenId($client, $parent=0, $type='ALL')
    {
        $query = $this->em->createQueryBuilder();
        $query->select(array(
                'fsc.fsciId',
                'fs.fisiType'))
             ->from('Application\Entity\FileSystemClient', 'fsc')
             ->innerJoin('fsc.fisi', 'fs')
             ->where('fsc.clii='.$client)
             ->andWhere('fsc.fsciParentId='.$parent)
             ->andWhere('fsc.fsciStatus=1');

        if($type===1)
        {
            $query->andWhere('fs.fisiType=1');
        }
        if($type===0)
        {
            $query->andWhere('fs.fisiType=0');
        }

        $resultSet = $query->getQuery()->getResult(Query::HYDRATE_ARRAY);

        $result = array();
        foreach($resultSet as $child)
        {
            $result[] = $child['fsciId'];
        }

        return $result;
    }
}

?>
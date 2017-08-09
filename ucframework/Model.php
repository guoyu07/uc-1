<?php

namespace ucframework;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Tools\EntityGenerator;
use Doctrine\ORM\Mapping\Driver\DatabaseDriver;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;

class Model
{

    private $_paths;
    private $_dbparams = [];
    private static $_instance;

    /**
     *
     * @var EntityManager 
     */
    public $entityManager;

    public function __construct()
    {
        $this->_paths = [APP_PATH . 'uc/runtime/entities'];
        $this->_dbParams = @include APP_PATH . 'uc/database.php';
        $config = Setup::createAnnotationMetadataConfiguration($this->_paths, DEBUG, null, new ArrayCache());
        $this->entityManager = EntityManager::create($this->_dbParams, $config);
    }

    public function createEntity($tablename = [])
    {

        $driver = new DatabaseDriver($this->entityManager->getConnection()->getSchemaManager());
        $driver->setNamespace('runtime\\entities\\');
        $this->entityManager->getConfiguration()->setMetadataDriverImpl($driver);
        $cmf = new DisconnectedClassMetadataFactory();
        $cmf->setEntityManager($this->entityManager);
        $metadata = [];
        if ($tablename)
        {
            foreach ($tablename as $tbl)
            {
                $metadata[] = $cmf->getMetadataFor('runtime\\entities\\' . $tbl);
            }
        } else
        {
            $metadata = $cmf->getAllMetadata();
        }
        $generator = new EntityGenerator();
        $generator->setGenerateAnnotations(true);
        $generator->setGenerateStubMethods(true);
        $generator->setUpdateEntityIfExists(true);
        $generator->setRegenerateEntityIfExists(true);
        $generator->setAnnotationPrefix('');
        $generator->generate($metadata, APP_PATH . 'uc/');
    }

    /**
     * 
     * 
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getEntityRepository()
    {
        $classnameinfo = explode('\\', get_class($this));
        $classname = ucfirst(rtrim($this->_dbParams['prefix'], '_')) . end($classnameinfo);
        if (!class_exists('\\runtime\\entities\\' . $classname) || DEBUG)
        {
            $this->createEntity([$classname]);
        }
        return $this->entityManager->getRepository('\\runtime\\entities\\' . $classname);
    }

    private function __clone()
    {
        
    }

}

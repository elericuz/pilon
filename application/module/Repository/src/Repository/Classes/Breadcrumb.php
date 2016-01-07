<?php
namespace Repository\Classes;

class Breadcrumb
{
    private $bc = array();
    private $em;

    function __construct($em)
    {
        $this->em = $em;
    }

    public function add($fsciId)
    {
        $parent = 0;

        $FSC_obj = $this->em->getRepository('Application\Entity\FileSystemClient')->findBy(array('fsciId'=>$fsciId));

        foreach($FSC_obj as $folder)
        {
            $array = array(
                'fsciId' => $folder->getFsciId(),
                'fsciParentId' => $folder->getFsciParentId(),
                'fisiId' => $folder->getFisi()->getFisiId(),
                'fscvRealName' => $folder->getFscvRealName()
            );

            $this->bc[] = $array;

            $parent = $array['fsciParentId'];
        }

        if($parent>0)
            $this->add($parent);

        krsort($this->bc);
        reset($this->bc);
        return $this->bc;
    }
}

?>
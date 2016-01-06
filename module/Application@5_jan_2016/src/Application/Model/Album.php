<?php

namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Album implements InputFilterAwareInterface
{
    public $id;
    public $name;
	public $category_id;
    public $title;
	public $email;
	public $mob;
	public $address;
	public $short_description;
    public $description;
	public $image;
	public $cat_name;
	
	
    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
		$this->id                   =     (isset($data['id'])) ? $data['id']  : null;
		$this->category_id                   =     (isset($data['category_id'])) ? $data['category_id']  : null;
        $this->name                 =     (isset($data['name'])) ? $data['name']  : null;
        $this->title                =     (isset($data['title'])) ? $data['title']  : null;
		$this->email                =     (isset($data['email'])) ? $data['email']  : null;
		$this->mob                  =     (isset($data['mob'])) ? $data['mob']   : null;
		$this->address              =     (isset($data['address'])) ? $data['address']  : null;
        $this->short_description    =     (isset($data['short_description']))?$data['short_description'] : null;
		$this->description          =     (isset($data['description']))?$data['description'] : null;
		$this->image                =     (isset($data['image']))?$data['image']:null;
		$this->cat_name                =     (isset($data['cat_name']))?$data['cat_name']:null;
	}

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
        
            $this->inputFilter = $inputFilter;        
        }

        return $this->inputFilter;
    }
}

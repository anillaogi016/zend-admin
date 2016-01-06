<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace  Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;


class AlbumTable extends AbstractTableGateway{
	
	protected $table = 'albums';
	
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
		$this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Album());
        $this->initialize();	
	}
	public function fetchAll(Select $select=null,$search=null){
		if(null===$select)
		$select = new Select();
	   // print_r($this->table); die;
		$select->from($this->table);
		$select->join('categories','albums.category_id=categories.id',array('cat_name'=>'name'),'left');
		$resultSet = $this->selectWith($select);
		$resultSet->buffer();
		//echo '<pre>';print_r($resultSet); echo '<pre>'; die;
		return $resultSet;
		
	}
	public function saveAlbum(Album $album){
		$data=array(
			'name'=>$album->name,
			'email'=>$album->email,
			'mob'=>$album->mob,
			'address'=>$album->address,
			'title'=>$album->title,
			'short_description'=>$album->short_description,
			'description'=>$album->description,
			'image'=>$album->image,
			'category_id'=>(int)$album->category_id,
		);
		$id=(int) $album->id;
		if($id==0){
			$this->insert($data);
		}else{
			if($this->getAlbum($id)){
				$this->update($data,array('id'=>$id));
			}else{
				throw new \Exception('Form id does not exit');
			}
		}
	}
	public function getAlbum($id){
		$id=(int) $id;
		$rowset=$this->select(array('id'=>$id));
		$row=$rowset->current();
		if(!$row){
			throw new \Exception('Could not found row $id');
		}
		return $row;
	}
	public function deleteAlbum($id){
		$id=(int) $id;
		if($id){
			$this->delete(array('id'=>$id));
		}
	}
}
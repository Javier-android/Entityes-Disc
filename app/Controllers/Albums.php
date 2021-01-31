<?php namespace App\Controllers;

use App\Models\AlbumsModel;

class Albums extends BaseController
{
	public function index()
	{
		$Am = new AlbumsModel();
		$result = $albumModel->find();
		//$data['genres']= $result; 
		//return view("inicio",$data);
		//echo var_dump($result);
		//echo var_dump($result);
		
		//echo "Estamos dentro de controlador Genre en la funcion index()";
		
		$parse = \Config\Services::parser();
		echo $parse->setData(['albums'=>$result,'base_url'=>base_url()])->render('inicio');
		
	}
	
	public function new()
	{
		//$data['tipo']='nuevo';
		//$data['opcion']=1;
	//return view("nuevo", $data);
	
	$parse = \Config\Services::parser();
	$data['titulo']='New Autor';
	$data['base_url'] = base_url();
	echo $parse->setData($data)
				->render('nuevo');
	}
	
	public function save(){
		if ($this->request->getMethod() === 'post' &&
			$this->validate(['name'=> 'required|min_length[3]|max_length[255]',
				'author'=> 'required|min_length[5]max_length[300]',
				'genre_id'=> 'required|integer'])
			)
		{
		$name = $this->request->getPost('name');
		$author = $this->request->getPost('author');
		$genre_id = $this->request->getPost('genre_id');
		$Am = new AlbumsModel();
		$Am->save(['name'=>$name, 'author'=>$author, 'genre_id'=>$genre_id])
		$this->response->redirect('index');
		}else{
			echo'Verifique datos';
		}
		
	}
	
	public function edit($id){
		
		$Am = new AlbumsModel();
		$am = $Am->find($id);
		$name = $am->name;
		$author = $am->author;
		$genre_id = $am->genre_id;
		$parse = \Config\Services::parser();
		echo $parse->setData(['titulo'=>'Edit Genre','id'=>$id,'name'=>$name,'author'=>$author,'base_url'=>base_url()])
					->render('edit');
	}
	
	public function update(){
		if ($this->request->getMethod() === 'post' &&
			$this->validate(['name'=> 'required|min_length[3]|max_length[255]',
				             'author'=> 'required|min_length[5]max_length[300]',
							 'id'=>'required|integer'])
			)
		{
		$id = $this->request->getPost('id');
		$name = $this->request->getPost('name');
		$author = $this->request->getPost('author');
		
		$Am = new AlbumsModel();
		//$gr = $gm->find($id);
		//$gr->name = $name;
		
		//$gm->save($gr);
		$Am->update($id,['name'=>$name,'author'=>$author]);
		$this->response->redirect(base_url().'/disco/public/albums');
		//echo "Se va a Guardar";
		}else{
			echo'Verifique datos';
		}
		
	}
	
	public function delete($id){
		$Am =  new AlbumsModel();
		$Am->delete($id);
		
		$this->response->redirect(base_url().'/disco/public/albums');
		
	}
	
	public function albumsjs()
	{
		if($this->request->isAjax())
		{
			$Am = new AlbunsModel();
			$result = $albumsModel->find();
			return json_encode(["data"=>$result]);
		}else{
			$this->response->redirect(base_url().'/disco/public/albums');
		}
	}
}